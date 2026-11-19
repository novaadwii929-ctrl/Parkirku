<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarifs';

    protected $fillable = [
        'jenis_kendaraan',
        'tarif_per_jam'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}