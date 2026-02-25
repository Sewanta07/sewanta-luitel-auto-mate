<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLocalEnvironment
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!app()->environment('local')) {
            abort(403, 'This route is available only in local environment.');
        }

        return $next($request);
    }
}
