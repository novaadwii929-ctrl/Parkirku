<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggalMulai = $validated['tanggal_mulai']
            ?? now()->startOfMonth()->toDateString();

        $tanggalAkhir = $validated['tanggal_akhir']
            ?? now()->toDateString();

        $query = Transaksi::with([
            'kendaraan',
            'area',
            'tarif',
            'petugas'
        ])
            ->where('status', 'selesai')
            ->whereBetween('waktu_keluar', [
                $tanggalMulai . ' 00:00:00',
                $tanggalAkhir . ' 23:59:59',
            ]);

        $totalKendaraan = (clone $query)->count();

        $totalPendapatan = (clone $query)->sum('total_biaya');

        $transaksis = (clone $query)
            ->orderByDesc('waktu_keluar')
            ->paginate(15)
            ->withQueryString();

        return view('owner.laporan.index', compact(
            'tanggalMulai',
            'tanggalAkhir',
            'totalKendaraan',
            'totalPendapatan',
            'transaksis'
        ));
    }
}