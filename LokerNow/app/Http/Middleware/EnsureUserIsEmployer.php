<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsEmployer
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'employer' role
        if (auth()->check() && auth()->user()->role === 'employer') {
            return $next($request);
        }

        // Otherwise, deny access
        abort(403, 'Unauthorized. Only employers can access this section.');
    }
}
