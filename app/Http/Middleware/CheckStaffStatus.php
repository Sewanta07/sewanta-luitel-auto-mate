<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStaffStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return $next($request);
        }

        // Check if user is a StaffMember
        $isStaff = $user instanceof \App\Models\StaffMember;
        
        // Also check by role attribute for backward compatibility
        $userRole = method_exists($user, 'getRoleAttribute') || isset($user->role) 
            ? ($user->role ?? null) 
            : null;
        
        if ($isStaff || $userRole === 'staff') {
            if (isset($user->status)) {
                if ($user->status === 'pending') {
                    return redirect()->route('staff.pending');
                }

                if ($user->status === 'rejected') {
                    Auth::logout();
                    return redirect()->route('staff.rejected');
                }
            }
        }

        return $next($request);
    }
}

