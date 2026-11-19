<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $aktivitas = LogAktivitas::with('user')
            ->latest('waktu')
            ->paginate(15);

        return view('admin.log_aktivitas.index', compact('aktivitas'));
    }
}