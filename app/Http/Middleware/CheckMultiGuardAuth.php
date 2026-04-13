<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMultiGuardAuth
{
    /**
     * Handle an incoming request - check if user is authenticated in ANY guard
     */
    public function handle(Request $request, Closure $next): Response
    {
        $preferredGuard = null;
        if ($request->is('admin/*')) {
            $preferredGuard = 'admin';
        } elseif ($request->is('staff/*')) {
            $preferredGuard = 'staff';
        } elseif ($request->is('customer/*')) {
            $preferredGuard = 'customer';
        }

        $guards = array_values(array_unique(array_filter([
            $preferredGuard,
            'admin',
            'staff',
            'customer',
        ])));

        $isAuthenticated = false;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::shouldUse($guard);
                $isAuthenticated = true;
                break;
            }
        }

        if (!$isAuthenticated) {
            $isAuthenticated = Auth::check();
        }

        if (!$isAuthenticated) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
