<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Cek guard admin
        if (Auth::guard('admin')->check()) {
            // Hanya redirect jika sedang di area admin
            if ($request->is('admin/login')) {
                return redirect()->route('admin.dashboard');
            }
        }

        // Cek guard customer
        if (Auth::guard('customer')->check()) {
            // Hanya redirect jika sedang di halaman login/register frontend
            if ($request->is('login') || $request->is('register')) {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
