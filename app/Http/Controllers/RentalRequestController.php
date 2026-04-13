<?php

namespace App\Http\Controllers;

use App\Events\RentalStatusUpdated;
use App\Models\RentalRequest;
use App\Models\Rental;
use App\Models\Payment;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalRequestController extends Controller
{
    /**
     * List rentals for current customer (their requests)
     */
    public function index()
    {
        $customerId = Auth::guard('customer')->id();
        
        // Get rental requests with full details
        $requests = RentalRequest::with(['vehicle', 'assignedStaff', 'owner'])
            ->where('renter_id', $customerId)
            ->orderByDesc('created_at')
            ->get();

        // Calculate days for each request
        $requests->each(function ($request) {
            if ($request->start_date && $request->end_date) {
                $request->number_of_days = $request->start_date->diffInDays($request->end_date) + 1;
            }
        });

        // Get paid rentals from Rental table (only marketplace rentals, not linked to rental requests)
        $rentals = Rental::with(['vehicle', 'owner'])
            ->where('renter_id', $customerId)
            ->whereNull('rental_request_id')
            ->orderByDesc('created_at')
            ->get();

        $payments = Payment::where('user_id', $customerId)
            ->whereIn('type', ['admin_rental', 'marketplace_rental', 'rental_damage'])
            ->orderByDesc('id')
            ->get();

        $paymentMap = [];
        foreach ($payments as $payment) {
            $parts = explode(':', (string) $payment->order_id);
            $baseKey = isset($parts[1]) ? ($parts[0] . ':' . $parts[1]) : (string) $payment->order_id;

            if (!isset($paymentMap[$baseKey])) {
                $paymentMap[$baseKey] = $payment;
            }
        }

        $requestPaymentIds = [];
        $requests->each(function ($request) use (&$requestPaymentIds, $paymentMap) {
            $baseKey = 'rental_request:' . $request->id;
            $payment = $paymentMap[$baseKey] ?? null;
            if ($payment) {
                $request->payment_status = $this->mapGatewayStatusToRentalStatus((string) $payment->status);
                $requestPaymentIds[$request->id] = $payment->id;
            }
        });

        $rentalPaymentIds = [];
        $rentals->each(function ($rental) use (&$rentalPaymentIds, $paymentMap) {
            $prefix = $rental->owner_id ? 'marketplace_rental' : 'admin_rental';
            $baseKey = $prefix . ':' . $rental->id;
            $payment = $paymentMap[$baseKey] ?? null;

            $rental->payment_status = $payment
                ? $this->mapGatewayStatusToRentalStatus((string) $payment->status)
                : 'Unpaid';
            $rental->transaction_id = $payment?->transaction_id;

            if ($payment) {
                $rentalPaymentIds[$rental->id] = $payment->id;
            }
        });

        return view('customer.rentals', compact('requests', 'rentals', 'requestPaymentIds', 'rentalPaymentIds'));
    }

    /**
     * Store a rental request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'notes' => 'nullable|string|max:1000',
            'renter_contact' => 'nullable|string|max:20',
            'pickup_location' => 'nullable|string|max:255',
            'service_link' => 'nullable|string|max:500',
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        // Check if vehicle is available and approved
        if (!$vehicle->is_listed_for_rent || !empty($vehicle->rented_by_user_id)) {
            return redirect()->back()->with('error', 'This vehicle is not available for rent.');
        }

        // Check if vehicle listing is approved by admin
        if ($vehicle->listing_status !== 'approved') {
            return redirect()->back()->with('error', 'This vehicle listing is not yet approved.');
        }

        $renterId = Auth::guard('customer')->id();
        if ($vehicle->customer_id === $renterId) {
            return redirect()->back()->with('error', 'You cannot rent your own vehicle.');
        }

        $totalCost = null;
        if (!empty($validated['start_date']) && !empty($validated['end_date']) && $vehicle->daily_rate !== null) {
            $days = max(1, (new \Carbon\Carbon($validated['start_date']))->diffInDays(new \Carbon\Carbon($validated['end_date'])) + 1);
            $totalCost = $days * $vehicle->daily_rate;
        }

        if (!empty($validated['start_date']) && !empty($validated['end_date'])) {
            if ($this->hasVehicleDateConflict((int) $vehicle->id, $validated['start_date'], $validated['end_date'])) {
                return redirect()->back()->with('error', 'Selected vehicle is not available for the chosen dates.')->withInput();
            }
        }

        if (!$renterId) {
            return redirect()->route('login');
        }

        // Determine owner_id: customer-listed vehicles use customer_id, admin vehicles are null
        $ownerId = $vehicle->customer_id;

        $rentalRequest = RentalRequest::create([
            'vehicle_id' => $vehicle->id,
            'renter_id' => $renterId,
            'owner_id' => $ownerId,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'renter_contact' => $validated['renter_contact'] ?? null,
            'pickup_location' => $validated['pickup_location'] ?? null,
            'service_link' => $validated['service_link'] ?? null,
            'status' => 'Pending',
            'total_cost' => $totalCost,
            'payment_status' => 'Unpaid',
        ]);

        // Notify renter
        $vehicleName = $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model);
        notifyRentalUpdate($renterId, $rentalRequest, 'Pending', $vehicleName);

        if (!empty($ownerId)) {
            $renterName = trim((string) (Auth::guard('customer')->user()?->name ?? 'A renter'));
            $dateDetails = '';
            if (!empty($validated['start_date']) && !empty($validated['end_date'])) {
                $dateDetails = ' Rental period: ' . $validated['start_date'] . ' to ' . $validated['end_date'] . '.';
            }

            createNotification(
                (int) $ownerId,
                'rental_update',
                'New Rental Request',
                $renterName . ' requested to rent your vehicle ' . $vehicleName . '.' . $dateDetails,
                'info',
                route('customer.rentals'),
                'View Request',
                $rentalRequest->id,
                'RentalRequest'
            );
        }

        event(new RentalStatusUpdated($rentalRequest->fresh()));

        return redirect()->back()->with('success', 'Rental request sent!');
    }

    /**
     * Approve a rental request
     */
    public function approve(RentalRequest $request)
    {
        $customerId = Auth::guard('customer')->id();
        if ($request->owner_id !== $customerId) {
            abort(403, 'Unauthorized');
        }

        if ($request->status !== 'Pending') {
            return redirect()->back()->with('error', 'This request is already processed.');
        }

        $vehicle = $request->vehicle;
        if (!$vehicle || !empty($vehicle->rented_by_user_id)) {
            return redirect()->back()->with('error', 'Vehicle is no longer available.');
        }

        if ($request->start_date && $request->end_date) {
            if ($this->hasVehicleDateConflict((int) $request->vehicle_id, (string) $request->start_date, (string) $request->end_date, (int) $request->id)) {
                return redirect()->back()->with('error', 'Vehicle has conflicting reservations for the selected period.');
            }
        }

        $request->status = 'Approved';
        $request->approved_at = now();
        $request->save();

        $vehicle->is_listed_for_rent = false;
        $vehicle->save();

        // Notify renter
        $vehicleName = $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model);
        notifyRentalUpdate($request->renter_id, $request, 'Approved', $vehicleName);

        event(new RentalStatusUpdated($request->fresh()));

        return redirect()->back()->with('success', 'Rental request approved.');
    }

    /**
     * Reject a rental request
     */
    public function reject(RentalRequest $request)
    {
        $customerId = Auth::guard('customer')->id();
        if ($request->owner_id !== $customerId) {
            abort(403, 'Unauthorized');
        }

        if ($request->status !== 'Pending') {
            return redirect()->back()->with('error', 'This request is already processed.');
        }

        $request->status = 'Rejected';
        $request->save();

        $vehicle = $request->vehicle;
        $vehicleName = $vehicle ? ($vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model)) : 'requested vehicle';
        notifyRentalUpdate($request->renter_id, $request, 'Rejected', $vehicleName);

        event(new RentalStatusUpdated($request->fresh()));

        return redirect()->back()->with('success', 'Rental request rejected.');
    }

    /**
     * Mark rental as paid
     */
    public function pay(RentalRequest $request)
    {
        $customerId = Auth::guard('customer')->id();
        if ($request->renter_id !== $customerId) {
            abort(403, 'Unauthorized');
        }

        if ($request->status !== 'Approved') {
            return redirect()->back()->with('error', 'Only approved rentals can be paid.');
        }

        $request->payment_status = 'Paid';
        $request->save();

        event(new RentalStatusUpdated($request->fresh()));

        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }

    /**
     * Mark rental as returned (owner)
     */
    public function markReturned(RentalRequest $request)
    {
        $customerId = Auth::guard('customer')->id();
        if ($request->owner_id !== $customerId) {
            abort(403, 'Unauthorized');
        }

        if ($request->status !== 'Approved') {
            return redirect()->back()->with('error', 'Only approved rentals can be returned.');
        }

        $request->status = 'Completed';
        $request->returned_at = now();
        $request->save();

        $vehicle = $request->vehicle;
        if ($vehicle) {
            $vehicle->rented_by_user_id = null;
            $vehicle->save();
        }

        event(new RentalStatusUpdated($request->fresh()));

        return redirect()->back()->with('success', 'Rental marked as returned.');
    }

    private function mapGatewayStatusToRentalStatus(string $status): string
    {
        $normalized = strtolower($status);

        if ($normalized === 'paid') {
            return 'Paid';
        }

        return 'Unpaid';
    }

    private function hasVehicleDateConflict(int $vehicleId, string $startDate, string $endDate, ?int $excludeRequestId = null): bool
    {
        $activeRequestStatuses = ['Pending', 'Approved', 'Ready for Pickup', 'Picked Up', 'In Use', 'Returned'];

        $requestConflict = RentalRequest::query()
            ->where('vehicle_id', $vehicleId)
            ->whereIn('status', $activeRequestStatuses)
            ->whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->when($excludeRequestId, function ($query) use ($excludeRequestId) {
                $query->where('id', '!=', $excludeRequestId);
            })
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
}
