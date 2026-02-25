<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\RentalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RentalOperationsController extends Controller
{
    /**
     * Display assigned rentals dashboard
     */
    public function index()
    {
        $staffId = Auth::id();
        
        $rentals = RentalRequest::with(['vehicle', 'renter', 'owner'])
            ->where('assigned_staff_id', $staffId)
            ->whereNotIn('status', ['Completed', 'Cancelled', 'Rejected'])
            ->orderBy('start_date', 'asc')
            ->get();

        $stats = [
            'assigned_rentals' => RentalRequest::where('assigned_staff_id', $staffId)
                ->whereNotIn('status', ['Completed', 'Cancelled', 'Rejected'])
                ->count(),
            'ready_for_pickup' => RentalRequest::where('assigned_staff_id', $staffId)
                ->where('status', 'Ready for Pickup')
                ->count(),
            'active_rentals' => RentalRequest::where('assigned_staff_id', $staffId)
                ->whereIn('status', ['Picked Up', 'In Use'])
                ->count(),
            'awaiting_return' => RentalRequest::where('assigned_staff_id', $staffId)
                ->where('status', 'In Use')
                ->where('end_date', '<=', now()->addDays(2))
                ->count(),
        ];

        return view('staff.rentals.index', compact('rentals', 'stats'));
    }

    /**
     * Display inspection form
     */
    public function showInspection(RentalRequest $rental)
    {
        if ($rental->assigned_staff_id !== Auth::id()) {
            abort(403, 'Not authorized to inspect this rental');
        }

        return view('staff.rentals.inspection', compact('rental'));
    }

    /**
     * Store pre-rental inspection
     */
    public function storePreInspection(Request $request, RentalRequest $rental)
    {
        if ($rental->assigned_staff_id !== Auth::id()) {
            abort(403, 'Not authorized');
        }

        if (!$this->isPaidStatus($rental->payment_status)) {
            return back()->with('error', 'Payment must be completed before inspection.');
        }

        $validated = $request->validate([
            'pre_inspection_notes' => 'required|string',
            'pre_inspection_images.*' => 'nullable|image|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('pre_inspection_images')) {
            foreach ($request->file('pre_inspection_images') as $image) {
                $imagePaths[] = $image->store('rentals/inspections', 'public');
            }
        }

        $rental->update([
            'pre_inspection_notes' => $validated['pre_inspection_notes'],
            'pre_inspection_images' => json_encode($imagePaths),
            'status' => 'Ready for Pickup',
            'ready_for_pickup_at' => now(),
        ]);

        // Notify renter
        $vehicleName = $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model);
        createNotification(
            $rental->renter_id,
            'rental_update',
            'Vehicle Ready for Pickup',
            "Your rental vehicle {$vehicleName} has been inspected and is ready for pickup!",
            'success',
            route('customer.rentals')
        );

        return back()->with('success', 'Pre-inspection completed! Vehicle is ready for pickup.');
    }

    /**
     * Mark vehicle as picked up
     */
    public function markPickedUp(RentalRequest $rental)
    {
        if ($rental->assigned_staff_id !== Auth::id()) {
            abort(403, 'Not authorized');
        }

        if (!$this->isPaidStatus($rental->payment_status)) {
            return back()->with('error', 'Payment must be completed before pickup.');
        }

        $rental->update([
            'status' => 'Picked Up',
            'picked_up_at' => now(),
        ]);

        // Lock vehicle availability
        $rental->vehicle->update([
            'rented_by_user_id' => $rental->renter_id,
        ]);

        // Notify renter
        $vehicleName = $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model);
        createNotification(
            $rental->renter_id,
            'rental_update',
            'Vehicle Picked Up',
            "You have picked up {$vehicleName}. Enjoy your rental!",
            'info',
            route('customer.rentals')
        );

        return back()->with('success', 'Vehicle marked as picked up!');
    }

    /**
     * Update rental status during use
     */
    public function updateStatus(Request $request, RentalRequest $rental)
    {
        if ($rental->assigned_staff_id !== Auth::id()) {
            abort(403, 'Not authorized');
        }

        $validated = $request->validate([
            'status' => 'required|in:In Use,Returned',
            'notes' => 'nullable|string',
        ]);

        $rental->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status updated successfully!');
    }

    /**
     * Store post-rental inspection
     */
    public function storePostInspection(Request $request, RentalRequest $rental)
    {
        if ($rental->assigned_staff_id !== Auth::id()) {
            abort(403, 'Not authorized');
        }

        $validated = $request->validate([
            'post_inspection_notes' => 'required|string',
            'has_damage' => 'boolean',
            'damage_description' => 'required_if:has_damage,true|nullable|string',
            'damage_charge' => 'required_if:has_damage,true|nullable|numeric|min:0',
            'post_inspection_images.*' => 'nullable|image|max:2048',
        ]);

        $hasDamage = (bool) ($validated['has_damage'] ?? false);
        $damageCharge = $hasDamage ? (float) ($validated['damage_charge'] ?? 0) : 0.0;

        $imagePaths = [];
        if ($request->hasFile('post_inspection_images')) {
            foreach ($request->file('post_inspection_images') as $image) {
                $imagePaths[] = $image->store('rentals/inspections', 'public');
            }
        }

        $rental->update([
            'post_inspection_notes' => $validated['post_inspection_notes'],
            'post_inspection_images' => json_encode($imagePaths),
            'has_damage' => $hasDamage,
            'damage_description' => $validated['damage_description'] ?? null,
            'damage_charge' => $hasDamage ? $damageCharge : null,
            'damage_payment_status' => $hasDamage && $damageCharge > 0 ? 'Unpaid' : 'Not Required',
            'damage_paid_at' => null,
            'status' => 'Returned',
            'returned_at' => now(),
        ]);

        $linkedRental = $rental->rental;

        if ($linkedRental) {
            $linkedRental->update([
                'damage_charge' => $hasDamage ? $damageCharge : null,
                'damage_notes' => $validated['damage_description'] ?? null,
                'damage_invoice_generated_at' => $hasDamage ? now() : null,
            ]);
        }

        // Release vehicle
        $rental->vehicle->update([
            'rented_by_user_id' => null,
        ]);

        // Notify renter
        $vehicleName = $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model);
        if ($validated['has_damage'] ?? false) {
            createNotification(
                $rental->renter_id,
                'rental_update',
                'Vehicle Returned - Damage Noted',
                "Your rental {$vehicleName} has been returned with damage noted. Please pay the damage estimate to complete this rental.",
                'warning',
                route('customer.rentals')
            );
        } else {
            createNotification(
                $rental->renter_id,
                'rental_update',
                'Vehicle Returned Successfully',
                "Your rental {$vehicleName} has been returned in good condition. Thank you!",
                'success',
                route('customer.rentals')
            );
        }

        return back()->with('success', 'Post-inspection completed! Rental marked as returned.');
    }

    /**
     * Complete rental (no issues)
     */
    public function completeRental(RentalRequest $rental)
    {
        if ($rental->assigned_staff_id !== Auth::id()) {
            abort(403, 'Not authorized');
        }

        if ($rental->status !== 'Returned') {
            return back()->with('error', 'Vehicle must be returned before completing rental.');
        }

        if ($rental->has_damage && !$this->isPaidStatus($rental->damage_payment_status)) {
            return back()->with('error', 'Damage payment must be completed before closing this rental.');
        }

        $rental->update([
            'status' => 'Completed',
        ]);

        return back()->with('success', 'Rental completed successfully!');
    }

    /**
     * View rental history
     */
    public function history()
    {
        $staffId = Auth::id();
        
        $rentals = RentalRequest::with(['vehicle', 'renter', 'owner'])
            ->where('assigned_staff_id', $staffId)
            ->whereIn('status', ['Completed', 'Cancelled'])
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('staff.rentals.history', compact('rentals'));
    }

    private function isPaidStatus(?string $status): bool
    {
        return strtolower((string) $status) === 'paid';
    }
}
