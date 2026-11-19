<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraans';

    protected $fillable = [
        'no_plat',
        'jenis_kendaraan',
        'merk'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}