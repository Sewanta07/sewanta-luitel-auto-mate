<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceBooking;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceBookingController extends Controller
{
    public function index()
    {
        $bookings = ServiceBooking::with(['customer', 'staff'])->orderBy('created_at', 'desc')->get();
        $staffMembers = User::where('role', 'staff')->get();
        
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

    public function assign(Request $request, $id)
    {
        $request->validate([
            'staff_id' => 'required|exists:users,id',
        ]);

        $booking = ServiceBooking::findOrFail($id);
        $booking->update([
            'staff_id' => $request->staff_id,
            'status' => 'Pending',
        ]);

        // Create assignment log
        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'status' => 'Assigned',
            'notes' => "Booking assigned to technician: " . \App\Models\User::find($request->staff_id)->name,
        ]);

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
            'status' => $request->status,
            'notes' => "Admin updated status to {$request->status}",
        ]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
