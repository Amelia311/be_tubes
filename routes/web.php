<?php

use App\Http\Controllers\AdminSekolah\DashboardController;
use App\Http\Controllers\AdminSekolah\SkPipController;
use App\Http\Controllers\AdminSekolah\SiswaPipController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PencairanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminSekolahController;


Route::get('/admin/dashboard', function () {
    // Data dummy untuk testing
    $skPip = collect([
        (object)[
            'nama_sk' => 'SK PIP 2025',
            'tahun' => 2025,
            'semester' => 1,
            'file_path' => 'sk/sk_pip_2025_sem1.pdf',
        ]
    ]);

    $penerimaSemester1 = collect([
        (object)[
            'nama' => 'Amel',
            'nisn' => '1234567890',
            'kelas' => 'XII RPL 1',
            'no_rekening' => '123456789',
            'status_pencairan' => true
        ],
        (object)[
            'nama' => 'Budi',
            'nisn' => '0987654321',
            'kelas' => 'XII RPL 2',
            'no_rekening' => '987654321',
            'status_pencairan' => false
        ],
    ]);

    $penerimaSemester2 = collect([]); // kosong dulu buat test else

    return view('adminsekolah.dashboard', compact('skPip', 'penerimaSemester1', 'penerimaSemester2'));
});



Route::get('/', function () {
    return redirect()->route('login');
});


// Login dan logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // SK PIP Routes
    Route::prefix('sk-pip')->name('sk-pip.')->group(function () {
        Route::get('/', [SkPipController::class, 'index'])->name('index');
        Route::post('/', [SkPipController::class, 'store'])->name('store');
        Route::get('/download/{id}', [SkPipController::class, 'download'])->name('download');
        Route::delete('/{id}', [SkPipController::class, 'destroy'])->name('destroy');
    });
    
    // Siswa PIP Routes
    Route::prefix('siswa-pip')->name('siswa-pip.')->group(function () {
        Route::get('/semester-1', [SiswaPipController::class, 'semester1'])->name('semester1');
        Route::get('/semester-2', [SiswaPipController::class, 'semester2'])->name('semester2');
        Route::get('/{id}', [SiswaPipController::class, 'show'])->name('show');
    });


// // Dashboard Admin Sekolah
// Route::get('/dashboard/sekolah', function () {
//     return view('AdminSekolah.siswa.daftarSiswa');

Route::get('/dashboard/sekolah', [SiswaController::class, 'index'])->name('dashboard.sekolah');

Route::get('/dashboard/siswa', function () {
    return view('Siswa.dashboardSiswa');
});

Route::get('/dashboard/siswa', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
Route::post('/dashboard/siswa', [SiswaController::class, 'dashboard'])->name('siswa.riwayat');
Route::get('/siswa/status-dana', [SiswaController::class, 'statusDana'])->name('siswa.statusDana');
Route::get('/siswa/detail', [SiswaController::class, 'detail'])->name('siswa.detail');
Route::post('/siswa/lapor', [LaporanController::class, 'store'])->name('siswa.laporStore');
Route::get('/laporan', [SiswaController::class, 'laporan'])->name('siswa.laporan');
Route::get('/transparansi', [SiswaController::class, 'transparansi'])->name('siswa.transparansi');
Route::get('/admin/akun-siswa', [AdminSekolahController::class, 'akunSiswa'])->name('akun.siswa');
Route::get('/admin/laporan-kendala', [AdminSekolahController::class, 'laporanKendala'])->name('laporan.kendala');





// Daftar Siswa
Route::match(['get', 'post'], '/dashboard/sekolah/daftar-siswa', [SiswaController::class, 'adminFull'])->name('admin.daftarSiswa');

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


Route::get('/forgot-password', [ForgotPasswordController::class, 'show'])->name('password.forgot');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
