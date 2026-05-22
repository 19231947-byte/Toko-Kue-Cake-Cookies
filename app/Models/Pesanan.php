<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'no_hp',
        'alamat',
        'catatan_alamat',
        'metode_pengiriman',
        'tulisan_kue',
        'catatan_custom',
        'total_harga',
        'status_pembayaran',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}

