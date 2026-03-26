<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;

// ================= ADMIN =================
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\CekPeminjamanController;
use App\Http\Controllers\Admin\PengembalianController; // ✅ TAMBAHAN

// ================= PEMINJAM =================
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Peminjam\PengembalianController as PeminjamPengembalianController;

// ================= PETUGAS =================
use App\Http\Controllers\Petugas\PeminjamanPetugasController;
use App\Http\Controllers\Petugas\LaporanController;



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

        // ✅ HALAMAN DATA PENGEMBALIAN ADMIN
        Route::get('/pengembalian',
            [PengembalianController::class,'index']
        )->name('pengembalian.index');
    });


/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard',
            [PeminjamanPetugasController::class,'index']
        )->name('dashboard');

        Route::get('/peminjaman',
            [PeminjamanPetugasController::class,'peminjaman']
        )->name('peminjaman.index');

        Route::post('/peminjaman/{id}/setujui',
            [PeminjamanPetugasController::class,'setujui']
        )->name('peminjaman.setujui');

        Route::post('/peminjaman/{id}/tolak',
            [PeminjamanPetugasController::class,'tolak']
        )->name('peminjaman.tolak');

        Route::post('/pengembalian/{id}',
            [PeminjamanPetugasController::class,'kembalikan']
        )->name('pengembalian.konfirmasi');

        Route::get('/laporan',
            [PeminjamanPetugasController::class,'laporan']
        )->name('laporan');
    });
    
Route::get('/petugas/laporan', [LaporanController::class,'index'])
    ->name('petugas.laporan');


/*
|--------------------------------------------------------------------------
| PEMINJAM
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:peminjam'])
    ->prefix('peminjam')
    ->name('peminjam.')
    ->group(function () {

        Route::get('/dashboard',
            [PeminjamanController::class,'index']
        )->name('dashboard');

        Route::post('/pinjam',
            [PeminjamanController::class,'pinjam']
        )->name('pinjam');

        Route::get('/pengembalian',
            [PeminjamPengembalianController::class,'index']
        )->name('pengembalian');

        Route::post('/pengembalian/{id}',
            [PeminjamPengembalianController::class,'kembalikan']
        )->name('pengembalian.kembalikan');
    });


require __DIR__.'/auth.php';
