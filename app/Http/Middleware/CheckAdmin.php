<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna memiliki role 'admin'
        if (auth()->check() && auth()->user()->role !== 'admin') {
            // Jika bukan admin, redirect ke dashboard pembeli
            return redirect()->route('pembeli.dashboard');
        }

        return $next($request);
    }
}
