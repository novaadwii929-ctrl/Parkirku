<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class OwnerController extends Controller
{
    public function index()
    {
        $totalKendaraan = Transaksi::where(
            'status', 'selesai'
        )->count();

        $totalPendapatan = Transaksi::where(
            'status', 'selesai'
        )->sum('total_biaya');

        return view('owner.dashboard', compact(
            'totalKendaraan',
            'totalPendapatan'
        ));
    }
}