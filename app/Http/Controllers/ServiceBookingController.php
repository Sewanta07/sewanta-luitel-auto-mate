<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceBookingController extends Controller
{
    /**
     * Display a listing of the customer's bookings.
     */
    public function index()
    {
        $bookings = ServiceBooking::where('customer_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        return view('customer.bookings.create');
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_number' => 'required|string|max:50',
            'vehicle_type' => 'required|string|in:Car,Bike',
            'vehicle_model' => 'required|string|max:100',
            'service_type' => 'required|string|in:General Service,Repair,Oil Change,Full Wash,Engine Tuning,Brake Inspection,Battery Check,AC Service',
            'location' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'preferred_date' => 'required|date|after_or_equal:today',
            'problem_description' => 'nullable|string',
        ]);

        $validated['customer_id'] = Auth::id();
        $validated['status'] = 'Pending';

        ServiceBooking::create($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Service booking created successfully!');
    }
}
