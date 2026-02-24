<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\CustomerUser;
use App\Models\InventoryItem;
use App\Models\Payment;
use App\Models\ServiceBooking;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('multi.auth');
    }

    /**
     * Show the customer dashboard.
     */
    public function customer()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        $userRole = $this->getUserRole($user);
        
        // Redirect to correct dashboard if user is not a customer
        if ($userRole !== 'customer') {
            return redirect()->route('dashboard.' . $userRole);
        }

        // Get customer bookings with dynamic stats
        $bookings = \App\Models\ServiceBooking::where('customer_id', $user->id)
            ->with('staff', 'logs')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate statistics
        $completedBookings = $bookings->where('status', 'Completed');
        $totalSpent = $completedBookings->sum('estimated_cost');
        $avgCost = $completedBookings->count() > 0 ? $totalSpent / $completedBookings->count() : 0;
        
        $stats = [
            'pending' => $bookings->whereIn('status', ['Pending', 'Approved'])->count(),
            'in_progress' => $bookings->whereIn('status', ['Assigned', 'Customer Accepted', 'In Progress', 'Waiting for Parts'])->count(),
            'completed' => $completedBookings->count(),
            'total' => $bookings->count(),
            'total_spent' => number_format($totalSpent, 2),
            'avg_cost' => number_format($avgCost, 2),
            'avg_rating' => '4.8',  // Can be calculated from reviews if available
            'avg_response_time' => '2h',  // Can be calculated from booking logs if available
        ];

        // Recent bookings (last 6)
        $recentBookings = $bookings->take(6);

        return view('dashboard.customer', compact('user', 'stats', 'recentBookings', 'bookings'));
    }

    /**
     * Show the staff dashboard.
     */
    public function staff()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        $userRole = $this->getUserRole($user);
        
        // Redirect to correct dashboard if user is not staff
        if ($userRole !== 'staff') {
            return redirect()->route('dashboard.' . $userRole);
        }

        // Get staff bookings with dynamic stats
        $bookings = \App\Models\ServiceBooking::where('staff_id', $user->id)
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total' => $bookings->count(),
            'assigned' => $bookings->whereIn('status', ['Assigned'])->count(),
            'in_progress' => $bookings->whereIn('status', ['Customer Accepted', 'In Progress'])->count(),
            'waiting_parts' => $bookings->where('status', 'Waiting for Parts')->count(),
            'completed' => $bookings->where('status', 'Completed')->count(),
            'completed_today' => $bookings->where('status', 'Completed')
                ->filter(function($booking) {
                    return $booking->updated_at->isToday();
                })->count(),
        ];

        // Recent bookings (last 5)
        $recentBookings = $bookings->take(5);

        return view('dashboard.staff', compact('user', 'stats', 'recentBookings'));
    }

    /**
     * Show the admin dashboard.
     */
    public function admin()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        $userRole = $this->getUserRole($user);
        
        // Redirect to correct dashboard if user is not admin
        if ($userRole !== 'admin') {
            return redirect()->route('dashboard.' . $userRole);
        }

        $totalServices = ServiceBooking::count();
        $inProgressServices = ServiceBooking::whereIn('status', ['Assigned', 'Customer Accepted', 'In Progress', 'Waiting for Parts'])->count();
        $completedToday = ServiceBooking::where('status', 'Completed')
            ->whereDate('updated_at', now()->toDateString())
            ->count();
        $pendingReview = ServiceBooking::where('status', 'Pending')->count();

        $totalInventory = InventoryItem::where('status', 'active')->sum('quantity');
        $totalServiceCharge = ServiceBooking::where('status', 'Completed')->sum('service_cost');

        $startMonth = now()->subMonths(5)->startOfMonth();
        $monthlyServiceTotals = ServiceBooking::selectRaw("DATE_FORMAT(updated_at, '%Y-%m') as month_key, COUNT(*) as total")
            ->where('status', 'Completed')
            ->where('updated_at', '>=', $startMonth)
            ->groupBy('month_key')
            ->pluck('total', 'month_key');

        $monthlyCompletedServices = collect(range(5, 0))
            ->map(function ($offset) use ($monthlyServiceTotals) {
                $monthKey = now()->subMonths($offset)->format('Y-m');
                $label = Carbon::createFromFormat('Y-m', $monthKey)->format('M Y');

                return [
                    'label' => $label,
                    'total' => (int) ($monthlyServiceTotals[$monthKey] ?? 0),
                ];
            })
            ->values()
            ->all();

        return view('dashboard.admin', compact(
            'user',
            'totalServices',
            'inProgressServices',
            'completedToday',
            'pendingReview',
            'totalInventory',
            'totalServiceCharge',
            'monthlyCompletedServices'
        ));
    }

    /**
     * Show the admin analytics dashboard.
     */
    public function analytics()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $userRole = $this->getUserRole($user);
        if ($userRole !== 'admin') {
            return redirect()->route('dashboard.' . $userRole);
        }

        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $servicesCompleted = ServiceBooking::where('status', 'Completed')->count();
        $activeCustomers = CustomerUser::count();
        $customerSatisfaction = null;

        $startMonth = now()->subMonths(5)->startOfMonth();
        $monthlyTotals = Payment::selectRaw("DATE_FORMAT(paid_at, '%Y-%m') as month_key, SUM(amount) as total")
            ->where('status', 'paid')
            ->whereNotNull('paid_at')
            ->where('paid_at', '>=', $startMonth)
            ->groupBy('month_key')
            ->pluck('total', 'month_key');

        $monthlyRevenue = collect(range(5, 0))
            ->map(function ($offset) use ($monthlyTotals) {
                $monthKey = now()->subMonths($offset)->format('Y-m');
                $label = Carbon::createFromFormat('Y-m', $monthKey)->format('M Y');

                return [
                    'label' => $label,
                    'total' => (float) ($monthlyTotals[$monthKey] ?? 0),
                ];
            })
            ->values()
            ->all();

        $serviceStatusCounts = ServiceBooking::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return view('admin.analytics', compact(
            'totalRevenue',
            'servicesCompleted',
            'activeCustomers',
            'customerSatisfaction',
            'monthlyRevenue',
            'serviceStatusCounts'
        ));
    }

    /**
     * Get the role of the authenticated user.
     * Prioritizes instance checking over attribute checking for accuracy.
     * This ensures users are redirected to the correct dashboard based on their actual model type.
     */
    private function getUserRole($user): string
    {
        if (!$user) {
            return 'customer';
        }

        // CRITICAL: Check user type by class FIRST (most reliable - checks actual model instance)
        // This MUST be checked first to ensure correct model type detection
        if ($user instanceof \App\Models\Admin) {
            return 'admin';
        }
        
        if ($user instanceof \App\Models\StaffMember) {
            return 'staff';
        }
        
        if ($user instanceof \App\Models\CustomerUser) {
            return 'customer';
        }

        // Fallback: Check session for stored user type (in case model type is lost during session)
        $sessionUserType = session('auth_user_type');
        if ($sessionUserType && in_array($sessionUserType, ['admin', 'staff', 'customer'])) {
            return $sessionUserType;
        }

        // Only check role attribute if not one of the specific models (for backward compatibility with User model)
        // This should only be used for legacy User model records
        if (method_exists($user, 'getRoleAttribute')) {
            $role = $user->getRoleAttribute();
            if ($role && in_array($role, ['admin', 'staff', 'customer'])) {
                return $role;
            }
        }
        
        if (isset($user->role) && in_array($user->role, ['admin', 'staff', 'customer'])) {
            return $user->role;
        }

        // Default fallback - should never reach here for new registrations
        return 'customer';
    }
}

