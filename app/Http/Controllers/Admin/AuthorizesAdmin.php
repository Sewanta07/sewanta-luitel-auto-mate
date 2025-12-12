<?php

namespace App\Http\Controllers\Admin;

trait AuthorizesAdmin
{
    /**
     * Check if the authenticated user is an admin.
     */
    protected function authorizeAdmin($request): void
    {
        $user = $request->user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Check if user is Admin model instance
        if ($user instanceof \App\Models\Admin) {
            return;
        }

        // Check by role attribute
        $userRole = method_exists($user, 'getRoleAttribute') || isset($user->role) 
            ? ($user->role ?? null) 
            : null;

        if ($userRole !== 'admin') {
            abort(403, 'Admin access required');
        }
    }

    /**
     * Get the role of the authenticated user.
     */
    protected function getUserRole($user): string
    {
        // Check if user has a role attribute/method
        if (method_exists($user, 'getRoleAttribute') || isset($user->role)) {
            return $user->role ?? 'customer';
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

        // Default fallback
        return 'customer';
    }
}

