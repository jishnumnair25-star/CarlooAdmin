<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = session('access_token');
        if (!$token) {
            // For AJAX/API requests, return 401
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Authentication required'], 401);
            }
            // For normal requests, redirect to login
            return redirect()->route('login')->with('error', 'Please log in first.');
        }
        return $next($request);
    }
}
