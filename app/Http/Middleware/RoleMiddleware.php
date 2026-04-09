<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::user()->role !== $role) {
            abort(403, 'Well');
        }
        return $next($request);
    }
}
