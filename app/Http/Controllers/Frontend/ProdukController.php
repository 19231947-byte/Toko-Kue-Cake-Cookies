<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('kategori');

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $produks   = $query->latest()->paginate(9)->withQueryString();
        $kategoris = Kategori::all();

        return view('frontend.produk.index', compact('produks', 'kategoris'));
    }

    public function show($id)
    {
        $produk        = Produk::with('kategori', 'varians')->findOrFail($id);
        $produkLainnya = Produk::where('kategori_id', $produk->kategori_id)
                               ->where('id', '!=', $id)
                               ->take(4)->get();

        return view('frontend.produk.detail', compact('produk', 'produkLainnya'));
    }
}
