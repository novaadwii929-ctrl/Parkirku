<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::latest()->paginate(10);

        return view('admin.tarifs.index', compact('tarifs'));
    }

    public function create()
    {
        return view('admin.tarifs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kendaraan' => 'required|string|max:100|unique:tarifs,jenis_kendaraan',
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        $tarif = Tarif::create($validated);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambahkan tarif kendaraan: ' . $tarif->jenis_kendaraan,
            'waktu' => now(),
        ]);

        return redirect()->route('admin.tarifs.index')
            ->with('success', 'Tarif berhasil ditambahkan.');
    }

    public function edit(Tarif $tarif)
    {
        return view('admin.tarifs.edit', compact('tarif'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $validated = $request->validate([
            'jenis_kendaraan' => 'required|string|max:100|unique:tarifs,jenis_kendaraan,' . $tarif->id,
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        $tarif->update($validated);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengubah tarif kendaraan: ' . $tarif->jenis_kendaraan,
            'waktu' => now(),
        ]);

        return redirect()->route('admin.tarifs.index')
            ->with('success', 'Tarif berhasil diperbarui.');
    }

    public function destroy(Tarif $tarif)
    {
        if ($tarif->transaksis()->exists()) {
            return back()->with(
                'error',
                'Tarif tidak dapat dihapus karena sudah digunakan dalam transaksi.'
            );
        }

        $jenis = $tarif->jenis_kendaraan;

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus tarif kendaraan: ' . $jenis,
            'waktu' => now(),
        ]);

        $tarif->delete();

        return redirect()->route('admin.tarifs.index')
            ->with('success', 'Tarif berhasil dihapus.');
    }
}