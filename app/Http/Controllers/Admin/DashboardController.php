<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        $totalPesanan = Pesanan::count();
        $totalUser = User::count();
        $totalDetailPesanan = DetailPesanan::count();

        return view('admin.dashboard', [
            'user'               => Auth::user(),
            'totalProduk'        => $totalProduk,
            'totalKategori'      => $totalKategori,
            'totalPesanan'       => $totalPesanan,
            'totalUser'          => $totalUser,
            'totalDetailPesanan' => $totalDetailPesanan,
            'totalKriteria'      => Kriteria::count(),
            'totalAlternatif'    => Alternatif::count(),
        ]);
    }
}

