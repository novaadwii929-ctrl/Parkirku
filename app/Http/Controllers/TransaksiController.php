<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kendaraan;
use App\Models\Tarif;
use App\Models\Area;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with([
            'kendaraan', 'tarif', 'area', 'petugas'
        ])->latest()->paginate(15);

        return view('petugas.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $kendaraans = Kendaraan::orderBy('no_plat')->get();

        $tarifs = Tarif::orderBy('jenis_kendaraan')->get();

        $areas = Area::where('aktif', true)
            ->withCount([
                'transaksis as terisi' => function ($query) {
                    $query->where('status', 'parkir');
                }
            ])
            ->orderBy('nama_area')
            ->get();

        foreach ($areas as $area) {
            $area->tersedia = max(
                0,
                $area->kapasitas - $area->terisi
            );
        }

        return view('petugas.transaksi.create', compact(
            'kendaraans',
            'tarifs',
            'areas'
        ));
    }

    // TRANSAKSI KENDARAAN MASUK
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'area_id' => 'required|exists:areas,id',
        ]);

        $kendaraan = Kendaraan::findOrFail(
            $validated['kendaraan_id']
        );

        $tarif = Tarif::where(
            'jenis_kendaraan',
            $kendaraan->jenis_kendaraan
        )->first();

        if (!$tarif) {
            return back()->withInput()->with(
                'error',
                'Tarif untuk jenis kendaraan ini belum tersedia.'
            );
        }

        try {
            $transaksi = DB::transaction(function () use (
                $kendaraan,
                $tarif,
                $validated
            ) {
                $area = Area::whereKey($validated['area_id'])
                    ->where('aktif', true)
                    ->lockForUpdate()
                    ->first();

                if (!$area) {
                    throw new \RuntimeException(
                        'Area parkir tidak aktif atau tidak ditemukan.'
                    );
                }

                $sedangParkir = Transaksi::where(
                    'area_id',
                    $area->id
                )->where('status', 'parkir')->count();

                if ($sedangParkir >= $area->kapasitas) {
                    throw new \RuntimeException(
                        'Area parkir sudah penuh.'
                    );
                }

                $kendaraanSedangParkir = Transaksi::where(
                    'kendaraan_id',
                    $kendaraan->id
                )->where('status', 'parkir')->exists();

                if ($kendaraanSedangParkir) {
                    throw new \RuntimeException(
                        'Kendaraan ini masih tercatat sedang parkir.'
                    );
                }

                $transaksi = Transaksi::create([
                    'kode_transaksi' => 'PKR-' .
                        now()->format('YmdHis') . '-' .
                        Str::upper(Str::random(4)),
                    'kendaraan_id' => $kendaraan->id,
                    'tarif_id' => $tarif->id,
                    'area_id' => $area->id,
                    'petugas_id' => auth()->id(),
                    'waktu_masuk' => now(),
                    'waktu_keluar' => null,
                    'durasi_menit' => null,
                    'total_biaya' => 0,
                    'status' => 'parkir',
                ]);

                // NOTIFIKASI KENDARAAN MASUK
                Notifikasi::create([
                    'user_id' => null,
                    'judul' => 'Kendaraan Masuk',
                    'pesan' => 'Kendaraan ' . $kendaraan->no_plat .
                        ' berhasil masuk ke area ' . $area->nama_area . '.',
                    'dibaca' => false,
                ]);

                return $transaksi;
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->with(
                'error',
                $e->getMessage()
            );
        }

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mencatat kendaraan masuk: ' . $kendaraan->no_plat,
            'waktu' => now(),
        ]);

        return redirect()->route('petugas.transaksi.index')
            ->with('success', 'Kendaraan berhasil dicatat masuk.');
    }

    // HALAMAN KENDARAAN KELUAR
    public function keluar(Transaksi $transaksi)
    {
        if ($transaksi->status !== 'parkir') {
            return redirect()->route('petugas.transaksi.index')
                ->with('error', 'Transaksi ini sudah selesai.');
        }

        $transaksi->load(['kendaraan', 'tarif', 'area']);

        return view('petugas.transaksi.keluar', compact('transaksi'));
    }

    // MENYELESAIKAN TRANSAKSI
    public function selesai(Request $request, Transaksi $transaksi)
    {
        $hasil = DB::transaction(function () use ($transaksi) {
            $data = Transaksi::whereKey($transaksi->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($data->status !== 'parkir') {
                return false;
            }

            $waktuMasuk = $data->waktu_masuk;
            $waktuKeluar = now();

            $durasiMenit = max(
                1,
                (int) ceil(
                    $waktuMasuk->diffInSeconds($waktuKeluar) / 60
                )
            );

            $jumlahJam = max(1, (int) ceil($durasiMenit / 60));

            $tarifPerJam = (float) $data->tarif->tarif_per_jam;

            $totalBiaya = $jumlahJam * $tarifPerJam;

            $data->update([
                'waktu_keluar' => $waktuKeluar,
                'durasi_menit' => $durasiMenit,
                'total_biaya' => $totalBiaya,
                'status' => 'selesai',
            ]);

            $data->load('kendaraan');

            // NOTIFIKASI TRANSAKSI SELESAI
            Notifikasi::create([
                'user_id' => null,
                'judul' => 'Transaksi Selesai',
                'pesan' => 'Transaksi ' . $data->kode_transaksi .
                    ' untuk kendaraan ' . $data->kendaraan->no_plat .
                    ' telah selesai. Total biaya Rp ' .
                    number_format($totalBiaya, 0, ',', '.') . '.',
                'dibaca' => false,
            ]);

            return true;
        });

        if (!$hasil) {
            return redirect()->route('petugas.transaksi.index')
                ->with('error', 'Transaksi sudah selesai sebelumnya.');
        }

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menyelesaikan transaksi: ' . $transaksi->kode_transaksi,
            'waktu' => now(),
        ]);

        return redirect()->route('petugas.transaksi.struk', $transaksi->id);
    }

    // CETAK STRUK
    public function struk(Transaksi $transaksi)
    {
        $transaksi->load([
            'kendaraan', 'tarif', 'area', 'petugas'
        ]);

        return view('petugas.transaksi.struk', compact('transaksi'));
    }
}