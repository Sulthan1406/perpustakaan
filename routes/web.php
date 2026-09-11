<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PeminjamanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect halaman utama langsung ke data buku
Route::get('/', function () {
    return redirect()->route('buku.index');
});

// Route CRUD Buku
Route::resource('buku', BukuController::class);

// Route CRUD Kategori Buku
Route::resource('kategori', KategoriBukuController::class);

// Route CRUD Member
Route::resource('member', MemberController::class);

// Route Peminjaman Buku
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::post('/peminjaman', [PeminjamanController::class, 'pinjamBuku'])->name('peminjaman.store');

//route pengembalian buku
Route::post('/member/{id}/kembalikan', [MemberController::class, 'kembalikanBuku'])->name('member.kembalikan');
