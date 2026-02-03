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
        if (Auth::guard('admin')->check()) {
            Auth::shouldUse('admin');
            $isAuthenticated = true;
        } elseif (Auth::guard('staff')->check()) {
            Auth::shouldUse('staff');
            $isAuthenticated = true;
        } elseif (Auth::guard('customer')->check()) {
            Auth::shouldUse('customer');
            $isAuthenticated = true;
        } else {
            $isAuthenticated = Auth::check();
        }

        if (!$isAuthenticated) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
