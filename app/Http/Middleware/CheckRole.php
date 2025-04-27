<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles  Pipe (|) separated list of roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!$request->user()) {
            return redirect('/dashboard')->with('error', 'You must be logged in to access this page.');
        }
        
        $rolesArray = explode('|', $roles);
        
        if (!in_array($request->user()->role, $rolesArray)) {
            return redirect('/dashboard')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
