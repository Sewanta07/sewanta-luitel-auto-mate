<?php

if (!function_exists('getAuthenticatedUserRole')) {
    /**
     * Get the role of the currently authenticated user.
     * This function ensures we always get the correct user type.
     */
    function getAuthenticatedUserRole(): ?string
    {
        $user = Auth::user();
        
        if (!$user) {
            return null;
        }

        // Check user type by class FIRST (most reliable)
        if ($user instanceof \App\Models\Admin) {
            return 'admin';
        }
        
        if ($user instanceof \App\Models\StaffMember) {
            return 'staff';
        }
        
        if ($user instanceof \App\Models\CustomerUser) {
            return 'customer';
        }

        // Fallback: Check session for stored user type
        $sessionUserType = session('auth_user_type');
        if ($sessionUserType && in_array($sessionUserType, ['admin', 'staff', 'customer'])) {
            return $sessionUserType;
        }

        // Check role attribute for User model (backward compatibility)
        if (method_exists($user, 'getRoleAttribute')) {
            $role = $user->getRoleAttribute();
            if ($role && in_array($role, ['admin', 'staff', 'customer'])) {
                return $role;
            }
        }
        
        if (isset($user->role) && in_array($user->role, ['admin', 'staff', 'customer'])) {
            return $user->role;
        }

        return 'customer'; // Default fallback
    }
}

