<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UniversityAdmin
{
    public function handle($request, Closure $next)
    {
        // Skip middleware for login and registration routes
        if ($request->is('login', 'registration', 'logout')) { // Added missing parenthesis here
            return $next($request);
        }

        // Check authentication and university ID
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!session('uni_id')) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'University not identified');
        }

        return $next($request);
    }
}