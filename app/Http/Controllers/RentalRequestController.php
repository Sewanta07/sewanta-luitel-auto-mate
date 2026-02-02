<?php

namespace App\Http\Controllers;

use App\Models\RentalRequest;
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
        $requests = RentalRequest::with('vehicle')
            ->where('renter_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('customer.rentals', compact('requests'));
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
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        if (!$vehicle->is_listed_for_rent || !empty($vehicle->rented_by_user_id)) {
            return redirect()->back()->with('error', 'This vehicle is not available for rent.');
        }

        if ($vehicle->customer_id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot rent your own vehicle.');
        }

        $totalCost = null;
        if (!empty($validated['start_date']) && !empty($validated['end_date']) && $vehicle->daily_rate !== null) {
            $days = max(1, (new \Carbon\Carbon($validated['start_date']))->diffInDays(new \Carbon\Carbon($validated['end_date'])) + 1);
            $totalCost = $days * $vehicle->daily_rate;
        }

        $rentalRequest = RentalRequest::create([
            'vehicle_id' => $vehicle->id,
            'renter_id' => Auth::id(),
            'owner_id' => $vehicle->customer_id,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'status' => 'Pending',
            'total_cost' => $totalCost,
            'payment_status' => 'Unpaid',
        ]);

        // Notify renter
        $vehicleName = $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model);
        notifyRentalUpdate(Auth::id(), $rentalRequest, 'Pending', $vehicleName);

        return redirect()->back()->with('success', 'Rental request sent!');
    }

    /**
     * Approve a rental request
     */
    public function approve(RentalRequest $request)
    {
        if ($request->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($request->status !== 'Pending') {
            return redirect()->back()->with('error', 'This request is already processed.');
        }

        $vehicle = $request->vehicle;
        if (!$vehicle || !empty($vehicle->rented_by_user_id)) {
            return redirect()->back()->with('error', 'Vehicle is no longer available.');
        }

        $request->status = 'Approved';
        $request->approved_at = now();
        $request->save();

        $vehicle->rented_by_user_id = $request->renter_id;
        $vehicle->is_listed_for_rent = false;
        $vehicle->save();

        // Notify renter
        $vehicleName = $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model);
        notifyRentalUpdate($request->renter_id, $request, 'Approved', $vehicleName);

        return redirect()->back()->with('success', 'Rental request approved.');
    }

    /**
     * Reject a rental request
     */
    public function reject(RentalRequest $request)
    {
        if ($request->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($request->status !== 'Pending') {
            return redirect()->back()->with('error', 'This request is already processed.');
        }

        $request->status = 'Rejected';
        $request->save();

        return redirect()->back()->with('success', 'Rental request rejected.');
    }

    /**
     * Mark rental as paid
     */
    public function pay(RentalRequest $request)
    {
        if ($request->renter_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($request->status !== 'Approved') {
            return redirect()->back()->with('error', 'Only approved rentals can be paid.');
        }

        $request->payment_status = 'Paid';
        $request->save();

        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }

    /**
     * Mark rental as returned (owner)
     */
    public function markReturned(RentalRequest $request)
    {
        if ($request->owner_id !== Auth::id()) {
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

        return redirect()->back()->with('success', 'Rental marked as returned.');
    }
}
