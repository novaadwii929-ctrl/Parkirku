<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TarifParkir;
use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\TransaksiParkir;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    // DASHBOARD ADMIN
    public function admin()
    {
        return view('admin.dashboard', [
            'jumlahPengguna' => User::count(),
            'jumlahPetugas' => User::where('role', 'petugas')->count(),
            'jumlahOwner' => User::where('role', 'owner')->count(),
            'jumlahTarif' => TarifParkir::count(),
            'jumlahArea' => AreaParkir::count(),
            'jumlahKendaraan' => Kendaraan::count(),
            'jumlahTransaksi' => TransaksiParkir::count(),
        ]);
    }

    // DASHBOARD PETUGAS
    public function petugas()
    {
        return view('petugas.dashboard', [
            'transaksiHariIni' => TransaksiParkir::whereDate(
                'created_at',
                today()
            )->count(),

            'kendaraanDiDalam' => TransaksiParkir::where(
                'status',
                'masuk'
            )->count(),

            'kendaraanKeluar' => TransaksiParkir::whereDate(
                'waktu_keluar',
                today()
            )->count(),
        ]);
    }

    // DASHBOARD OWNER
    public function owner()
    {
        return view('owner.dashboard', [
            'transaksiHariIni' => TransaksiParkir::whereDate(
                'created_at',
                today()
            )->count(),

            'transaksiBulanIni' => TransaksiParkir::whereMonth(
                'created_at',
                now()->month
            )->whereYear('created_at', now()->year)->count(),

            'transaksiTahunIni' => TransaksiParkir::whereYear(
                'created_at',
                now()->year
            )->count(),

            'pendapatanHariIni' => TransaksiParkir::whereDate(
                'waktu_keluar',
                today()
            )->sum('total_bayar'),

            'pendapatanBulanIni' => TransaksiParkir::whereMonth(
                'waktu_keluar',
                now()->month
            )->whereYear('waktu_keluar', now()->year)->sum('total_bayar'),

            'pendapatanTahunIni' => TransaksiParkir::whereYear(
                'waktu_keluar',
                now()->year
            )->sum('total_bayar'),
        ]);
    }
}