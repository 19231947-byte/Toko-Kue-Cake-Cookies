<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\ProdukVarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    private function userId(): int
    {
        return Auth::guard('customer')->id();
    }

    public function index()
    {
        $items = Keranjang::where('user_id', $this->userId())->get();
        $total = $items->sum(fn($i) => $i->harga * $i->qty);

        // Bentuk array kompatibel dengan view lama
        $keranjang = $items->mapWithKeys(fn($i) => [
            $this->itemKey($i->produk_id, $i->varian_id) => $this->toArray($i)
        ])->toArray();

        return view('frontend.keranjang.index', compact('keranjang', 'total'));
    }

    public function tambah(Request $request, $id)
    {
        $produk   = Produk::with('kategori')->findOrFail($id);
        $qty      = (int) $request->input('qty', 1);
        $varianId = $request->input('varian_id') ?: null;

        // Validasi minimal pembelian Snack Box
        if ($produk->kategori && $produk->kategori->nama_kategori === 'Snack Box') {
            if ($qty < 20) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'error'   => 'Minimal pemesanan Snack Box adalah 20 pcs.',
                    ], 422);
                }
                return redirect()->back()->with('error', 'Minimal pemesanan Snack Box adalah 20 pcs.');
            }
        }

        $qty = max(1, $qty);
        $harga      = $produk->harga;
        $namaVarian = null;

        if ($varianId) {
            $varian = ProdukVarian::find($varianId);
            if ($varian) {
                $harga      = $varian->harga;
                $namaVarian = $varian->nama_varian;
            }
        }

        $userId = $this->userId();

        // Cari item yang sudah ada (produk + varian sama)
        $existing = Keranjang::where('user_id', $userId)
            ->where('produk_id', $produk->id)
            ->where('varian_id', $varianId)
            ->first();

        if ($existing) {
            $existing->increment('qty', $qty);
        } else {
            Keranjang::create([
                'user_id'     => $userId,
                'produk_id'   => $produk->id,
                'varian_id'   => $varianId,
                'nama_produk' => $produk->nama_produk,
                'nama_varian' => $namaVarian,
                'harga'       => $harga,
                'gambar'      => $produk->gambar,
                'qty'         => $qty,
            ]);
        }

        $totalItem = Keranjang::where('user_id', $userId)->sum('qty');

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'   => true,
                'message'   => $produk->nama_produk . ' ditambahkan ke keranjang.',
                'totalItem' => $totalItem,
            ]);
        }

        return redirect()->back()->with('success', $produk->nama_produk . ' ditambahkan ke keranjang.');
    }

    public function hapus($key)
    {
        // Key format: "{produk_id}" atau "{produk_id}_v{varian_id}"
        [$produkId, $varianId] = $this->parseKey($key);

        Keranjang::where('user_id', $this->userId())
            ->where('produk_id', $produkId)
            ->where('varian_id', $varianId)
            ->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function update(Request $request, $key)
    {
        [$produkId, $varianId] = $this->parseKey($key);
        $qty = (int) $request->input('qty', 1);

        $produk = Produk::with('kategori')->find($produkId);
        if ($produk && $produk->kategori && $produk->kategori->nama_kategori === 'Snack Box') {
            if ($qty < 20) {
                return redirect()->back()->with('error', 'Minimal pemesanan Snack Box adalah 20 pcs.');
            }
        }

        Keranjang::where('user_id', $this->userId())
            ->where('produk_id', $produkId)
            ->where('varian_id', $varianId)
            ->update(['qty' => max(1, $qty)]);

        return redirect()->back()->with('success', 'Keranjang diperbarui.');
    }

    // ── Helpers ──────────────────────────────────────────────

    private function itemKey(int $produkId, ?int $varianId): string
    {
        return $varianId ? "{$produkId}_v{$varianId}" : (string) $produkId;
    }

    private function parseKey(string $key): array
    {
        if (str_contains($key, '_v')) {
            [$produkId, $varianId] = explode('_v', $key, 2);
            return [(int) $produkId, (int) $varianId];
        }
        return [(int) $key, null];
    }

    private function toArray(Keranjang $item): array
    {
        return [
            'id'          => $item->produk_id,
            'nama'        => $item->nama_produk,
            'nama_varian' => $item->nama_varian,
            'harga'       => $item->harga,
            'gambar'      => $item->gambar,
            'qty'         => $item->qty,
            'kategori_id' => $item->produk?->kategori_id,
        ];
    }
}
