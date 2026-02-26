<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events\ServiceStatusUpdated;
use App\Models\ServiceBooking;
use App\Models\StaffMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ServiceBookingController extends Controller
{
    public function index()
    {
        $bookings = ServiceBooking::with(['customer', 'staff'])->orderBy('created_at', 'desc')->get();
        // Get active staff members from staff_members table
        $staffMembers = StaffMember::where('status', 'active')->orderBy('name')->get();
        
        // Calculate stats
        $stats = [
            'total' => $bookings->count(),
            'pending' => $bookings->where('status', 'Pending')->count(),
            'in_progress' => $bookings->where('status', 'In Progress')->count(),
            'completed' => $bookings->where('status', 'Completed')->count(),
            'unassigned' => $bookings->where('staff_id', null)->count(),
        ];

        return view('admin.services', compact('bookings', 'staffMembers', 'stats'));
    }

    public function invoice($id)
    {
        $booking = ServiceBooking::with(['customer', 'staff', 'parts'])->findOrFail($id);

        return view('admin.services.invoice', compact('booking'));
    }

    public function assign(Request $request, $id)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff_members,id',
        ]);

        $booking = ServiceBooking::findOrFail($id);
        $booking->update([
            'staff_id' => $request->staff_id,
            'status' => 'Assigned',
        ]);

        // Get staff member name
        $staffMember = StaffMember::findOrFail($request->staff_id);

        // Create assignment log
        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'user_type' => get_class(\Illuminate\Support\Facades\Auth::user()),
            'status' => 'Assigned',
            'notes' => "Booking assigned to technician: {$staffMember->name}",
        ]);

        try {
            if ($booking->customer && $booking->customer->email) {
                Mail::raw(
                    "Your booking {$booking->booking_code} has been assigned to {$staffMember->name}.",
                    function ($message) use ($booking) {
                        $message->to($booking->customer->email)
                            ->subject('Booking Assigned - AutoMate');
                    }
                );
            }
            if ($staffMember->email) {
                Mail::raw(
                    "You have been assigned to booking {$booking->booking_code}.",
                    function ($message) use ($staffMember) {
                        $message->to($staffMember->email)
                            ->subject('New Assignment - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures
        }

        event(new ServiceStatusUpdated($booking->fresh()));

        return redirect()->back()->with('success', 'Staff assigned successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $booking = ServiceBooking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        // Create log entry
        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'user_type' => get_class(\Illuminate\Support\Facades\Auth::user()),
            'status' => $request->status,
            'notes' => "Admin updated status to {$request->status}",
        ]);

        try {
            if ($booking->customer && $booking->customer->email) {
                Mail::raw(
                    "Your booking {$booking->booking_code} status is now '{$booking->status}'.",
                    function ($message) use ($booking) {
                        $message->to($booking->customer->email)
                            ->subject('Booking Update - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures
        }

        event(new ServiceStatusUpdated($booking->fresh()));

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff_members,id',
            'estimated_cost' => 'nullable|numeric|min:0',
            'expected_completion_date' => 'nullable|date|after_or_equal:today',
        ]);

        $booking = ServiceBooking::findOrFail($id);
        $booking->update([
            'status' => 'Approved',
            'staff_id' => $request->staff_id,
            'estimated_cost' => $request->estimated_cost,
            'expected_completion_date' => $request->expected_completion_date,
        ]);

        // Get staff member name
        $staffMember = StaffMember::findOrFail($request->staff_id);

        // Create approval log
        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'user_type' => get_class(\Illuminate\Support\Facades\Auth::user()),
            'status' => 'Approved',
            'notes' => "Booking approved and assigned to {$staffMember->name}. Estimated cost: रू " . number_format($booking->estimated_cost ?? 0, 2),
        ]);

        try {
            if ($booking->customer && $booking->customer->email) {
                Mail::raw(
                    "Your booking {$booking->booking_code} has been approved and assigned to {$staffMember->name}.",
                    function ($message) use ($booking) {
                        $message->to($booking->customer->email)
                            ->subject('Booking Approved - AutoMate');
                    }
                );
            }
            if ($staffMember->email) {
                Mail::raw(
                    "You have been assigned to booking {$booking->booking_code}.",
                    function ($message) use ($staffMember) {
                        $message->to($staffMember->email)
                            ->subject('New Assignment - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures
        }

        event(new ServiceStatusUpdated($booking->fresh()));

        return redirect()->back()->with('success', 'Booking approved and staff assigned successfully!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $booking = ServiceBooking::findOrFail($id);
        $booking->update([
            'status' => 'Rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        // Create rejection log
        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'user_type' => get_class(\Illuminate\Support\Facades\Auth::user()),
            'status' => 'Rejected',
            'notes' => "Booking rejected. Reason: {$request->rejection_reason}",
        ]);

        try {
            if ($booking->customer && $booking->customer->email) {
                Mail::raw(
                    "Your booking {$booking->booking_code} was rejected. Reason: {$request->rejection_reason}",
                    function ($message) use ($booking) {
                        $message->to($booking->customer->email)
                            ->subject('Booking Rejected - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures
        }

        event(new ServiceStatusUpdated($booking->fresh()));

        return redirect()->back()->with('success', 'Booking rejected successfully!');
    }
}
