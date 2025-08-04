<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiSession
{
    


    public function handle($request, Closure $next)
    {
        if (!Session::has('access_token')) {
            return redirect('/')->with('error', 'Please log in first.');
        }

        return $next($request);
    }
}

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

