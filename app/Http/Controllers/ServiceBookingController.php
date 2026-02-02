<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
    public function create(Request $request)
    {
        $savedVehicles = ServiceBooking::where('customer_id', Auth::id())
            ->select('vehicle_number', 'vehicle_model', 'vehicle_name', 'vehicle_year', 'vehicle_type')
            ->distinct()
            ->orderBy('vehicle_model')
            ->get();

        // Check if a vehicle ID is passed to pre-fill the form
        $preFilledVehicle = null;
        if ($request->has('vehicle_id')) {
            $preFilledVehicle = \App\Models\Vehicle::find($request->vehicle_id);
            
            // Make sure the vehicle belongs to the authenticated customer
            if ($preFilledVehicle && $preFilledVehicle->customer_id !== Auth::id()) {
                $preFilledVehicle = null;
            }
        }

        return view('customer.bookings.create', compact('savedVehicles', 'preFilledVehicle'));
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
            'vehicle_name' => 'nullable|string|max:100',
            'vehicle_year' => 'nullable|integer|min:1980|max:' . now()->year,
            'service_type' => 'required|string|in:General Service,Engine Repair,Brake Service,Oil Change,Electrical Repair,Inspection,Custom Service',
            'custom_service' => 'required_if:service_type,Custom Service|nullable|string|max:100',
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time_slot' => 'required|string|in:Morning,Afternoon,Evening',
            'service_priority' => 'required|string|in:Normal,Urgent',
            'service_location_type' => 'required|string|in:Customer Address,Service Center Pickup',
            'location' => 'nullable|required_if:service_location_type,Customer Address|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'problem_description' => 'nullable|string',
            'notes' => 'nullable|string',
            'rental_required' => 'required|boolean',
            'pickup_drop' => 'required|boolean',
        ]);

        $hasConflict = ServiceBooking::where('customer_id', Auth::id())
            ->whereDate('preferred_date', $validated['preferred_date'])
            ->where('preferred_time_slot', $validated['preferred_time_slot'])
            ->whereIn('status', ['Pending', 'Approved', 'Assigned', 'In Progress', 'Waiting for Parts'])
            ->exists();

        if ($hasConflict) {
            return redirect()->back()
                ->withErrors(['preferred_time_slot' => 'You already have a booking for this date and time slot. Please choose another slot.'])
                ->withInput();
        }

        if ($validated['service_location_type'] === 'Service Center Pickup' && empty($validated['location'])) {
            $validated['location'] = 'Service Center Pickup';
        }

        $validated['customer_id'] = Auth::id();
        $validated['status'] = 'Pending';

        $booking = ServiceBooking::create($validated);

        // Create initial log entry
        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'status' => 'Pending',
            'notes' => 'Booking created' . ($booking->rental_required ? ' with rental requested.' : '.'),
        ]);

        // Notify customer and admin (if configured)
        try {
            if (Auth::user()?->email) {
                Mail::raw(
                    "Your booking {$booking->booking_code} has been submitted and is pending approval.",
                    function ($message) {
                        $message->to(Auth::user()->email)
                            ->subject('Booking Submitted - AutoMate');
                    }
                );
            }

            $adminEmail = env('ADMIN_EMAIL');
            if (!empty($adminEmail)) {
                Mail::raw(
                    "A new service booking {$booking->booking_code} has been created.",
                    function ($message) use ($adminEmail) {
                        $message->to($adminEmail)
                            ->subject('New Booking - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures to avoid breaking booking flow
        }

        return redirect()->route('bookings.index')
            ->with('success', 'Service booking created successfully!');
    }

    /**
     * Cancel a booking before approval.
     */
    public function cancel($id)
    {
        $booking = ServiceBooking::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'Pending') {
            return redirect()->back()->with('success', 'Only pending bookings can be cancelled.');
        }

        $booking->update(['status' => 'Cancelled']);

        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'status' => 'Cancelled',
            'notes' => 'Booking cancelled by customer.',
        ]);

        try {
            $adminEmail = env('ADMIN_EMAIL');
            if (!empty($adminEmail)) {
                Mail::raw(
                    "Booking {$booking->booking_code} was cancelled by the customer.",
                    function ($message) use ($adminEmail) {
                        $message->to($adminEmail)
                            ->subject('Booking Cancelled - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures
        }

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Reschedule a booking before approval.
     */
    public function reschedule(Request $request, $id)
    {
        $validated = $request->validate([
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time_slot' => 'required|string|in:Morning,Afternoon,Evening',
        ]);

        $booking = ServiceBooking::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'Pending') {
            return redirect()->back()->with('success', 'Only pending bookings can be rescheduled.');
        }

        $hasConflict = ServiceBooking::where('customer_id', Auth::id())
            ->whereDate('preferred_date', $validated['preferred_date'])
            ->where('preferred_time_slot', $validated['preferred_time_slot'])
            ->whereIn('status', ['Pending', 'Approved', 'Assigned', 'In Progress', 'Waiting for Parts'])
            ->where('id', '!=', $booking->id)
            ->exists();

        if ($hasConflict) {
            return redirect()->back()
                ->withErrors(['preferred_time_slot' => 'You already have a booking for this date and time slot. Please choose another slot.'])
                ->withInput();
        }

        $booking->update([
            'preferred_date' => $validated['preferred_date'],
            'preferred_time_slot' => $validated['preferred_time_slot'],
        ]);

        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'status' => 'Pending',
            'notes' => 'Booking rescheduled by customer.',
        ]);

        try {
            $adminEmail = env('ADMIN_EMAIL');
            if (!empty($adminEmail)) {
                Mail::raw(
                    "Booking {$booking->booking_code} was rescheduled by the customer.",
                    function ($message) use ($adminEmail) {
                        $message->to($adminEmail)
                            ->subject('Booking Rescheduled - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures
        }

        return redirect()->back()->with('success', 'Booking rescheduled successfully.');
    }

    /**
     * Show invoice for completed bookings.
     */
    public function invoice($id)
    {
        $booking = ServiceBooking::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'Completed') {
            return redirect()->back()->with('success', 'Invoice is available after completion.');
        }

        return view('customer.bookings.invoice', compact('booking'));
    }

    /**
     * Show booking details with logs.
     */
    public function show($id)
    {
        $booking = ServiceBooking::where('id', $id)
            ->where('customer_id', Auth::id())
            ->with(['logs.user', 'staff', 'customer'])
            ->firstOrFail();

        return view('customer.bookings.show', compact('booking'));
    }

    /**
     * Customer accepts the assigned staff and allows work to start.
     */
    public function accept($id)
    {
        $booking = ServiceBooking::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'Assigned') {
            return redirect()->back()->with('error', 'Only assigned bookings can be accepted.');
        }

        $booking->update(['status' => 'Customer Accepted']);

        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'status' => 'Customer Accepted',
            'notes' => 'Customer accepted the assigned staff and authorized work to begin.',
        ]);

        // Notify assigned staff
        try {
            if ($booking->staff && $booking->staff->email) {
                Mail::raw(
                    "Customer accepted booking {$booking->booking_code}. You may begin work.",
                    function ($message) use ($booking) {
                        $message->to($booking->staff->email)
                            ->subject('Customer Accepted Service - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures
        }

        return redirect()->back()->with('success', 'You have accepted the assigned staff. Work can now begin!');
    }
}
