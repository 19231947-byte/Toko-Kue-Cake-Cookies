<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        return view('frontend.akun.index', ['user' => Auth::guard('customer')->user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
        ]);

        $user->update([
            'name'  => $request->name,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'password_lama' => ['required'],
            'password'      => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::guard('customer')->user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Kata sandi lama tidak sesuai.'])->withInput();
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success_password', 'Kata sandi berhasil diubah.');
    }

    public function pesanan()
    {
        $pesanans = Pesanan::with('detailPesanans.produk')
            ->where('user_id', Auth::guard('customer')->id())
            ->latest()
            ->get();

        return view('frontend.akun.pesanan', compact('pesanans'));
    }
}
