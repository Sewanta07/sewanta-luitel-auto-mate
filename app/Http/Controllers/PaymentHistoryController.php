<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentHistoryController extends Controller
{
    /**
     * Show payment history for authenticated customer
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Get all completed bookings with payments
        $bookings = \App\Models\ServiceBooking::where('customer_id', $user->id)
            ->where('status', 'Completed')
            ->with('staff', 'logs')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Calculate stats
        $totalSpent = $bookings->sum('estimated_cost');
        $thisMonthSpent = $bookings->filter(function($booking) {
            return $booking->updated_at->month == now()->month && 
                   $booking->updated_at->year == now()->year;
        })->sum('estimated_cost');
        
        $lastPayment = $bookings->first()?->estimated_cost ?? 0;
        $totalTransactions = $bookings->count();

        return view('customer.payment-history', compact(
            'bookings',
            'totalSpent',
            'thisMonthSpent',
            'lastPayment',
            'totalTransactions'
        ));
    }
}
