<?php

namespace App\Http\Controllers;

use App\Models\Payment;
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

        $payments = Payment::query()
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->orderByDesc('paid_at')
            ->get();

        $totalSpent = $payments->sum('amount');
        $thisMonthSpent = $payments
            ->filter(function ($payment) {
                return optional($payment->paid_at)->month === now()->month
                    && optional($payment->paid_at)->year === now()->year;
            })
            ->sum('amount');
        
        $lastPayment = $payments->first()?->amount ?? 0;
        $totalTransactions = $payments->count();

        $bookings = \App\Models\ServiceBooking::where('customer_id', $user->id)
            ->where('status', 'Completed')
            ->with('staff', 'logs')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('customer.payment-history', compact(
            'bookings',
            'totalSpent',
            'thisMonthSpent',
            'lastPayment',
            'totalTransactions'
        ));
    }
}
