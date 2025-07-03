<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PencairanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
// === ROUTES DIMULAI DI SINI ===

// Login dan logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Admin Sekolah
Route::get('/dashboard/sekolah', function () {
    return view('AdminSekolah.layouts.admin');
});

// Daftar Siswa
Route::match(['get', 'post'], '/dashboard/sekolah/daftar-siswa', [SiswaController::class, 'adminFull'])->name('admin.daftarSiswa');

// Input Pencairan
Route::get('/dashboard/sekolah/input', [PencairanController::class, 'create'])->name('pencairan.create');
Route::post('/pencairan', [PencairanController::class, 'store'])->name('pencairan.store');


// Route halaman daftar siswa
// Route::get('/dashboard/sekolah/daftar-siswa', function () {
//     return view('AdminSekolah.siswa.daftarSiswa');
// });
// Route::get('/dashboard/sekolah/input', function () {
//     return view('AdminSekolah.input.inputPencairan');
// });
Route::get('/dashboard/sekolah/konfirmasi', function () {
    return view('AdminSekolah.konfirmasiBlockchain');
});
Route::get('/dashboard/sekolah/riwayat', function () {
    return view('AdminSekolah.riwayatPencairan');
});

// Konfirmasi
Route::get('/konfirmasi', [PencairanController::class, 'konfirmasiView'])->name('konfirmasi.index');
Route::post('/konfirmasi/{id}', [PencairanController::class, 'konfirmasi'])->name('konfirmasi.update');


// ... (lanjutkan route lain kamu seperti sebelumnya)
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');

// Route untuk kelola siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
