<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('admin')) {
            return redirect()->route('login')->with('error', 'Please login to access the dashboard');
        }

        return $next($request);
    }
}
