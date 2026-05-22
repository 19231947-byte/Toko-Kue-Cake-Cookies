<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    protected $table = 'pesan_kontak';

    protected $fillable = ['nama', 'no_telepon', 'email', 'subjek', 'pesan', 'status'];
}
