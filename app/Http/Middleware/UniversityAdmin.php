<?php

// app/Http/Middleware/UniversityAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UniversityAdmin
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Check if user is a university admin
        if (auth()->user()->type !== 'university_admin') {
            return redirect()->route('login')->with('error', 'Unauthorized access');
        }

        // Make sure uni_id is in session
        if (!session('uni_id')) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'University not identified');
        }

        return $next($request);
    }
}
