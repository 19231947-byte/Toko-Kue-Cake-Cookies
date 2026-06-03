<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\ProdukVarian;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori', 'varians')->orderBy('nama_produk')->get();

        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk'          => ['required', 'string', 'max:255'],
            'deskripsi'            => ['nullable', 'string'],
            'harga'                => ['required', 'integer', 'min:0'],
            'stok'                 => ['nullable', 'integer', 'min:0'],
            'kategori_id'          => ['required', 'exists:kategoris,id'],
            'gambar'               => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'varians'              => ['nullable', 'array'],
            'varians.*.nama_varian'=> ['required_with:varians', 'string', 'max:100'],
            'varians.*.harga'      => ['required_with:varians', 'integer', 'min:0'],
            'varians.*.berat'      => ['nullable', 'numeric', 'min:0'],
            'varians.*.ukuran'     => ['nullable', 'string', 'max:100'],
        ]);

        if ($request->hasFile('gambar')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('gambar')->getRealPath(), [
                'folder' => 'produk',
            ])->getSecurePath();
            $validated['gambar'] = $uploadedFileUrl;
        }

        $produk = Produk::create($validated);

        // Simpan varian jika ada
        if (!empty($validated['varians'])) {
            foreach ($validated['varians'] as $varian) {
                $produk->varians()->create($varian);
            }
        }

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $produk->load('varians');

        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama_produk'          => ['required', 'string', 'max:255'],
            'deskripsi'            => ['nullable', 'string'],
            'harga'                => ['required', 'numeric', 'min:0'],
            'stok'                 => ['nullable', 'integer', 'min:0'],
            'kategori_id'          => ['required', 'exists:kategoris,id'],
            'gambar'               => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'varians'              => ['nullable', 'array'],
            'varians.*.nama_varian'=> ['required_with:varians', 'string', 'max:100'],
            'varians.*.harga'      => ['required_with:varians', 'numeric', 'min:0'],
            'varians.*.berat'      => ['nullable', 'numeric', 'min:0'],
            'varians.*.ukuran'     => ['nullable', 'string', 'max:100'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                if (str_contains($produk->gambar, 'cloudinary.com')) {
                    // Ekstrak public_id dari URL Cloudinary
                    // Format: .../upload/v12345678/folder/public_id.jpg
                    $path = parse_url($produk->gambar, PHP_URL_PATH);
                    $segments = explode('/', $path);
                    $filename = end($segments);
                    $publicIdWithFolder = $segments[count($segments) - 2] . '/' . pathinfo($filename, PATHINFO_FILENAME);
                    
                    try {
                        Cloudinary::destroy($publicIdWithFolder);
                    } catch (\Exception $e) {
                        // Abaikan jika gagal hapus di cloudinary
                    }
                } else {
                    Storage::disk('public')->delete($produk->gambar);
                }
            }
            
            $uploadedFileUrl = Cloudinary::upload($request->file('gambar')->getRealPath(), [
                'folder' => 'produk',
            ])->getSecurePath();
            $validated['gambar'] = $uploadedFileUrl;
        }

        // Update data produk (tanpa key varians)
        $produk->update(\Arr::except($validated, ['varians']));

        // Sync varian: hapus lama, simpan baru
        $produk->varians()->delete();

        if (!empty($validated['varians'])) {
            foreach ($validated['varians'] as $varian) {
                // Hanya simpan field yang ada di fillable
                $produk->varians()->create([
                    'nama_varian' => $varian['nama_varian'],
                    'harga'       => $varian['harga'],
                    'berat'       => $varian['berat'] ?? null,
                    'ukuran'      => $varian['ukuran'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar) {
            if (str_contains($produk->gambar, 'cloudinary.com')) {
                $path = parse_url($produk->gambar, PHP_URL_PATH);
                $segments = explode('/', $path);
                $filename = end($segments);
                $publicIdWithFolder = $segments[count($segments) - 2] . '/' . pathinfo($filename, PATHINFO_FILENAME);
                
                try {
                    Cloudinary::destroy($publicIdWithFolder);
                } catch (\Exception $e) {
                    // Abaikan
                }
            } else {
                Storage::disk('public')->delete($produk->gambar);
            }
        }
        $produk->delete(); // varian terhapus otomatis karena cascade

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}

