<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\PencairanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//Daftar Siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

//Input Pencairan
Route::get('/pencairan', [PencairanController::class, 'create'])->name('pencairan.create');
Route::post('/pencairan', [PencairanController::class, 'store'])->name('pencairan.store');

//konfirmasi pencairan
Route::get('/konfirmasi', [PencairanController::class, 'konfirmasiView'])->name('konfirmasi.index');
Route::post('/konfirmasi/{id}', [PencairanController::class, 'konfirmasi'])->name('konfirmasi.update');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

