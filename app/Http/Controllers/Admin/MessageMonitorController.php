<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;

class MessageMonitorController extends Controller
{
    public function index(Request $request)
    {
        $query = Message::with(['sender', 'receiver', 'booking'])
            ->orderBy('created_at', 'desc');

        // Filter by booking if provided
        if ($request->has('booking_id')) {
            $query->where('service_booking_id', $request->booking_id);
        }

        // Filter by date range
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $messages = $query->paginate(50);
        $bookings = ServiceBooking::orderBy('created_at', 'desc')->take(100)->get();

        return view('admin.messages', compact('messages', 'bookings'));
    }
}
