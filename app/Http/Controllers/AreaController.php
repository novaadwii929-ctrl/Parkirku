<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::latest()->paginate(10);

        return view('admin.areas.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.areas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_area' => 'required|string|max:100|unique:areas,nama_area',
            'kapasitas' => 'required|integer|min:1',
            'aktif' => 'required|boolean',
        ]);

        $area = Area::create($validated);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambahkan area parkir: ' . $area->nama_area,
            'waktu' => now(),
        ]);

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area parkir berhasil ditambahkan.');
    }

    public function edit(Area $area)
    {
        return view('admin.areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            'nama_area' => 'required|string|max:100|unique:areas,nama_area,' . $area->id,
            'kapasitas' => 'required|integer|min:1',
            'aktif' => 'required|boolean',
        ]);

        $area->update($validated);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengubah area parkir: ' . $area->nama_area,
            'waktu' => now(),
        ]);

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area parkir berhasil diperbarui.');
    }

    public function destroy(Area $area)
    {
        if ($area->transaksis()->exists()) {
            return back()->with(
                'error',
                'Area tidak dapat dihapus karena sudah digunakan dalam transaksi.'
            );
        }

        $nama = $area->nama_area;

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus area parkir: ' . $nama,
            'waktu' => now(),
        ]);

        $area->delete();

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area parkir berhasil dihapus.');
    }
}