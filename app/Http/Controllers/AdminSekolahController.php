<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa; // jika kamu menggunakan model Siswa

class AdminSekolahController extends Controller
{
    public function laporanKendala()
{
    $laporanList = \App\Models\Laporan::all(); // atau filter sesuai status
    return view('AdminSekolah.laporan_kendala', compact('laporanList'));
}

    public function akunSiswa()
    {
        $siswaList = Siswa::all();
        return view('AdminSekolah.akun.akun_siswa', compact('siswaList'));
    }
    
}
