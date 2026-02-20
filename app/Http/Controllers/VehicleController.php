<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\ServiceBooking;
use App\Models\OwnerVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    protected function customerId(): ?int
    {
        return Auth::guard('customer')->id() ?? Auth::id();
    }

    /**
     * Show customer vehicles page
     */
    public function index()
    {
        $customerId = $this->customerId();

        if (!$customerId) {
            return redirect()->route('login');
        }

        // Get all vehicles for the customer
        $vehicles = Vehicle::with([
                'rentalRequests' => function ($query) {
                    $query->where('status', 'Pending');
                },
                'approvedRental',
            ])
            ->where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->get();

        $user = Auth::guard('customer')->user() ?? Auth::user();

        return view('customer.vehicles.index', compact('vehicles', 'user'));
    }

    /**
     * Show vehicles available for rent
     */
    public function rentIndex()
    {
        $customerId = $this->customerId();

        // Backfill missing owner_vehicles rows for already approved customer listings.
        $approvedCustomerVehicles = Vehicle::query()
            ->where('is_service_center_vehicle', false)
            ->whereNotNull('customer_id')
            ->where('is_listed_for_rent', true)
            ->where('listing_status', 'approved')
            ->whereNull('rented_by_user_id')
            ->get();

        foreach ($approvedCustomerVehicles as $approvedVehicle) {
            if ((float) ($approvedVehicle->daily_rate ?? 0) <= 0) {
                continue;
            }

            OwnerVehicle::updateOrCreate(
                ['vehicle_id' => $approvedVehicle->id],
                [
                    'owner_id' => $approvedVehicle->customer_id,
                    'daily_rate' => $approvedVehicle->daily_rate,
                    'approval_status' => 'approved',
                    'is_available' => true,
                    'approved_at' => now(),
                ]
            );
        }

        // Show admin-owned rentals and approved marketplace listings.
        $vehicles = Vehicle::query()
            ->with(['customer', 'images'])
            ->leftJoin('owner_vehicles as owner_listing', 'owner_listing.vehicle_id', '=', 'vehicles.id')
            ->select('vehicles.*')
            ->selectRaw('owner_listing.id as owner_vehicle_id')
            ->selectRaw('owner_listing.daily_rate as owner_daily_rate')
            ->where('vehicles.is_listed_for_rent', true)
            ->where('vehicles.listing_status', 'approved')
            ->whereNull('vehicles.rented_by_user_id')
            ->where(function ($query) use ($customerId) {
                $query
                    ->where(function ($adminVehicle) {
                        $adminVehicle
                            ->where('vehicles.is_service_center_vehicle', true)
                            ->whereNull('vehicles.customer_id');
                    })
                    ->orWhere(function ($marketplaceVehicle) use ($customerId) {
                        $marketplaceVehicle
                            ->where('vehicles.is_service_center_vehicle', false)
                            ->whereNotNull('vehicles.customer_id')
                            ->where('vehicles.customer_id', '!=', $customerId)
                            ->whereNotNull('owner_listing.id')
                            ->where('owner_listing.approval_status', 'approved')
                            ->where('owner_listing.is_available', true);
                    });
            })
            ->orderByDesc('vehicles.created_at')
            ->get();

        return view('customer.rent-vehicles', compact('vehicles'));
    }

    /**
     * Store a new vehicle
     */
    public function store(Request $request)
    {
        $customerId = $this->customerId();

        if (!$customerId) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'vehicle_name' => 'nullable|string|max:100',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'plate_number' => 'required|string|unique:vehicles,plate_number',
            'vehicle_type' => 'required|string|in:Car,Bike,SUV',
            'fuel_type' => 'required|string|in:Petrol,Diesel,Electric,Hybrid',
            'transmission_type' => 'required|string|in:Automatic,Manual',
            'daily_rate' => 'nullable|numeric|min:0',
            'vehicle_image' => 'nullable|image|max:2048',
            'vehicle_images' => 'nullable|array|max:10',
            'vehicle_images.*' => 'image|max:2048',
        ]);

        // Use first single image as primary if no multiple images uploaded
        $imagePath = null;
        if ($request->hasFile('vehicle_image')) {
            $imagePath = $request->file('vehicle_image')->store('vehicles', 'public');
        }

        $vehicle = Vehicle::create([
            'customer_id' => $customerId,
            'vehicle_name' => $validated['vehicle_name'] ?? null,
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'plate_number' => strtoupper($validated['plate_number']),
            'vehicle_type' => $validated['vehicle_type'],
            'fuel_type' => $validated['fuel_type'],
            'transmission_type' => $validated['transmission_type'],
            'image_path' => $imagePath,
            'daily_rate' => $validated['daily_rate'] ?? null,
        ]);

        // Store multiple images if provided
        if ($request->hasFile('vehicle_images')) {
            foreach ($request->file('vehicle_images') as $index => $image) {
                $path = $image->store('vehicles', 'public');
                $vehicle->images()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('customer.vehicles')
            ->with('success', 'Vehicle added successfully!');
    }

    /**
     * Show the form for editing a vehicle
     */
    public function edit(Vehicle $vehicle)
    {
        if ($vehicle->customer_id !== $this->customerId()) {
            abort(403, 'Unauthorized');
        }

        return view('customer.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update a vehicle
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->customer_id !== $this->customerId()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'vehicle_name' => 'nullable|string|max:100',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'plate_number' => 'required|string|unique:vehicles,plate_number,' . $vehicle->id,
            'vehicle_type' => 'required|string|in:Car,Bike,SUV',
            'fuel_type' => 'required|string|in:Petrol,Diesel,Electric,Hybrid',
            'transmission_type' => 'required|string|in:Automatic,Manual',
            'daily_rate' => 'nullable|numeric|min:0',
            'vehicle_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('vehicle_image')) {
            if ($vehicle->image_path) {
                Storage::disk('public')->delete($vehicle->image_path);
            }
            $vehicle->image_path = $request->file('vehicle_image')->store('vehicles', 'public');
        }

        $vehicle->update([
            'vehicle_name' => $validated['vehicle_name'] ?? null,
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'plate_number' => strtoupper($validated['plate_number']),
            'vehicle_type' => $validated['vehicle_type'],
            'fuel_type' => $validated['fuel_type'],
            'transmission_type' => $validated['transmission_type'],
            'daily_rate' => $validated['daily_rate'] ?? null,
        ]);

        return redirect()->route('customer.vehicles')
            ->with('success', 'Vehicle updated successfully!');
    }

    /**
     * Toggle vehicle rent listing
     */
    public function toggleRent(Vehicle $vehicle)
    {
        $customerId = $this->customerId();

        if ($vehicle->customer_id !== $customerId) {
            abort(403, 'Unauthorized');
        }

        if (!empty($vehicle->rented_by_user_id)) {
            return redirect()->route('customer.vehicles')
                ->with('error', 'This vehicle is currently rented and cannot be listed/unlisted.');
        }

        $activeStatuses = [
            'Pending',
            'Approved',
            'Assigned',
            'Customer Accepted',
            'In Progress',
            'Waiting for Parts',
        ];

        $hasActiveService = ServiceBooking::where('customer_id', $customerId)
            ->where('vehicle_number', $vehicle->plate_number)
            ->whereIn('status', $activeStatuses)
            ->exists();

        if ($hasActiveService) {
            return redirect()->route('customer.vehicles')
                ->with('error', 'This vehicle is currently under service and cannot be listed for rent.');
        }

        // Listing a customer vehicle for rent requires a daily rate.
        if (!$vehicle->is_service_center_vehicle && !$vehicle->is_listed_for_rent && (float) ($vehicle->daily_rate ?? 0) <= 0) {
            return redirect()->route('customer.vehicles')
                ->with('error', 'Please set a valid daily rate before listing for rent.');
        }

        // Toggle listing status
        $vehicle->is_listed_for_rent = !$vehicle->is_listed_for_rent;
        
        // If listing for rent, set status to pending for admin approval
        if ($vehicle->is_listed_for_rent && !$vehicle->is_service_center_vehicle) {
            $vehicle->listing_status = 'pending';
            $vehicle->listing_rejection_reason = null;

            OwnerVehicle::updateOrCreate(
                ['vehicle_id' => $vehicle->id],
                [
                    'owner_id' => $vehicle->customer_id,
                    'daily_rate' => $vehicle->daily_rate,
                    'approval_status' => 'pending',
                    'is_available' => true,
                    'approval_note' => null,
                    'approved_at' => null,
                ]
            );
        }

        if (!$vehicle->is_listed_for_rent && !$vehicle->is_service_center_vehicle) {
            OwnerVehicle::where('vehicle_id', $vehicle->id)->update([
                'is_available' => false,
                'approval_status' => 'pending',
                'approved_at' => null,
            ]);
        }
        
        $vehicle->save();

        $message = $vehicle->is_listed_for_rent 
            ? 'Vehicle submitted for rental approval! Admin will review shortly.' 
            : 'Vehicle unlisted from rent.';

        return redirect()->route('customer.vehicles')
            ->with('success', $message);
    }

    /**
     * Delete a vehicle
     */
    public function destroy(Vehicle $vehicle)
    {
        // Ensure user owns this vehicle
        if ($vehicle->customer_id !== $this->customerId()) {
            abort(403, 'Unauthorized');
        }

        if (!empty($vehicle->rented_by_user_id)) {
            return redirect()->route('customer.vehicles')
                ->with('error', 'This vehicle is currently rented and cannot be removed.');
        }

        $vehicle->delete();

        return redirect()->route('customer.vehicles')
            ->with('success', 'Vehicle removed successfully!');
    }
}
