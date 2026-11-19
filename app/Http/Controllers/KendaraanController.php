<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::latest()->paginate(10);

        return view('admin.kendaraans.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kendaraans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:20|unique:kendaraans,no_plat',
            'jenis_kendaraan' => 'required|in:Motor,Mobil,Truk,Bus,Lainnya',
            'merk' => 'nullable|string|max:100',
        ]);

        $kendaraan = Kendaraan::create($validated);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambahkan kendaraan: ' . $kendaraan->no_plat,
            'waktu' => now(),
        ]);

        return redirect()->route('admin.kendaraans.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('admin.kendaraans.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'no_plat' => [
                'required',
                'string',
                'max:20',
                Rule::unique('kendaraans', 'no_plat')->ignore($kendaraan->id),
            ],
            'jenis_kendaraan' => 'required|in:Motor,Mobil,Truk,Bus,Lainnya',
            'merk' => 'nullable|string|max:100',
        ]);

        $kendaraan->update($validated);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengubah data kendaraan: ' . $kendaraan->no_plat,
            'waktu' => now(),
        ]);

        return redirect()->route('admin.kendaraans.index')
            ->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        if ($kendaraan->transaksis()->exists()) {
            return back()->with(
                'error',
                'Kendaraan tidak dapat dihapus karena memiliki riwayat transaksi.'
            );
        }

        $plat = $kendaraan->no_plat;

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus kendaraan: ' . $plat,
            'waktu' => now(),
        ]);

        $kendaraan->delete();

        return redirect()->route('admin.kendaraans.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }
}