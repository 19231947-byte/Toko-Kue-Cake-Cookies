<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;

class DetailPesananController extends Controller
{
    public function index()
    {
        $details = DetailPesanan::with(['pesanan.user', 'produk'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.detail_pesanan.index', compact('details'));
    }
}

