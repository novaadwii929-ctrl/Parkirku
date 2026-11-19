<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::where(function ($query) {
            $query->whereNull('user_id')
                  ->orWhere('user_id', auth()->id());
        })->latest()->paginate(15);

        return view('notifikasi.index', compact('notifikasis'));
    }

    public function baca($id)
    {
        $notifikasi = Notifikasi::whereKey($id)
            ->where(function ($query) {
                $query->whereNull('user_id')
                      ->orWhere('user_id', auth()->id());
            })
            ->firstOrFail();

        $notifikasi->update([
            'dibaca' => true,
        ]);

        return back()->with('success', 'Notifikasi sudah dibaca.');
    }
}