<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\CustomerUser;
use App\Models\InventoryItem;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\RentalRequest;
use App\Models\ServiceBooking;
use App\Models\WithdrawalRequest;

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

        $assignedRentals = RentalRequest::where('assigned_staff_id', $user->id)
            ->whereNotIn('status', ['Completed', 'Cancelled', 'Rejected'])
            ->get();

        $stats = [
            'total' => $bookings->count(),
            'assigned' => $bookings->whereIn('status', ['Assigned'])->count(),
            'in_progress' => $bookings->whereIn('status', ['Customer Accepted', 'In Progress'])->count(),
            'assigned_rentals' => $assignedRentals->count(),
            'ready_pickup_rentals' => $assignedRentals->where('status', 'Ready for Pickup')->count(),
        ];

        // Recent bookings (last 5)
        $recentBookings = $bookings->take(5);

        // Recent assigned rentals (last 5, excluding closed statuses)
        $recentAssignedRentals = $assignedRentals
            ->load(['vehicle', 'renter', 'owner'])
            ->sortByDesc('created_at')
            ->take(5)
            ->values();

        $recentWork = $recentBookings->map(function ($booking) {
            return [
                'type' => 'booking',
                'id' => $booking->id,
                'status' => $booking->status,
                'created_at' => $booking->created_at,
                'title' => trim(($booking->service_type ?? 'Service') . ' - ' . ($booking->vehicle_model ?? 'Vehicle')),
                'subtitle' => 'Owner: ' . ($booking->customer->name ?? 'Unknown') . ' • ' . ($booking->booking_code ?? 'N/A') . ' • ' . ($booking->vehicle_number ?? 'N/A'),
                'date_label' => $booking->preferred_date ? Carbon::parse($booking->preferred_date)->format('M d') : 'N/A',
                'time_label' => $booking->preferred_time_slot ?? 'N/A',
                'action_url' => route('staff.services.show', $booking->id),
                'action_label' => 'View',
            ];
        })->merge(
            $recentAssignedRentals->map(function ($rental) {
                $vehicleName = $rental->vehicle->vehicle_name
                    ?? trim(($rental->vehicle->brand ?? '') . ' ' . ($rental->vehicle->model ?? 'Vehicle'));

                return [
                    'type' => 'rental',
                    'id' => $rental->id,
                    'status' => $rental->status,
                    'created_at' => $rental->created_at,
                    'title' => $vehicleName,
                    'subtitle' => 'Renter: ' . ($rental->renter->name ?? 'Unknown') . ' • ' .
                        (optional($rental->start_date)->format('M d') ?? 'N/A') . ' - ' .
                        (optional($rental->end_date)->format('M d') ?? 'N/A'),
                    'date_label' => optional($rental->start_date)->format('M d') ?? 'N/A',
                    'time_label' => 'Rental',
                    'action_url' => route('staff.rentals.inspection', $rental->id),
                    'action_label' => 'Manage',
                ];
            })
        )->sortByDesc('created_at')
            ->take(10)
            ->values();

        return view('dashboard.staff', compact('user', 'stats', 'recentWork'));
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
        $lowStockItems = InventoryItem::where('status', 'active')
            ->whereColumn('quantity', '<=', 'minimum_stock')
            ->count();

        $totalServiceCharge = (float) ServiceBooking::where('status', 'Completed')
            ->sum(DB::raw('COALESCE(total_amount, service_cost, estimated_cost, 0)'));

        $totalRevenue = (float) Payment::where('status', 'paid')->sum('amount');
        $activeRentals = Rental::whereNotIn('status', ['Completed', 'Cancelled', 'Rejected'])->count();
        $pendingWithdrawals = WithdrawalRequest::where('status', 'pending')->count();

        $recentBookings = ServiceBooking::with(['customer:id,name', 'staff:id,name'])
            ->latest()
            ->limit(6)
            ->get();

        $startMonth = now()->subMonths(5)->startOfMonth();
        $monthlyServiceTotals = ServiceBooking::selectRaw("TO_CHAR(updated_at, 'YYYY-MM') as month_key, COUNT(*) as total")
            ->where('status', 'Completed')
            ->where('updated_at', '>=', $startMonth)
            ->groupBy('month_key')
            ->pluck('total', 'month_key');

        $monthlyRevenueTotals = Payment::selectRaw("TO_CHAR(paid_at, 'YYYY-MM') as month_key, SUM(amount) as total")
            ->where('status', 'paid')
            ->whereNotNull('paid_at')
            ->where('paid_at', '>=', $startMonth)
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

        $monthlyRevenue = collect(range(5, 0))
            ->map(function ($offset) use ($monthlyRevenueTotals) {
                $monthKey = now()->subMonths($offset)->format('Y-m');
                $label = Carbon::createFromFormat('Y-m', $monthKey)->format('M Y');

                return [
                    'label' => $label,
                    'total' => (float) ($monthlyRevenueTotals[$monthKey] ?? 0),
                ];
            })
            ->values()
            ->all();

        $serviceStatusCounts = ServiceBooking::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $inventoryHealth = [
            'In Stock' => InventoryItem::where('status', 'active')
                ->whereColumn('quantity', '>', 'minimum_stock')
                ->count(),
            'Low Stock' => $lowStockItems,
            'Out of Stock' => InventoryItem::where('status', 'active')
                ->where('quantity', '<=', 0)
                ->count(),
        ];

        return view('dashboard.admin', compact(
            'user',
            'totalServices',
            'inProgressServices',
            'completedToday',
            'pendingReview',
            'totalInventory',
            'lowStockItems',
            'totalServiceCharge',
            'totalRevenue',
            'activeRentals',
            'pendingWithdrawals',
            'recentBookings',
            'monthlyCompletedServices',
            'monthlyRevenue',
            'serviceStatusCounts',
            'inventoryHealth'
        ));
    }

    /**
     * Show the admin analytics dashboard.
     */
    public function analytics(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $userRole = $this->getUserRole($user);
        if ($userRole !== 'admin') {
            return redirect()->route('dashboard.' . $userRole);
        }

        $allowedPeriods = [7, 30, 90, 180, 365];
        $periodDays = (int) $request->integer('period', 30);
        if (!in_array($periodDays, $allowedPeriods, true)) {
            $periodDays = 30;
        }

        $rangeEnd = now()->endOfDay();
        $rangeStart = now()->subDays($periodDays - 1)->startOfDay();
        $previousRangeEnd = $rangeStart->copy()->subSecond();
        $previousRangeStart = $rangeStart->copy()->subDays($periodDays)->startOfDay();

        $totalRevenue = (float) Payment::where('status', 'paid')->sum('amount');
        $servicesCompleted = ServiceBooking::where('status', 'Completed')->count();
        $activeCustomers = CustomerUser::where('status', 'active')->count();
        $customerSatisfaction = null;

        $periodRevenue = (float) Payment::where('status', 'paid')
            ->whereNotNull('paid_at')
            ->whereBetween('paid_at', [$rangeStart, $rangeEnd])
            ->sum('amount');

        $previousPeriodRevenue = (float) Payment::where('status', 'paid')
            ->whereNotNull('paid_at')
            ->whereBetween('paid_at', [$previousRangeStart, $previousRangeEnd])
            ->sum('amount');

        $periodRevenueChange = null;
        if ($previousPeriodRevenue > 0) {
            $periodRevenueChange = (($periodRevenue - $previousPeriodRevenue) / $previousPeriodRevenue) * 100;
        }

        $periodCompletedServices = ServiceBooking::where('status', 'Completed')
            ->whereBetween('updated_at', [$rangeStart, $rangeEnd])
            ->count();

        $periodNewCustomers = CustomerUser::whereBetween('created_at', [$rangeStart, $rangeEnd])->count();

        $periodTotalPayments = Payment::whereBetween('created_at', [$rangeStart, $rangeEnd])->count();
        $periodPaidPayments = Payment::where('status', 'paid')
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->count();
        $paymentSuccessRate = $periodTotalPayments > 0
            ? ($periodPaidPayments / $periodTotalPayments) * 100
            : 0.0;

        $startMonth = now()->subMonths(5)->startOfMonth();
        $monthlyTotals = Payment::selectRaw("TO_CHAR(paid_at, 'YYYY-MM') as month_key, SUM(amount) as total")
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

        $dailyRevenueTotals = Payment::selectRaw('DATE(paid_at) as date_key, SUM(amount) as total')
            ->where('status', 'paid')
            ->whereNotNull('paid_at')
            ->whereBetween('paid_at', [$rangeStart, $rangeEnd])
            ->groupBy('date_key')
            ->pluck('total', 'date_key');

        $dailyRevenue = collect(range(0, $periodDays - 1))
            ->map(function ($offset) use ($rangeStart, $dailyRevenueTotals) {
                $date = $rangeStart->copy()->addDays($offset);
                $dateKey = $date->format('Y-m-d');

                return [
                    'label' => $date->format('M d'),
                    'total' => (float) ($dailyRevenueTotals[$dateKey] ?? 0),
                ];
            })
            ->values()
            ->all();

        $serviceStatusCounts = ServiceBooking::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $topServiceTypes = ServiceBooking::selectRaw('service_type, COUNT(*) as total_bookings, SUM(COALESCE(total_amount, service_cost, estimated_cost, 0)) as total_amount')
            ->where('status', 'Completed')
            ->whereBetween('updated_at', [$rangeStart, $rangeEnd])
            ->groupBy('service_type')
            ->orderByDesc('total_bookings')
            ->limit(5)
            ->get();

        $inventoryHealth = [
            'In Stock' => InventoryItem::where('status', 'active')
                ->whereColumn('quantity', '>', 'minimum_stock')
                ->count(),
            'Low Stock' => InventoryItem::where('status', 'active')
                ->whereColumn('quantity', '<=', 'minimum_stock')
                ->where('quantity', '>', 0)
                ->count(),
            'Out of Stock' => InventoryItem::where('status', 'active')
                ->where('quantity', '<=', 0)
                ->count(),
        ];

        $recentPayments = Payment::with('user:id,name')
            ->orderByDesc('paid_at')
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        return view('admin.analytics', compact(
            'periodDays',
            'totalRevenue',
            'servicesCompleted',
            'activeCustomers',
            'customerSatisfaction',
            'periodRevenue',
            'previousPeriodRevenue',
            'periodRevenueChange',
            'periodCompletedServices',
            'periodNewCustomers',
            'paymentSuccessRate',
            'monthlyRevenue',
            'dailyRevenue',
            'serviceStatusCounts'
            ,
            'topServiceTypes',
            'inventoryHealth',
            'recentPayments'
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

