<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PencairanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });


Route::get('/dashboard/sekolah', function () {
    return view('AdminSekolah.layouts.admin');
});
Route::get('/dashboard/siswa', function () {
    return view('Siswa.dashboardSiswa');
});

// Daftar Siswa
Route::match(['get', 'post'], '/dashboard/sekolah/daftar-siswa', [SiswaController::class, 'adminFull'])->name('admin.daftarSiswa');

// Input Pencairan

Route::get('/dashboard/sekolah/input', [PencairanController::class, 'create'])->name('pencairan.create');
Route::post('/pencairan', [PencairanController::class, 'store'])->name('pencairan.store');

// Route::get('/dashboard/sekolah/data-input', function () {
//     return view('AdminSekolah.input.dataInputPencairan');
// })->name('data.input');








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


Route::get('/dashboard/siswa/riwayat', function () {
    return view('Siswa.riwayatPencairanSiswa');
});
Route::post('/siswa/pencairan/{id}/konfirmasi', [SiswaController::class, 'konfirmasiPencairan'])->name('siswa.konfirmasiPencairan');
Route::get('/siswa/riwayat', [SiswaController::class, 'riwayat'])->name('siswa.riwayat');

Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-saya', [PencairanController::class, 'riwayat'])->name('siswa.riwayat');
});


//Input Pencairan
Route::get('/pencairan', [PencairanController::class, 'create'])->name('pencairan.create');
Route::post('/pencairan', [PencairanController::class, 'store'])->name('pencairan.store');

//konfirmasi pencairan
Route::get('/konfirmasi', [PencairanController::class, 'konfirmasiView'])->name('konfirmasi.index');
Route::post('/konfirmasi/{id}', [PencairanController::class, 'konfirmasi'])->name('konfirmasi.update');

//riwayatpencairansiswa
Route::get('/siswa/riwayat', [SiswaController::class, 'riwayatSaya'])->middleware('auth')->name('siswa.riwayat');
Route::post('/siswa/lapor/{id}', [SiswaController::class, 'lapor'])->middleware('auth')->name('siswa.lapor');
Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');

//Laporan
Route::post('/siswa/lapor/{id}', [SiswaController::class, 'lapor'])->name('siswa.lapor');
Route::post('/siswa/lapor-store', [\App\Http\Controllers\SiswaController::class, 'laporStore'])->name('siswa.laporStore');
Route::get('/dashboard-siswa', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
Route::get('/dashboard-siswa', [SiswaController::class, 'dashboard'])->name('siswa.dashboard')->middleware('auth');

// CRUD siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');





