<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rental;
use App\Models\RentalRequest;
use App\Models\ServiceBooking;
use App\Models\Earning;
use App\Services\Payments\EsewaService;
use App\Services\Payments\CommissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct(
        private readonly EsewaService $esewaService,
        private readonly CommissionService $commissionService
    )
    {
        $this->middleware('multi.auth')->except(['esewaSuccess', 'esewaFailure']);
    }

    public function setServiceAmount(Request $request, ServiceBooking $booking)
    {
        $request->validate([
            'service_cost' => 'required|numeric|min:0',
            'spare_parts_cost' => 'nullable|numeric|min:0',
        ]);

        $booking->loadMissing('parts');
        $partsTotal = (float) $booking->parts->sum('pivot.total_cost');
        $sparePartsCost = (float) ($request->input('spare_parts_cost', 0));
        $serviceCost = (float) $request->input('service_cost');
        $total = round($serviceCost + $sparePartsCost + $partsTotal, 2);

        $booking->update([
            'service_cost' => $serviceCost,
            'spare_parts_cost' => $sparePartsCost,
            'total_amount' => $total,
            'payment_status' => 'pending',
            'status' => $booking->status === 'Pending' ? 'Approved' : $booking->status,
        ]);

        return back()->with('success', 'Service charges updated successfully.');
    }

    public function payService(ServiceBooking $booking)
    {
        $this->ensureCustomer();
        $this->assertBookingOwner($booking);

        $booking->loadMissing('parts');
        $partsTotal = (float) $booking->parts->sum('pivot.total_cost');
        $serviceCost = (float) ($booking->service_cost ?? 0);
        $sparePartsCost = (float) ($booking->spare_parts_cost ?? 0);
        $totalAmount = round($serviceCost + $sparePartsCost + $partsTotal, 2);

        if ((float) ($booking->total_amount ?? 0) !== $totalAmount) {
            $booking->forceFill(['total_amount' => $totalAmount])->save();
        }

        if ($totalAmount <= 0) {
            return back()->with('error', 'Service amount is not ready for payment.');
        }

        if (($booking->payment_status ?? 'pending') === 'paid') {
            return back()->with('error', 'This service booking is already paid.');
        }

        $baseOrderId = 'service_booking:' . $booking->id;
        $this->closePreviousPendingAttempts($baseOrderId, (int) $booking->customer_id);

        $payment = Payment::create([
            'user_id' => $booking->customer_id,
            'order_id' => $this->newOrderIdForAttempt($baseOrderId),
            'type' => 'service',
            'amount' => $totalAmount,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.esewa.redirect', $payment);
    }

    public function payRental(Rental $rental)
    {
        $this->ensureCustomer();
        $this->assertRentalRenter($rental);

        if ($rental->status !== 'pending') {
            return back()->with('error', 'Only pending rentals are payable.');
        }

        $type = $rental->owner_id ? 'marketplace_rental' : 'admin_rental';
        $baseOrderId = $type . ':' . $rental->id;
        $this->closePreviousPendingAttempts($baseOrderId, (int) $rental->renter_id);

        $payment = Payment::create([
            'user_id' => $rental->renter_id,
            'order_id' => $this->newOrderIdForAttempt($baseOrderId),
            'type' => $type,
            'amount' => $rental->total_amount,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.esewa.redirect', $payment);
    }

    public function payRentalRequest(RentalRequest $request)
    {
        $this->ensureCustomer();

        $user = getAuthenticatedUser();
        if ((int) $request->renter_id !== (int) $user?->id) {
            abort(403, 'Unauthorized rental payment.');
        }

        if ($request->status !== 'Approved') {
            return back()->with('error', 'Only approved rentals can be paid.');
        }

        if ($request->payment_status === 'Paid') {
            return back()->with('error', 'This rental is already paid.');
        }

        if ((float) ($request->total_cost ?? 0) <= 0) {
            return back()->with('error', 'Rental amount is not ready for payment.');
        }

        $type = $request->owner_id ? 'marketplace_rental' : 'admin_rental';
        $baseOrderId = 'rental_request:' . $request->id;
        $this->closePreviousPendingAttempts($baseOrderId, (int) $request->renter_id);

        $payment = Payment::create([
            'user_id' => $request->renter_id,
            'order_id' => $this->newOrderIdForAttempt($baseOrderId),
            'type' => $type,
            'amount' => $request->total_cost,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.esewa.redirect', $payment);
    }

    public function payRentalDamage(RentalRequest $request)
    {
        $this->ensureCustomer();

        $user = getAuthenticatedUser();
        if ((int) $request->renter_id !== (int) $user?->id) {
            abort(403, 'Unauthorized damage payment.');
        }

        if ($request->status !== 'Returned') {
            return back()->with('error', 'Damage payments are available after return inspection.');
        }

        if (!$request->has_damage || (float) ($request->damage_charge ?? 0) <= 0) {
            return back()->with('error', 'No damage charges are due for this rental.');
        }

        if ($request->damage_payment_status === 'Paid') {
            return back()->with('error', 'Damage charges are already paid.');
        }

        $baseOrderId = 'rental_damage:' . $request->id;
        $this->closePreviousPendingAttempts($baseOrderId, (int) $request->renter_id);

        $payment = Payment::create([
            'user_id' => $request->renter_id,
            'order_id' => $this->newOrderIdForAttempt($baseOrderId),
            'type' => 'rental_damage',
            'amount' => $request->damage_charge,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.esewa.redirect', $payment);
    }

    public function redirectToEsewa(Payment $payment)
    {
        $user = getAuthenticatedUser();
        if ((int) $payment->user_id !== (int) $user?->id) {
            abort(403, 'Unauthorized payment access.');
        }

        try {
            $payload = $this->esewaService->buildPaymentPayload($payment);
        } catch (\RuntimeException $exception) {
            return redirect()->route('index')->with('error', $exception->getMessage());
        }

        return response()->view('payments.esewa-redirect', [
            'endpoint' => $payload['endpoint'],
            'fields' => $payload['fields'],
            'payment' => $payment,
        ]);
    }

    public function receipt(Payment $payment)
    {
        $this->ensureCustomer();

        $user = getAuthenticatedUser();
        if ((int) $payment->user_id !== (int) $user?->id) {
            abort(403, 'Unauthorized payment access.');
        }

        if (strtolower((string) $payment->status) !== 'paid') {
            return redirect()->back()->with('error', 'Receipt is available only for paid transactions.');
        }

        [$prefix, $entityId] = $this->parseOrderEntity($payment->order_id);
        $entity = null;

        if ($prefix === 'service_booking' && $entityId > 0) {
            $entity = ServiceBooking::with('parts')->find($entityId);
        }

        if ($prefix === 'rental_request' && $entityId > 0) {
            $entity = RentalRequest::with(['vehicle', 'owner'])->find($entityId);
        }

        if (in_array($prefix, ['admin_rental', 'marketplace_rental'], true) && $entityId > 0) {
            $entity = Rental::with(['vehicle', 'owner'])->find($entityId);
        }

        if ($prefix === 'rental_damage' && $entityId > 0) {
            $entity = RentalRequest::with(['vehicle', 'owner'])->find($entityId);
        }

        return view('payments.receipt', [
            'payment' => $payment,
            'prefix' => $prefix,
            'entity' => $entity,
        ]);
    }

    public function esewaSuccess(Request $request)
    {
        Log::info('eSewa success callback', ['payload' => $request->all()]);

        $decoded = $this->esewaService->parseSuccessPayload($request->input('data'));
        $orderId = (string) ($decoded['transaction_uuid'] ?? $request->input('transaction_uuid', ''));

        if ($orderId === '') {
            return redirect()->route('index')->with('error', 'Invalid payment callback payload.');
        }

        $payment = Payment::where('order_id', $orderId)->first();
        if (!$payment) {
            return redirect()->route('index')->with('error', 'Payment record not found.');
        }

        $verification = $this->esewaService->verifyTransaction($orderId, (string) $payment->amount);

        DB::transaction(function () use ($payment, $verification, $decoded): void {
            if (!$verification['verified']) {
                $payment->update([
                    'status' => 'failed',
                    'gateway_response' => $verification['response'],
                ]);
                return;
            }

            $payment->update([
                'status' => 'paid',
                'transaction_id' => $decoded['transaction_code'] ?? ($decoded['reference_id'] ?? null),
                'gateway_response' => $verification['response'],
                'paid_at' => now(),
            ]);

            $this->applyBusinessStateAfterPayment($payment);
        });

        if ($payment->fresh()->status !== 'paid') {
            return response()->view('payments.status', [
                'status' => 'failed',
                'message' => 'Payment verification failed. Please try again or contact support.',
                'payment' => $payment->fresh(),
            ]);
        }

        return response()->view('payments.status', [
            'status' => 'success',
            'message' => 'Payment completed successfully.',
            'payment' => $payment->fresh(),
        ]);
    }

    public function esewaFailure(Request $request)
    {
        Log::warning('eSewa failure callback', ['payload' => $request->all()]);

        $decoded = $this->esewaService->parseSuccessPayload($request->input('data'));
        $orderId = (string) ($request->input('transaction_uuid') ?? $decoded['transaction_uuid'] ?? '');
        $payment = null;
        if ($orderId !== '') {
            Payment::where('order_id', $orderId)->update([
                'status' => 'failed',
                'gateway_response' => $request->all(),
            ]);
            $payment = Payment::where('order_id', $orderId)->first();
        }

        return response()->view('payments.status', [
            'status' => 'failed',
            'message' => 'Payment was cancelled or failed.',
            'payment' => $payment,
        ]);
    }

    private function applyBusinessStateAfterPayment(Payment $payment): void
    {
        [$prefix, $id] = array_pad(explode(':', $payment->order_id), 2, null);
        $entityId = (int) $id;

        if ($prefix === 'service_booking') {
            $booking = ServiceBooking::find($entityId);
            if ($booking) {
                $booking->update([
                    'payment_status' => 'paid',
                    'status' => 'Paid',
                ]);
            }

            return;
        }

        if (in_array($prefix, ['admin_rental', 'marketplace_rental'], true)) {
            $rental = Rental::with('vehicle')->find($entityId);
            if (!$rental) {
                return;
            }

            $rental->update(['status' => 'confirmed']);

            if ($rental->vehicle) {
                $rental->vehicle->update([
                    'rented_by_user_id' => $rental->renter_id,
                ]);
            }
        }

        if ($prefix === 'rental_request') {
            $rentalRequest = RentalRequest::with('vehicle')->find($entityId);
            if (!$rentalRequest) {
                return;
            }

            $rentalRequest->update([
                'payment_status' => 'Paid',
            ]);

            if ($rentalRequest->vehicle) {
                $rentalRequest->vehicle->update([
                    'rented_by_user_id' => $rentalRequest->renter_id,
                    'is_listed_for_rent' => false,
                ]);
            }

            $totalAmount = (float) ($rentalRequest->total_cost ?? 0);
            $commissionAmount = 0.0;
            $ownerEarning = $totalAmount;

            if ($rentalRequest->owner_id) {
                $split = $this->commissionService->calculateMarketplaceSplit($totalAmount);
                $commissionAmount = $split['commission'];
                $ownerEarning = $split['owner_earning'];
            }

            $rental = Rental::updateOrCreate(
                ['rental_request_id' => $rentalRequest->id],
                [
                    'vehicle_id' => $rentalRequest->vehicle_id,
                    'owner_id' => $rentalRequest->owner_id,
                    'renter_id' => $rentalRequest->renter_id,
                    'start_date' => $rentalRequest->start_date,
                    'end_date' => $rentalRequest->end_date,
                    'number_of_days' => $rentalRequest->start_date && $rentalRequest->end_date
                        ? (max(1, \Carbon\Carbon::parse($rentalRequest->start_date)->diffInDays(\Carbon\Carbon::parse($rentalRequest->end_date)) + 1))
                        : 1,
                    'total_amount' => $totalAmount,
                    'commission_amount' => $commissionAmount,
                    'owner_earning' => $ownerEarning,
                    'status' => 'confirmed',
                ]
            );

            // Create earning record for marketplace rentals
            if ($rentalRequest->owner_id && $rental->wasRecentlyCreated) {
                Earning::create([
                    'owner_id' => $rentalRequest->owner_id,
                    'rental_id' => $rental->id,
                    'commission' => $commissionAmount,
                    'owner_amount' => $ownerEarning,
                    'payout_status' => 'pending',
                ]);
            }

            return;
        }

        if ($prefix === 'rental_damage') {
            $rentalRequest = RentalRequest::find($entityId);
            if (!$rentalRequest) {
                return;
            }

            $rentalRequest->update([
                'damage_payment_status' => 'Paid',
                'damage_paid_at' => now(),
            ]);

            $linkedRental = $rentalRequest->rental;
            if ($linkedRental) {
                $linkedRental->update([
                    'damage_charge' => $rentalRequest->damage_charge,
                    'damage_notes' => $rentalRequest->damage_description,
                ]);

                // If this is a marketplace rental, deduct damage from owner earning
                if ($linkedRental->owner_id) {
                    $earning = Earning::where('rental_id', $linkedRental->id)->first();
                    if ($earning) {
                        $damageAmount = (float) ($rentalRequest->damage_charge ?? 0);
                        $newOwnerAmount = max(0, $earning->owner_amount - $damageAmount);
                        $earning->update([
                            'owner_amount' => $newOwnerAmount,
                        ]);
                    }
                }
            }
        }
    }

    private function ensureCustomer(): void
    {
        if (getAuthenticatedUserRole() !== 'customer') {
            abort(403, 'Only customers can perform this payment action.');
        }
    }

    private function assertBookingOwner(ServiceBooking $booking): void
    {
        $user = getAuthenticatedUser();
        if ((int) $booking->customer_id !== (int) $user?->id) {
            abort(403, 'Unauthorized booking payment.');
        }
    }

    private function assertRentalRenter(Rental $rental): void
    {
        $user = getAuthenticatedUser();
        if ((int) $rental->renter_id !== (int) $user?->id) {
            abort(403, 'Unauthorized rental payment.');
        }
    }

    private function newOrderIdForAttempt(string $baseOrderId): string
    {
        return $baseOrderId . ':' . now()->format('YmdHis') . Str::upper(Str::random(6));
    }

    private function parseOrderEntity(string $orderId): array
    {
        $parts = explode(':', $orderId);
        $prefix = (string) ($parts[0] ?? '');
        $entityId = (int) ($parts[1] ?? 0);

        return [$prefix, $entityId];
    }

    private function closePreviousPendingAttempts(string $baseOrderId, int $userId): void
    {
        Payment::where('user_id', $userId)
            ->where('status', 'pending')
            ->where(function ($query) use ($baseOrderId) {
                $query->where('order_id', $baseOrderId)
                    ->orWhere('order_id', 'like', $baseOrderId . ':%');
            })
            ->update([
                'status' => 'failed',
                'gateway_response' => ['message' => 'Replaced by a newer payment attempt.'],
            ]);
    }
}
