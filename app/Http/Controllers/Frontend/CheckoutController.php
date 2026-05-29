<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private function userId(): int
    {
        return Auth::guard('customer')->id();
    }

    private function getKeranjang(): array
    {
        return Keranjang::where('user_id', $this->userId())->with('produk.kategori')->get()
            ->mapWithKeys(function ($item) {
                $key = $item->varian_id
                    ? "{$item->produk_id}_v{$item->varian_id}"
                    : (string) $item->produk_id;

                return [$key => [
                    'id'            => $item->produk_id,
                    'nama'          => $item->nama_produk,
                    'nama_varian'   => $item->nama_varian,
                    'harga'         => $item->harga,
                    'gambar'        => $item->gambar,
                    'qty'           => $item->qty,
                    'nama_kategori' => $item->produk?->kategori?->nama_kategori,
                ]];
            })->toArray();
    }

    public function index()
    {
        $keranjang = $this->getKeranjang();

        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang masih kosong.');
        }

        $total           = collect($keranjang)->sum(fn($i) => $i['harga'] * $i['qty']);
        $hasBirthdayCake = collect($keranjang)->contains(fn($i) => ($i['nama_kategori'] ?? '') === 'Birthday Cakes');

        return view('frontend.checkout.index', compact('keranjang', 'total', 'hasBirthdayCake'));
    }

    public function sukses()
    {
        return view('frontend.checkout.sukses');
    }

    public function simpan(Request $request)
    {
        $keranjang = $this->getKeranjang();

        if (empty($keranjang)) {
            return response()->json(['error' => 'Keranjang kosong.'], 422);
        }

        $hasBirthdayCake = collect($keranjang)->contains(fn($i) => ($i['nama_kategori'] ?? '') === 'Birthday Cakes');

        $rules = [
            'nama'              => ['required', 'string', 'max:255'],
            'no_hp'             => ['required', 'string', 'max:20'],
            'metode_pengiriman' => ['required', 'in:toko,kirim'],
            'alamat'            => ['nullable', 'string'],
            'catatan_alamat'    => ['nullable', 'string'],
        ];

        if ($request->metode_pengiriman === 'kirim') {
            $rules['alamat'] = ['required', 'string'];
        }

        if ($hasBirthdayCake) {
            $rules['tulisan_kue']    = ['required', 'string', 'max:60'];
            $rules['catatan_custom'] = ['nullable', 'string'];
        }

        $validated = $request->validate($rules);
        $total     = collect($keranjang)->sum(fn($i) => $i['harga'] * $i['qty']);
        $userId    = $this->userId();

        DB::transaction(function () use ($validated, $keranjang, $total, $hasBirthdayCake, $userId) {
            $pesanan = Pesanan::create([
                'user_id'           => $userId,
                'nama'              => $validated['nama'],
                'no_hp'             => $validated['no_hp'],
                'alamat'            => $validated['alamat'] ?? null,
                'catatan_alamat'    => $validated['catatan_alamat'] ?? null,
                'metode_pengiriman' => $validated['metode_pengiriman'],
                'tulisan_kue'       => $hasBirthdayCake ? ($validated['tulisan_kue'] ?? null) : null,
                'catatan_custom'    => $hasBirthdayCake ? ($validated['catatan_custom'] ?? null) : null,
                'total_harga'       => $total,
                'status_pembayaran' => 'Belum Bayar',
                'status'            => 'Pending',
            ]);

            foreach ($keranjang as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id'  => $item['id'],
                    'jumlah'     => $item['qty'],
                    'harga'      => $item['harga'],
                ]);
            }

            // Kosongkan keranjang dari DB setelah pesanan dibuat
            Keranjang::where('user_id', $userId)->delete();
        });

        return response()->json(['success' => true]);
    }
}
