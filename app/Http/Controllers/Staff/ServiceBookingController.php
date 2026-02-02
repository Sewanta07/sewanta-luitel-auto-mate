<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ServiceBookingController extends Controller
{
    public function index()
    {
        $bookings = ServiceBooking::where('staff_id', Auth::id())
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate stats for current staff
        $stats = [
            'total' => $bookings->count(),
            'in_progress' => $bookings->where('status', 'In Progress')->count(),
            'completed_today' => $bookings->where('status', 'Completed')->where('updated_at', '>=', now()->startOfDay())->count(),
            'pending' => $bookings->where('status', 'Pending')->count(),
        ];

        return view('staff.bookings', compact('bookings', 'stats'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,In Progress,Waiting for Parts,Completed',
            'notes' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $booking = ServiceBooking::where('id', $id)->where('staff_id', Auth::id())->firstOrFail();
        $booking->update(['status' => $request->status]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('service-logs', 'public');
        }

        // Create log entry with polymorphic relationship
        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'status' => $request->status,
            'notes' => $request->notes ?? "Status updated to {$request->status}",
            'attachment_path' => $attachmentPath,
        ]);

        // Notify customer
        try {
            if ($booking->customer && $booking->customer->email) {
                Mail::raw(
                    "Your service booking {$booking->booking_code} status is now '{$booking->status}'.",
                    function ($message) use ($booking) {
                        $message->to($booking->customer->email)
                            ->subject('Service Update - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures to avoid breaking workflow
        }

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }
}
