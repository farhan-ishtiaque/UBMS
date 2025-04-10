<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UmsbAccess
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->type !== 'umsb_personnel') {
            return redirect()->route('login')->withErrors(['access' => 'Unauthorized access']);
        }

        return $next($request);
    }
}
