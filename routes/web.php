<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotifikasiController;

Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIN DAN REGISTER
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');
});

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('tarifs', TarifController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('kendaraans', KendaraanController::class);

    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])
        ->name('log.index');
});

// PETUGAS
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')->name('petugas.')->group(function () {

    Route::get('/dashboard', [PetugasController::class, 'index'])
        ->name('dashboard');

    Route::resource('transaksi', TransaksiController::class)
        ->only(['index', 'create', 'store']);

    Route::get('/transaksi/{transaksi}/keluar',
        [TransaksiController::class, 'keluar'])
        ->name('transaksi.keluar');

    Route::post('/transaksi/{transaksi}/selesai',
        [TransaksiController::class, 'selesai'])
        ->name('transaksi.selesai');

    Route::get('/transaksi/{transaksi}/struk',
        [TransaksiController::class, 'struk'])
        ->name('transaksi.struk');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])
        ->name('notifikasi.index');

    Route::post('/notifikasi/{id}/baca', [NotifikasiController::class, 'baca'])
        ->name('notifikasi.baca');
});

// OWNER
Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')->name('owner.')->group(function () {

    Route::get('/dashboard', [OwnerController::class, 'index'])
        ->name('dashboard');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])
        ->name('notifikasi.index');

    Route::post('/notifikasi/{id}/baca', [NotifikasiController::class, 'baca'])
        ->name('notifikasi.baca');
});