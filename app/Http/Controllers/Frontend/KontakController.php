<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('frontend.kontak.index');
    }

    public function kirim(Request $request)
    {
        $request->validate([
            'nama'       => ['required', 'string', 'max:100'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'email'      => ['nullable', 'email', 'max:100'],
            'subjek'     => ['required', 'string', 'max:150'],
            'pesan'      => ['required', 'string'],
        ]);

        PesanKontak::create([
            'nama'       => $request->nama,
            'no_telepon' => $request->no_telepon,
            'email'      => $request->email,
            'subjek'     => $request->subjek,
            'pesan'      => $request->pesan,
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
