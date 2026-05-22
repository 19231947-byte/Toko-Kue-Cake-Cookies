<?php

namespace App\Models;

use App\Models\ProdukVarian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'produk_id');
    }

    public function varians()
    {
        return $this->hasMany(ProdukVarian::class, 'produk_id');
    }
}

