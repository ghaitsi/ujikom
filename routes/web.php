<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;

// ADMIN
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\CekPeminjamanController;

// PEMINJAM
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Peminjam\PengembalianController;

// PETUGAS
use App\Http\Controllers\Petugas\PeminjamanPetugasController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT BY ROLE
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {

    $user = Auth::user();

    return match ($user->role ?? null) {
        'admin'     => redirect()->route('admin.dashboard'),
        'petugas'   => redirect()->route('petugas.dashboard'),
        'peminjam'  => redirect()->route('peminjam.dashboard'),
        default     => redirect('/'),
    };

})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('alat', AlatController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('peminjaman', CekPeminjamanController::class);
        Route::resource('log', LogAktivitasController::class);
    });

/*
|--------------------------------------------------------------------------
| PETUGAS (SESUAI PDF)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard',
            [PeminjamanPetugasController::class,'index']
        )->name('dashboard');

        // Halaman daftar peminjaman
        Route::get('/peminjaman',
            [PeminjamanPetugasController::class,'peminjaman']
        )->name('peminjaman.index');

        // Setujui peminjaman
        Route::post('/peminjaman/{id}/setujui',
            [PeminjamanPetugasController::class,'setujui']
        )->name('peminjaman.setujui');

        // Tolak peminjaman (INI YANG ERROR KEMARIN)
        Route::post('/peminjaman/{id}/tolak',
            [PeminjamanPetugasController::class,'tolak']
        )->name('peminjaman.tolak');

        // Konfirmasi pengembalian
        Route::post('/pengembalian/{id}',
            [PeminjamanPetugasController::class,'kembalikan']
        )->name('pengembalian.konfirmasi');

        // Laporan
        Route::get('/laporan',
            [PeminjamanPetugasController::class,'laporan']
        )->name('laporan');
    });

/*
|--------------------------------------------------------------------------
| PEMINJAM
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:peminjam'])
    ->prefix('peminjam')
    ->name('peminjam.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard',
            [PeminjamanController::class,'index']
        )->name('dashboard');

        // Ajukan peminjaman
        Route::post('/pinjam',
            [PeminjamanController::class,'pinjam']
        )->name('pinjam');

        // Halaman pengembalian
        Route::get('/pengembalian',
            [PengembalianController::class,'index']
        )->name('pengembalian');

        // Proses pengembalian
        Route::post('/pengembalian/{id}',
            [PengembalianController::class,'kembalikan']
        )->name('pengembalian.kembalikan');
    });

require __DIR__.'/auth.php';
