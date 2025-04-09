<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UniversityAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // In app/Http/Middleware/UniversityAdmin.php
    public function handle($request, Closure $next)
    {
       if (!auth()->check() || !session('uni_id')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
