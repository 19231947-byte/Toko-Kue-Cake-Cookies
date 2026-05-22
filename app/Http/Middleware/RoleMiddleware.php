<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Tentukan guard berdasarkan role yang diminta
        $guard = $role === 'admin' ? 'admin' : 'customer';

        if (!Auth::guard($guard)->check()) {
            return $role === 'admin'
                ? redirect()->route('admin.login')
                : redirect()->route('frontend.login');
        }

        if (Auth::guard($guard)->user()->role !== $role) {
            return $role === 'admin'
                ? redirect()->route('admin.login')
                : redirect()->route('home');
        }

        return $next($request);
    }
}
