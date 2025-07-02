<?php

use App\Http\Controllers\Api\PencairanApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PencairanController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Daftar siswa
Route::get('/siswa', [SiswaController::class, 'index']);
Route::post('/siswa', [SiswaController::class, 'store']);
Route::get('/siswa/{id}', [SiswaController::class, 'show']);
Route::put('/siswa/{id}', [SiswaController::class, 'update']);
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);

//Input pencairan
Route::post('/pencairan', [PencairanApiController::class, 'store']);
Route::get('/pencairan', [PencairanApiController::class, 'index']);

//konfirmasi pencairan
Route::post('/simpan-pencairan', [PencairanController::class, 'simpan']);
Route::get('/riwayat/{nisn}', [PencairanController::class, 'riwayat']);
Route::get('/semua-riwayat', [PencairanController::class, 'semua']);

//riwayat pencairan
Route::get('/admin/riwayat-pencairan', [PencairanController::class, 'riwayatSekolah'])->name('admin.riwayat');
