<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStaffStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = getAuthenticatedUser();

        if (!$user) {
            return $next($request);
        }

        // Check if user is a StaffMember
        $isStaff = $user instanceof \App\Models\StaffMember;
        
        if ($isStaff) {
            if (isset($user->status)) {
                if ($user->status === 'pending') {
                    return redirect()->route('staff.pending');
                }

                if ($user->status === 'rejected') {
                    Auth::guard('staff')->logout();
                    return redirect()->route('staff.rejected');
                }
            }
        }

        return $next($request);
    }
}

