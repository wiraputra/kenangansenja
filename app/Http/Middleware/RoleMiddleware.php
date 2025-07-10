<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Jika pengguna belum login, arahkan ke login
        if (!Auth::check()) {
            return redirect('/login');
        }
    
        // Jika pengguna login tetapi role tidak sesuai
        if (Auth::user()->role !== $role) {
            return redirect('/'); // Arahkan ke halaman default
        }
    
        return $next($request);
    }
    
}

