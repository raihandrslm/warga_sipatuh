<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsRt
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login & role-nya RT
        if (auth()->check() && auth()->user()->role === 'rt') {
            return $next($request);
        }

        // Kalau bukan RT → forbidden
        abort(403, 'Akses ditolak. Hanya RT yang bisa masuk ke halaman ini.');
    }
}
