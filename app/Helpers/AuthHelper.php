<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('getAuthenticatedUser')) {
    /**
     * Get the currently authenticated user from any guard.
     */
    function getAuthenticatedUser()
    {
        try {
            $currentUser = Auth::user();
            if ($currentUser) {
                return $currentUser;
            }

            // Check each guard in order
            if (Auth::guard('admin')->check()) {
                return Auth::guard('admin')->user();
            }

            if (Auth::guard('staff')->check()) {
                return Auth::guard('staff')->user();
            }

            if (Auth::guard('customer')->check()) {
                return Auth::guard('customer')->user();
            }

            // Fallback to default guard
            return Auth::user();
        } catch (\Throwable $exception) {
            return null;
        }
    }
}

if (!function_exists('getAuthenticatedUserRole')) {
    /**
     * Get the role of the currently authenticated user.
     */
    function getAuthenticatedUserRole(): ?string
    {
        try {
            // Prefer the currently active guard user (set via middleware).
            $user = Auth::user();
            if ($user) {
                if ($user instanceof \App\Models\Admin) {
                    return 'admin';
                }

                if ($user instanceof \App\Models\StaffMember) {
                    return 'staff';
                }

                if ($user instanceof \App\Models\CustomerUser) {
                    return 'customer';
                }

                if (isset($user->role) && in_array($user->role, ['admin', 'staff', 'customer'], true)) {
                    return $user->role;
                }
            }

            // Check guards in order
            if (Auth::guard('admin')->check()) {
                return 'admin';
            }

            if (Auth::guard('staff')->check()) {
                return 'staff';
            }

            if (Auth::guard('customer')->check()) {
                return 'customer';
            }

            // Fallback: try to determine from user instance
            $user = Auth::user();

            if (!$user) {
                return null;
            }

            // Check user type by class
            if ($user instanceof \App\Models\Admin) {
                return 'admin';
            }

            if ($user instanceof \App\Models\StaffMember) {
                return 'staff';
            }

            if ($user instanceof \App\Models\CustomerUser) {
                return 'customer';
            }

            // Check role attribute for User model (backward compatibility)
            if (isset($user->role) && in_array($user->role, ['admin', 'staff', 'customer'])) {
                return $user->role;
            }

            return 'customer'; // Default fallback
        } catch (\Throwable $exception) {
            return null;
        }
    }
}

