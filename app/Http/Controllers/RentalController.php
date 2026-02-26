<?php

namespace App\Http\Controllers;

use App\Events\EarningsUpdated;
use App\Events\WithdrawalStatusUpdated;
use App\Models\Earning;
use App\Models\OwnerVehicle;
use App\Models\Rental;
use App\Models\RentalRequest;
use App\Models\Vehicle;
use App\Models\WithdrawalRequest;
use App\Services\Payments\CommissionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function __construct(private readonly CommissionService $commissionService)
    {
        $this->middleware('multi.auth');
    }

    public function listOwnerVehicle(Request $request)
    {
        $this->ensureCustomer();

        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'daily_rate' => 'required|numeric|min:0',
        ]);

        $user = getAuthenticatedUser();
        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        if ((int) $vehicle->customer_id !== (int) $user->id) {
            abort(403, 'You can only list your own vehicle.');
        }

        OwnerVehicle::updateOrCreate(
            ['vehicle_id' => $vehicle->id],
            [
                'owner_id' => $user->id,
                'daily_rate' => $validated['daily_rate'],
                'approval_status' => 'pending',
                'is_available' => true,
            ]
        );

        return back()->with('success', 'Vehicle submitted for admin approval.');
    }

    public function approveOwnerVehicle(Request $request, OwnerVehicle $ownerVehicle)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'approval_status' => 'required|in:approved,rejected',
            'approval_note' => 'nullable|string|max:1000',
        ]);

        $ownerVehicle->update([
            'approval_status' => $validated['approval_status'],
            'approval_note' => $validated['approval_note'] ?? null,
            'approved_at' => $validated['approval_status'] === 'approved' ? now() : null,
        ]);

        return back()->with('success', 'Listing status updated successfully.');
    }

    public function storeAdminRental(Request $request)
    {
        $this->ensureCustomer();

        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        if (!$vehicle->is_service_center_vehicle) {
            return back()->with('error', 'Selected vehicle is not an admin rental vehicle.');
        }

        if (!empty($vehicle->rented_by_user_id)) {
            return back()->with('error', 'Vehicle is currently unavailable.');
        }

        if ($this->hasVehicleDateConflict((int) $vehicle->id, $validated['start_date'], $validated['end_date'])) {
            return back()->with('error', 'Vehicle is already reserved for the selected dates.');
        }

        $days = $this->calculateDays($validated['start_date'], $validated['end_date']);
        $total = round($days * (float) $vehicle->daily_rate, 2);

        $rental = Rental::create([
            'vehicle_id' => $vehicle->id,
            'owner_id' => null,
            'renter_id' => getAuthenticatedUser()->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'number_of_days' => $days,
            'total_amount' => $total,
            'commission_amount' => 0,
            'owner_earning' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.rentals.pay', $rental);
    }

    public function storeMarketplaceRental(Request $request)
    {
        $this->ensureCustomer();

        $validated = $request->validate([
            'owner_vehicle_id' => 'required|exists:owner_vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $ownerVehicle = OwnerVehicle::with('vehicle')->findOrFail($validated['owner_vehicle_id']);
        $user = getAuthenticatedUser();

        if ($ownerVehicle->approval_status !== 'approved' || !$ownerVehicle->is_available) {
            return back()->with('error', 'Vehicle is not available for marketplace rental.');
        }

        if ((int) $ownerVehicle->owner_id === (int) $user->id) {
            return back()->with('error', 'You cannot rent your own listed vehicle.');
        }

        if ($this->hasVehicleDateConflict((int) $ownerVehicle->vehicle_id, $validated['start_date'], $validated['end_date'])) {
            return back()->with('error', 'Vehicle is already reserved for the selected dates.');
        }

        $days = $this->calculateDays($validated['start_date'], $validated['end_date']);
        $total = round($days * (float) $ownerVehicle->daily_rate, 2);
        $split = $this->commissionService->calculateMarketplaceSplit($total);

        $rental = DB::transaction(function () use ($ownerVehicle, $user, $validated, $days, $split) {
            $rental = Rental::create([
                'vehicle_id' => $ownerVehicle->vehicle_id,
                'owner_id' => $ownerVehicle->owner_id,
                'renter_id' => $user->id,
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'number_of_days' => $days,
                'total_amount' => $split['total'],
                'commission_amount' => $split['commission'],
                'owner_earning' => $split['owner_earning'],
                'status' => 'pending',
            ]);

            $ownerVehicle->update(['is_available' => false]);

            return $rental;
        });

        return redirect()->route('payments.rentals.pay', $rental);
    }

    public function ownerListings()
    {
        $this->ensureAdmin();

        $ownerVehicles = OwnerVehicle::with(['owner', 'vehicle'])
            ->orderByRaw("CASE WHEN approval_status = 'pending' THEN 0 ELSE 1 END")
            ->latest('id')
            ->get();

        return view('admin.rentals.owner-listings', compact('ownerVehicles'));
    }

    public function earningsPayouts()
    {
        $this->ensureAdmin();

        $withdrawalRequests = WithdrawalRequest::with(['owner', 'processor'])
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->latest('requested_at')
            ->paginate(20, ['*'], 'withdrawals_page');

        $earnings = Earning::with(['owner', 'rental.vehicle'])
            ->orderByRaw("CASE WHEN payout_status = 'pending' THEN 0 ELSE 1 END")
            ->latest('id')
            ->paginate(20, ['*'], 'earnings_page');

        return view('admin.rentals.payouts', compact('earnings', 'withdrawalRequests'));
    }

    public function completeRental(Request $request, Rental $rental)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'has_damage' => 'required|boolean',
            'damage_charge' => 'nullable|numeric|min:0',
            'damage_notes' => 'nullable|string|max:2000',
        ]);

        DB::transaction(function () use ($rental, $validated): void {
            $hasDamage = (bool) $validated['has_damage'];
            $damageCharge = $hasDamage ? (float) ($validated['damage_charge'] ?? 0) : null;

            $rental->update([
                'status' => 'completed',
                'damage_charge' => $damageCharge,
                'damage_notes' => $validated['damage_notes'] ?? null,
                'damage_invoice_generated_at' => $hasDamage ? now() : null,
            ]);

            if ($rental->vehicle) {
                $rental->vehicle->update([
                    'rented_by_user_id' => null,
                ]);
            }

            if ($rental->owner_id) {
                Earning::firstOrCreate(
                    ['rental_id' => $rental->id],
                    [
                        'owner_id' => $rental->owner_id,
                        'commission' => $rental->commission_amount,
                        'owner_amount' => $rental->owner_earning,
                        'payout_status' => 'pending',
                    ]
                );

                event(new EarningsUpdated(
                    (int) $rental->owner_id,
                    (float) ($rental->owner_earning ?? 0),
                    (float) ($rental->commission_amount ?? 0),
                    'rental_completed',
                    (int) $rental->id
                ));

                OwnerVehicle::where('vehicle_id', $rental->vehicle_id)->update(['is_available' => true]);
            }
        });

        return back()->with('success', 'Rental marked completed and post-return checks saved.');
    }

    public function markPayoutPaid(Earning $earning)
    {
        $this->ensureAdmin();

        $earning->update([
            'payout_status' => 'paid',
            'paid_out_at' => now(),
        ]);

        event(new EarningsUpdated(
            (int) $earning->owner_id,
            (float) $earning->owner_amount,
            (float) $earning->commission,
            'payout_paid',
            (int) $earning->rental_id
        ));

        return back()->with('success', 'Owner payout marked as paid.');
    }

    public function ownerEarningsDashboard()
    {
        $this->ensureCustomer();

        $ownerId = getAuthenticatedUser()->id;

        $summary = Earning::query()
            ->where('owner_id', $ownerId)
            ->selectRaw('COALESCE(SUM(owner_amount), 0) as total_earned')
            ->selectRaw('COALESCE(SUM(commission), 0) as commission_deducted')
            ->selectRaw("COALESCE(SUM(CASE WHEN payout_status = 'pending' THEN owner_amount ELSE 0 END), 0) as withdrawable_balance")
            ->first();

        $earnings = Earning::with('rental.vehicle')
            ->where('owner_id', $ownerId)
            ->latest('id')
            ->paginate(15);

        $withdrawalRequests = WithdrawalRequest::where('owner_id', $ownerId)
            ->latest('requested_at')
            ->get();

        // Fetch recent rental requests for owner's vehicles
        $ownedVehicles = Vehicle::where('customer_id', $ownerId)->pluck('id');
        $recentRentalRequests = RentalRequest::with(['vehicle', 'renter', 'assignedStaff'])
            ->whereIn('vehicle_id', $ownedVehicles)
            ->latest('created_at')
            ->take(10)
            ->get();

        // Fetch recent marketplace rentals for owner's listed vehicles (exclude rental requests)
        $recentMarketplaceRentals = Rental::with(['vehicle', 'renter'])
            ->where('owner_id', $ownerId)
            ->whereNull('rental_request_id')
            ->latest('created_at')
            ->take(10)
            ->get();

        return view('customer.owner-earnings-dashboard', compact('summary', 'earnings', 'withdrawalRequests', 'recentRentalRequests', 'recentMarketplaceRentals'));
    }

    public function ownerRentalHistory()
    {
        $this->ensureCustomer();

        $ownerId = getAuthenticatedUser()->id;

        // Get all rental requests for owner's vehicles
        $rentalRequests = RentalRequest::with(['vehicle', 'renter', 'assignedStaff'])
            ->where('owner_id', $ownerId)
            ->orderByDesc('created_at')
            ->paginate(20);

        // Calculate days for each request
        $rentalRequests->getCollection()->each(function ($request) {
            if ($request->start_date && $request->end_date) {
                $request->number_of_days = $request->start_date->diffInDays($request->end_date) + 1;
            }
        });

        // Get marketplace rentals (exclude rental requests)
        $marketplaceRentals = Rental::with(['vehicle', 'renter'])
            ->where('owner_id', $ownerId)
            ->whereNull('rental_request_id')
            ->orderByDesc('created_at')
            ->paginate(20);

        // Get vehicles owned by this customer
        $ownedVehicles = Vehicle::where('customer_id', $ownerId)
            ->where('is_listed_for_rent', true)
            ->get();

        $stats = [
            'total_rentals' => $rentalRequests->total() + $marketplaceRentals->total(),
            'active_rentals' => RentalRequest::where('owner_id', $ownerId)
                ->whereIn('status', ['Approved', 'Ready for Pickup', 'Picked Up', 'In Use', 'Returned'])
                ->count(),
            'completed_rentals' => RentalRequest::where('owner_id', $ownerId)
                ->where('status', 'Completed')
                ->count(),
            'total_earned' => Earning::where('owner_id', $ownerId)->sum('owner_amount'),
        ];

        return view('customer.owner-rental-history', compact('rentalRequests', 'marketplaceRentals', 'ownedVehicles', 'stats'));
    }

    public function requestWithdrawal(Request $request)
    {
        $this->ensureCustomer();

        $ownerId = getAuthenticatedUser()->id;

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string|max:1000',
        ]);

        // Get withdrawable balance
        $pendingEarnings = Earning::where('owner_id', $ownerId)
            ->where('payout_status', 'pending')
            ->get();

        $withdrawableBalance = $pendingEarnings->sum('owner_amount');

        if ($validated['amount'] > $withdrawableBalance) {
            return back()->with('error', 'Requested amount exceeds your available balance.');
        }

        // Create withdrawal request
        $withdrawalRequest = WithdrawalRequest::create([
            'owner_id' => $ownerId,
            'amount' => $validated['amount'],
            'note' => $validated['note'],
            'status' => 'pending',
            'requested_at' => now(),
        ]);

        event(new WithdrawalStatusUpdated($withdrawalRequest));

        return back()->with('success', 'Withdrawal request submitted successfully. Admin will review your request.');
    }

    public function processWithdrawalRequest(Request $request, WithdrawalRequest $withdrawalRequest)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'status' => 'required|in:approved,paid,rejected',
            'admin_note' => 'nullable|string|max:1000',
        ]);

        DB::transaction(function () use ($withdrawalRequest, $validated) {
            $lockedWithdrawalRequest = WithdrawalRequest::query()
                ->whereKey($withdrawalRequest->id)
                ->lockForUpdate()
                ->first();

            if (!$lockedWithdrawalRequest) {
                throw new \RuntimeException('Withdrawal request not found.');
            }

            $previousStatus = (string) $lockedWithdrawalRequest->status;

            $lockedWithdrawalRequest->update([
                'status' => $validated['status'],
                'admin_note' => $validated['admin_note'] ?? null,
                'processed_at' => now(),
                'processed_by' => Auth::guard('admin')->id(),
            ]);

            // If marking as paid, update all associated pending earnings for this owner
            if ($validated['status'] === 'paid' && $previousStatus !== 'paid') {
                $pendingEarnings = Earning::query()->where('owner_id', $lockedWithdrawalRequest->owner_id)
                    ->where('payout_status', 'pending')
                    ->orderBy('id')
                    ->lockForUpdate()
                    ->get();

                $amountRemaining = (float) $lockedWithdrawalRequest->amount;

                foreach ($pendingEarnings as $earning) {
                    if (!$earning instanceof Earning) {
                        continue;
                    }

                    if ($amountRemaining <= 0) {
                        break;
                    }

                    $earningAmount = (float) $earning->owner_amount;

                    if ($earningAmount <= $amountRemaining) {
                        // Fully pay this earning
                        $earning->update([
                            'payout_status' => 'paid',
                            'paid_out_at' => now(),
                        ]);
                        $lockedWithdrawalRequest->earnings()->syncWithoutDetaching([$earning->id]);
                        $amountRemaining -= $earningAmount;
                        continue;
                    }

                    // Partial payout from a larger pending earning
                    $newOwnerAmount = round($earningAmount - $amountRemaining, 2);

                    $earning->update([
                        'owner_amount' => $newOwnerAmount,
                    ]);

                    $lockedWithdrawalRequest->earnings()->syncWithoutDetaching([$earning->id]);
                    $amountRemaining = 0;
                    break;
                }

                if ($amountRemaining > 0) {
                    throw new \RuntimeException('Unable to allocate full withdrawal amount from pending earnings.');
                }
            }
        });

        event(new WithdrawalStatusUpdated($withdrawalRequest->fresh()));

        return back()->with('success', 'Withdrawal request has been ' . $validated['status'] . '.');
    }

    private function calculateDays(string $startDate, string $endDate): int
    {
        return max(1, Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1);
    }

    private function hasVehicleDateConflict(int $vehicleId, string $startDate, string $endDate): bool
    {
        $activeRequestStatuses = ['Pending', 'Approved', 'Ready for Pickup', 'Picked Up', 'In Use', 'Returned'];

        $requestConflict = RentalRequest::query()
            ->where('vehicle_id', $vehicleId)
            ->whereIn('status', $activeRequestStatuses)
            ->whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->whereDate('start_date', '<=', $endDate)
            ->whereDate('end_date', '>=', $startDate)
            ->exists();

        if ($requestConflict) {
            return true;
        }

        return Rental::query()
            ->where('vehicle_id', $vehicleId)
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereDate('start_date', '<=', $endDate)
            ->whereDate('end_date', '>=', $startDate)
            ->exists();
    }

    private function ensureCustomer(): void
    {
        if (getAuthenticatedUserRole() !== 'customer') {
            abort(403, 'Only customers can access this action.');
        }
    }

    private function ensureAdmin(): void
    {
        if (getAuthenticatedUserRole() !== 'admin') {
            abort(403, 'Only admins can access this action.');
        }
    }
}
