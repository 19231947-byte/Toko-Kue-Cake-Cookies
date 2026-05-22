<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $fillable = ['kode', 'nama_alternatif'];

    public function penilaians()
    {
        return $this->hasMany(PenilaianAlternatif::class);
    }
}
