<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
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

        return view('dashboard.customer', compact('user'));
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

        return view('dashboard.admin', compact('user'));
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

