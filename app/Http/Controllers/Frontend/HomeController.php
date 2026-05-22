<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        $produks   = Produk::with('kategori')->latest()->take(6)->get();
        $kategoris = Kategori::all();

        return view('frontend.home.index', compact('produks', 'kategoris'));
    }
}
