<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\MemberController;

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

// Route Khusus Peminjaman & Pengembalian Buku
Route::post('/peminjaman/pinjam', [MemberController::class, 'pinjam'])->name('peminjaman.pinjam');
Route::post('/peminjaman/kembali/{id}', [MemberController::class, 'kembali'])->name('peminjaman.kembali');