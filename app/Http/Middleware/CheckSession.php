<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSession
{
    public function handle(Request $request, Closure $next)
    {
        // Example: check if access token exists in session
        if (!session()->has('access_token')) {
            // Redirect to login if session expired
            return redirect()->route('login')->with('error', 'Your session has expired. Please login again.');
        }

        return $next($request);
    }
}
