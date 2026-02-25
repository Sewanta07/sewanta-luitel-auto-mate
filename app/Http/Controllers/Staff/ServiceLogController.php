<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ServiceLog;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Auth;

class ServiceLogController extends Controller
{
    public function index(Request $request)
    {
        $staffMember = Auth::guard('staff')->user();
        
        // Check if staff member is authenticated
        if (!$staffMember) {
            abort(403, 'Unauthorized: Staff details not found.');
        }
        
        $query = ServiceLog::with(['booking', 'user'])
            ->whereHas('booking', function ($q) use ($staffMember) {
                $q->where('staff_id', $staffMember->id);
            })
            ->where('status', 'Completed')
            ->latest('created_at');

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by booking code or vehicle
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('booking', function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhere('vehicle_model', 'like', "%{$search}%")
                  ->orWhere('vehicle_number', 'like', "%{$search}%");
            });
        }

        $bookingIds = (clone $query)
            ->select('service_booking_id')
            ->distinct()
            ->pluck('service_booking_id');

        $totalServices = $bookingIds->count();
        $totalCost = ServiceBooking::query()
            ->whereIn('id', $bookingIds)
            ->get()
            ->sum(function (ServiceBooking $booking) {
                return (float) ($booking->total_amount ?? $booking->estimated_cost ?? 0);
            });

        $logs = $query->paginate(15)->withQueryString();

        return view('staff.service-logs', [
            'logs' => $logs,
            'totalServices' => $totalServices,
            'totalCost' => $totalCost,
        ]);
    }
}
