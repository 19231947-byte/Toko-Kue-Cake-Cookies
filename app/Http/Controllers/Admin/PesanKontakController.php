<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;

class PesanKontakController extends Controller
{
    public function index()
    {
        $pesans = PesanKontak::latest()->paginate(15);
        return view('admin.pesan-kontak.index', compact('pesans'));
    }

    public function show(PesanKontak $pesanKontak)
    {
        $pesanKontak->update(['status' => 'sudah_dibaca']);
        return view('admin.pesan-kontak.show', compact('pesanKontak'));
    }

    public function destroy(PesanKontak $pesanKontak)
    {
        $pesanKontak->delete();
        return redirect()->route('admin.pesan-kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
