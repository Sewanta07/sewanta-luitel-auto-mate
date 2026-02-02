<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Show customer vehicles page
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Get all vehicles for the customer
        $vehicles = Vehicle::with([
                'rentalRequests' => function ($query) {
                    $query->where('status', 'Pending');
                },
                'approvedRental',
            ])
            ->where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.vehicles.index', compact('vehicles', 'user'));
    }

    /**
     * Show vehicles available for rent
     */
    public function rentIndex()
    {
        $user = Auth::user();
        
        // Show ALL vehicles listed for rent (including own vehicles for testing)
        // In production, uncomment the line: ->where('customer_id', '!=', $user->id)
        $vehicles = Vehicle::with('customer')
            ->where('is_listed_for_rent', true)
            ->whereNull('rented_by_user_id')
            // ->where('customer_id', '!=', $user->id) // Uncomment to hide own vehicles
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.rent-vehicles', compact('vehicles'));
    }

    /**
     * Store a new vehicle
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
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
        ]);

        $imagePath = null;
        if ($request->hasFile('vehicle_image')) {
            $imagePath = $request->file('vehicle_image')->store('vehicles', 'public');
        }

        Vehicle::create([
            'customer_id' => $user->id,
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

        return redirect()->route('customer.vehicles')
            ->with('success', 'Vehicle added successfully!');
    }

    /**
     * Show the form for editing a vehicle
     */
    public function edit(Vehicle $vehicle)
    {
        if ($vehicle->customer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('customer.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update a vehicle
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->customer_id !== Auth::id()) {
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
        if ($vehicle->customer_id !== Auth::id()) {
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

        $hasActiveService = ServiceBooking::where('customer_id', Auth::id())
            ->where('vehicle_number', $vehicle->plate_number)
            ->whereIn('status', $activeStatuses)
            ->exists();

        if ($hasActiveService) {
            return redirect()->route('customer.vehicles')
                ->with('error', 'This vehicle is currently under service and cannot be listed for rent.');
        }

        $vehicle->is_listed_for_rent = !$vehicle->is_listed_for_rent;
        $vehicle->save();

        return redirect()->route('customer.vehicles')
            ->with('success', $vehicle->is_listed_for_rent ? 'Vehicle listed for rent!' : 'Vehicle unlisted from rent.');
    }

    /**
     * Delete a vehicle
     */
    public function destroy(Vehicle $vehicle)
    {
        // Ensure user owns this vehicle
        if ($vehicle->customer_id !== Auth::id()) {
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
