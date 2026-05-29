<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Otomatis buat atau update password admin saat halaman login dibuka
        try {
            $user = User::where('email', 'admin@cake.com')->first();
            if (!$user) {
                User::create([
                    'name'     => 'Admin Ayasha',
                    'email'    => 'admin@cake.com',
                    'password' => 'admin123', // Akan di-hash otomatis oleh model User
                    'role'     => 'admin',
                ]);
            } else {
                $user->update([
                    'password' => 'admin123', // Reset password jika sudah ada
                    'role'     => 'admin',
                ]);
            }
        } catch (\Exception $e) {
            // Abaikan
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::guard('admin')->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            Auth::guard('admin')->logout();
            return back()->withErrors([
                'email' => 'Akun ini tidak memiliki akses admin.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
