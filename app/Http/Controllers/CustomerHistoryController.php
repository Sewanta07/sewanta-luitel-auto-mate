<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerHistoryController extends Controller
{
    private function customerId(): ?int
    {
        return Auth::guard('customer')->id() ?? Auth::id();
    }

    public function index(Request $request)
    {
        $customerId = $this->customerId();

        if (!$customerId) {
            return redirect()->route('login');
        }

        $query = ServiceBooking::with('staff')
            ->where('customer_id', $customerId)
            ->where('status', 'Completed');

        if ($request->filled('vehicle')) {
            $query->where('vehicle_number', $request->string('vehicle')->toString());
        }

        if ($request->filled('service')) {
            $query->where('service_type', $request->string('service')->toString());
        }

        if ($request->filled('q')) {
            $term = trim($request->string('q')->toString());
            $query->where(function ($searchQuery) use ($term) {
                $searchQuery->where('booking_code', 'like', "%{$term}%")
                    ->orWhere('vehicle_model', 'like', "%{$term}%")
                    ->orWhere('vehicle_number', 'like', "%{$term}%")
                    ->orWhere('service_type', 'like', "%{$term}%")
                    ->orWhere('notes', 'like', "%{$term}%");
            });
        }

        $history = $query->orderByDesc('updated_at')->paginate(12)->withQueryString();

        $vehicleOptions = ServiceBooking::where('customer_id', $customerId)
            ->where('status', 'Completed')
            ->select('vehicle_number', 'vehicle_model', 'vehicle_year')
            ->distinct()
            ->orderBy('vehicle_model')
            ->get();

        $serviceOptions = ServiceBooking::where('customer_id', $customerId)
            ->where('status', 'Completed')
            ->select('service_type')
            ->distinct()
            ->orderBy('service_type')
            ->pluck('service_type');

        return view('customer.history', compact('history', 'vehicleOptions', 'serviceOptions'));
    }
}
