<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Area;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function index()
    {
        $petugasId = Auth::id();

        // Transaksi hari ini
        $transaksiHariIni = Transaksi::where(
            'petugas_id', $petugasId
        )->whereDate('created_at', today())->count();

        // Kendaraan sedang parkir
        $sedangParkir = Transaksi::where(
            'petugas_id', $petugasId
        )->where('status', 'parkir')->count();

        // Transaksi selesai hari ini
        $selesaiHariIni = Transaksi::where(
            'petugas_id', $petugasId
        )->where('status', 'selesai')
         ->whereDate('updated_at', today())
         ->count();

        // Informasi slot parkir
        $areas = Area::all();

        foreach ($areas as $area) {
            $area->terisi = Transaksi::where(
                'area_id', $area->id
            )->where('status', 'parkir')->count();

            $area->tersedia = max(
                0,
                $area->kapasitas - $area->terisi
            );
        }

        $totalKapasitas = $areas->sum('kapasitas');
        $totalTerisi = $areas->sum('terisi');
        $totalTersedia = $areas->sum('tersedia');

        return view('petugas.dashboard', compact(
            'transaksiHariIni',
            'sedangParkir',
            'selesaiHariIni',
            'areas',
            'totalKapasitas',
            'totalTerisi',
            'totalTersedia'
        ));
    }
}