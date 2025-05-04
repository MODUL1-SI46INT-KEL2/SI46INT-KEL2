<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        
        // Support for multiple roles separated by pipe
        $roles = explode('|', $role);
        
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }
        
        return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
    }
}
