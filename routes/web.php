<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\KategoriController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Alat;
use App\Models\User;
use App\Models\LogAktivitas;
use App\Models\Kategori;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {

    $user = Auth::user();

    return match ($user->role ?? null) {
        'admin' => redirect()->route('admin.dashboard'),
        'petugas' => redirect()->route('petugas.dashboard'),
        'peminjam' => redirect()->route('peminjam.dashboard'),
        default => redirect('/'),
    };

})->middleware(['auth', 'verified'])->name('dashboard');


// ================= PROFILE =================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ================= ADMIN =================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')   // ⭐⭐⭐ INI YANG KURANG
    ->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('alat', AlatController::class);
    Route::resource('log', LogAktivitasController::class);
    Route::resource('kategori', KategoriController::class);


});


// ================= PETUGAS =================
Route::middleware(['auth', 'role:petugas'])->group(function () {

    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    })->name('petugas.dashboard');

});


// ================= PEMINJAM =================
Route::middleware(['auth', 'role:peminjam'])->group(function () {

    Route::get('/peminjam/dashboard', function () {
        return view('peminjam.dashboard');
    })->name('peminjam.dashboard');

});


require __DIR__.'/auth.php';
