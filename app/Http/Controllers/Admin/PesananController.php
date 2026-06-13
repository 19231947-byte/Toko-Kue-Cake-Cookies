<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['user'])->orderByDesc('created_at')->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['user', 'detailPesanans.produk']);

        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'status'            => ['nullable', 'in:Pending,Diproses,Dikirim,Selesai'],
            'status_pembayaran' => ['nullable', 'in:Belum Bayar,Sudah Bayar'],
        ]);

        $pesanan->update(array_filter($validated));

        return redirect()->route('admin.pesanan.index')
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

