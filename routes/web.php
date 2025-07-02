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
    return view('AdminSekolah.dashboardsekolah');
});

// Daftar Siswa
Route::match(['get', 'post'], '/dashboard/sekolah/daftar-siswa', [SiswaController::class, 'adminFull'])->name('admin.daftarSiswa');

// Input Pencairan
Route::get('/dashboard/sekolah/input', [PencairanController::class, 'create'])->name('pencairan.create');
Route::post('/pencairan', [PencairanController::class, 'store'])->name('pencairan.store');

// Redirect setelah simpan
Route::get('/dashboard/sekolah/data-input', function () {
    return view('AdminSekolah.data_input_pencairan');
})->name('data.input');

// Konfirmasi
Route::get('/konfirmasi', [PencairanController::class, 'konfirmasiView'])->name('konfirmasi.index');
Route::post('/konfirmasi/{id}', [PencairanController::class, 'konfirmasi'])->name('konfirmasi.update');

// ... (lanjutkan route lain kamu seperti sebelumnya)
