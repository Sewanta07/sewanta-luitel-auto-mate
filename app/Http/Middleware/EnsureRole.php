<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $role = getAuthenticatedUserRole();

        if (!$role || !in_array($role, $roles, true)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
