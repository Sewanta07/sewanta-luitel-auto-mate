<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events\RentalStatusUpdated;
use App\Models\Vehicle;
use App\Models\OwnerVehicle;
use App\Models\RentalRequest;
use App\Models\Payment;
use App\Models\StaffMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentalManagementController extends Controller
{
    /**
     * Display rental dashboard
     */
    public function dashboard()
    {
        $totalRevenue = Payment::whereIn('type', ['admin_rental', 'marketplace_rental'])
            ->where('status', 'paid')
            ->sum('amount');

        $stats = [
            'total_vehicles' => Vehicle::where('is_listed_for_rent', true)->count(),
            'active_rentals' => RentalRequest::whereIn('status', ['Approved', 'Ready for Pickup', 'Picked Up', 'In Use'])->count(),
            'pending_requests' => RentalRequest::where('status', 'Pending')->count(),
            'pending_listings' => Vehicle::where('listing_status', 'pending')->count(),
            'total_revenue' => $totalRevenue,
        ];

        $recentRentals = RentalRequest::with(['vehicle', 'renter', 'owner'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.rentals.dashboard', compact('stats', 'recentRentals'));
    }

    /**
     * Manage service center rental vehicles + approved customer-listed vehicles
     */
    public function vehicles()
    {
        // Get both admin-owned vehicles and approved customer-listed vehicles
        $vehicles = Vehicle::where(function ($query) {
            $query->where('is_service_center_vehicle', true)  // Admin-owned
                  ->orWhere(function ($q) {
                      // Customer-listed that are approved
                      $q->where('is_listed_for_rent', true)
                        ->where('listing_status', 'approved')
                        ->whereNotNull('customer_id');
                  });
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.rentals.vehicles', compact('vehicles'));
    }

    /**
     * Store new service center rental vehicle
     */
    public function storeVehicle(Request $request)
    {
        $validated = $request->validate([
            'vehicle_name' => 'required|string|max:100',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'plate_number' => 'required|string|unique:vehicles,plate_number',
            'vehicle_type' => 'required|string|in:Car,Bike,SUV',
            'fuel_type' => 'required|string|in:Petrol,Diesel,Electric,Hybrid',
            'transmission_type' => 'required|string|in:Automatic,Manual',
            'daily_rate' => 'required|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'rental_rules' => 'nullable|string',
            'vehicle_image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('vehicle_image')) {
            $imagePath = $request->file('vehicle_image')->store('vehicles/rental', 'public');
        }

        Vehicle::create([
            'customer_id' => null,
            'is_service_center_vehicle' => true,
            'vehicle_name' => $validated['vehicle_name'],
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'plate_number' => strtoupper($validated['plate_number']),
            'vehicle_type' => $validated['vehicle_type'],
            'fuel_type' => $validated['fuel_type'],
            'transmission_type' => $validated['transmission_type'],
            'daily_rate' => $validated['daily_rate'],
            'security_deposit' => $validated['security_deposit'] ?? null,
            'rental_rules' => $validated['rental_rules'] ?? null,
            'image_path' => $imagePath,
            'is_listed_for_rent' => true,
            'listing_status' => 'approved',
        ]);

        return back()->with('success', 'Rental vehicle added successfully!');
    }

    /**
     * Update service center vehicle
     */
    public function updateVehicle(Request $request, Vehicle $vehicle)
    {
        if (!$vehicle->is_service_center_vehicle) {
            abort(403, 'Cannot edit customer vehicles here');
        }

        $validated = $request->validate([
            'vehicle_name' => 'required|string|max:100',
            'daily_rate' => 'required|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'rental_rules' => 'nullable|string',
            'is_listed_for_rent' => 'boolean',
        ]);

        $vehicle->update($validated);

        return back()->with('success', 'Vehicle updated successfully!');
    }

    /**
     * Delete service center vehicle
     */
    public function destroyVehicle(Vehicle $vehicle)
    {
        if (!$vehicle->is_service_center_vehicle) {
            abort(403, 'Cannot delete customer vehicles here');
        }

        if ($vehicle->image_path && Storage::disk('public')->exists($vehicle->image_path)) {
            Storage::disk('public')->delete($vehicle->image_path);
        }

        $vehicle->delete();

        return back()->with('success', 'Vehicle removed successfully!');
    }

    /**
     * Manage customer-listed vehicles awaiting approval
     */
    public function pendingListings()
    {
        $vehicles = Vehicle::with('customer')
            ->where('is_service_center_vehicle', false)
            ->where('listing_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.rentals.pending-listings', compact('vehicles'));
    }

    /**
     * Approve customer vehicle listing
     */
    public function approveVehicleListing(Vehicle $vehicle)
    {
        if ((float) ($vehicle->daily_rate ?? 0) <= 0) {
            return back()->with('error', 'Vehicle cannot be approved without a valid daily rate.');
        }

        $vehicle->update([
            'listing_status' => 'approved',
            'listing_approved_at' => now(),
            'is_listed_for_rent' => true,
        ]);

        OwnerVehicle::updateOrCreate(
            ['vehicle_id' => $vehicle->id],
            [
                'owner_id' => $vehicle->customer_id,
                'daily_rate' => $vehicle->daily_rate,
                'approval_status' => 'approved',
                'is_available' => true,
                'approval_note' => null,
                'approved_at' => now(),
            ]
        );

        // Notify owner
        if ($vehicle->customer_id) {
            $vehicleName = $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model);
            createNotification(
                $vehicle->customer_id,
                'rental_update',
                'Vehicle Listing Approved',
                "Your vehicle {$vehicleName} has been approved for rental listing!",
                'success',
                route('customer.vehicles')
            );
        }

        return back()->with('success', 'Vehicle listing approved!');
    }

    /**
     * Reject customer vehicle listing
     */
    public function rejectVehicleListing(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $vehicle->update([
            'listing_status' => 'rejected',
            'listing_rejection_reason' => $validated['rejection_reason'],
            'is_listed_for_rent' => false,
        ]);

        OwnerVehicle::where('vehicle_id', $vehicle->id)->update([
            'approval_status' => 'rejected',
            'is_available' => false,
            'approval_note' => $validated['rejection_reason'],
            'approved_at' => null,
        ]);

        // Notify owner
        if ($vehicle->customer_id) {
            $vehicleName = $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model);
            createNotification(
                $vehicle->customer_id,
                'rental_update',
                'Vehicle Listing Rejected',
                "Your vehicle {$vehicleName} listing was rejected. Reason: {$validated['rejection_reason']}",
                'error',
                route('customer.vehicles')
            );
        }

        return back()->with('success', 'Vehicle listing rejected.');
    }

    /**
     * Manage all rental requests
     */
    public function requests()
    {
        $requests = RentalRequest::with(['vehicle', 'renter', 'owner', 'assignedStaff'])
            ->orderBy('created_at', 'desc')
            ->get();

        $staff = StaffMember::where('status', 'active')->get();

        return view('admin.rentals.requests', compact('requests', 'staff'));
    }

    /**
     * Approve rental request
     */
    public function approveRequest(RentalRequest $request)
    {
        // Check if vehicle still exists
        if (!$request->vehicle) {
            return back()->with('error', 'Cannot approve: vehicle no longer exists.');
        }

        $request->update([
            'status' => 'Approved',
            'approved_at' => now(),
        ]);

        // Notify renter
        $vehicleName = $request->vehicle->vehicle_name ?: ($request->vehicle->brand . ' ' . $request->vehicle->model);
        notifyRentalUpdate($request->renter_id, $request, 'Approved', $vehicleName);

        event(new RentalStatusUpdated($request->fresh()));

        return back()->with('success', 'Rental request approved!');
    }

    /**
     * Reject rental request
     */
    public function rejectRequest(Request $requestData, RentalRequest $rental)
    {
        $validated = $requestData->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $rental->update([
            'status' => 'Rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        // Notify renter
        $vehicleName = $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model);
        createNotification(
            $rental->renter_id,
            'rental_update',
            'Rental Request Rejected',
            "Your rental request for {$vehicleName} was rejected. Reason: {$validated['rejection_reason']}",
            'error',
            route('customer.rentals')
        );

        event(new RentalStatusUpdated($rental->fresh()));

        return back()->with('success', 'Rental request rejected.');
    }

    /**
     * Assign staff to rental
     */
    public function assignStaff(Request $request, RentalRequest $rental)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff_members,id',
        ]);

        $rental->update([
            'assigned_staff_id' => $validated['staff_id'],
        ]);

        event(new RentalStatusUpdated($rental->fresh()));

        return back()->with('success', 'Staff assigned to rental!');
    }

    /**
     * Rental reports
     */
    public function reports()
    {
        $totalRentals = RentalRequest::count();
        $completedRentals = RentalRequest::where('status', 'Completed')->count();
        $activeRentals = RentalRequest::whereIn('status', ['Approved', 'Ready for Pickup', 'Picked Up', 'In Use'])->count();
        $totalRevenue = RentalRequest::where('payment_status', 'Paid')->sum('total_cost');
        $damageReports = RentalRequest::where('has_damage', true)->count();

        $recentRentals = RentalRequest::with(['vehicle', 'renter', 'owner'])
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return view('admin.rentals.reports', compact(
            'totalRentals',
            'completedRentals',
            'activeRentals',
            'totalRevenue',
            'damageReports',
            'recentRentals'
        ));
    }
}
