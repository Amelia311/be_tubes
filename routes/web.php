<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SkPipController;
use App\Http\Controllers\AdminSekolah\SiswaPipController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PencairanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminSekolahController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/sk-pip', [SkPipController::class, 'store'])->name('skpip.store');

// Login dan logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    

Route::get('/dashboard/sekolah', [SiswaController::class, 'index'])->name('dashboard.sekolah');

Route::get('/dashboard/siswa', function () {
    return view('Siswa.dashboardSiswa');
});

Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');

Route::get('/dashboard/siswa', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
Route::post('/dashboard/siswa', [SiswaController::class, 'dashboard'])->name('siswa.riwayat');
Route::get('/siswa/status-dana', [SiswaController::class, 'statusDana'])->name('siswa.statusDana');
Route::get('/siswa/detail', [SiswaController::class, 'detail'])->name('siswa.detail');
Route::post('/siswa/lapor', [LaporanController::class, 'store'])->name('siswa.laporStore');
Route::get('/laporan', [SiswaController::class, 'laporan'])->name('siswa.laporan');
Route::get('/transparansi', [SiswaController::class, 'transparansi'])->name('siswa.transparansi');
Route::get('/admin/akun-siswa', [AdminSekolahController::class, 'akunSiswa'])->name('akun.siswa');
Route::get('/admin/laporan-kendala', [AdminSekolahController::class, 'laporanKendala'])->name('laporan.kendala');
Route::get('/dashboard/sekolah/pengaduan', function () {
    return view('AdminSekolah.laporan_pengaduan.laporan_pengaduan');
})->name('pengaduan.index');





// // Daftar Siswa
// Route::match(['get', 'post'], '/dashboard/sekolah/daftar-siswa', [SiswaController::class, 'adminFull'])->name('admin.daftarSiswa');

// Input Pencairan

Route::get('/dashboard/sekolah/input', [PencairanController::class, 'create'])->name('pencairan.create');
Route::post('/pencairan', [PencairanController::class, 'store'])->name('pencairan.store');

Route::get('/dashboard/sekolah/konfirmasi', [PencairanController::class, 'konfirmasiView'])->name('konfirmasi.index');
Route::get('/dashboard/sekolah/riwayat', [PencairanController::class, 'riwayatSekolah'])->name('riwayat.sekolah');
Route::get('/dashboard/sekolah/transparansi', [SiswaController::class, 'transparansi'])->name('sekolah.transparansi');


// Konfirmasi
Route::get('/konfirmasi', [PencairanController::class, 'konfirmasiView'])->name('konfirmasi.index');
Route::post('/konfirmasi/{id}', [PencairanController::class, 'konfirmasi'])->name('konfirmasi.update');
Route::get('/siswa/konfirmasi', [PencairanController::class, 'formKonfirmasi'])->name('konfirmasi.form');
Route::post('/siswa/konfirmasi', [PencairanController::class, 'submitKonfirmasi'])->name('submitKonfirmasi');


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

Route::post('/api/simpan-blockchain-tx', [PencairanController::class, 'simpanTx'])->name('pencairan.simpanTx');
Route::post('/siswa/lapor', [LaporanController::class, 'store'])->name('siswa.laporStore');
Route::get('/transparansi-publik', [PencairanController::class, 'transparansiPublik'])->name('transparansi.publik');


// Route::get('/forgot-password', [ForgotPasswordController::class, 'show'])->name('password.forgot');
// Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
