<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tarif;
use App\Models\Area;
use App\Models\Kendaraan;
use App\Models\Transaksi;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUser' => User::count(),
            'totalTarif' => Tarif::count(),
            'totalArea' => Area::count(),
            'totalKendaraan' => Kendaraan::count(),
            'totalTransaksi' => Transaksi::count(),
        ]);
    }
}