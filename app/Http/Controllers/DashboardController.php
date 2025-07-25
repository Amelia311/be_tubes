<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Pencairan;
use App\Models\SkPip;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenerima = Siswa::count();
        $sudahMenerima = Pencairan::where('semester', 'Ganjil')->distinct('siswa_id')->count('siswa_id');

        $belumMenerima = $totalPenerima - $sudahMenerima;

        // Hitung persentase untuk tampilan
        $persenSudah = $totalPenerima > 0 ? round(($sudahMenerima / $totalPenerima) * 100) : 0;
        $persenBelum = 100 - $persenSudah;

        // Ambil data SK
        $skPip = SkPip::latest()->get();

        return view('AdminSekolah.dashboard', [
            'totalPenerima' => $totalPenerima,
            'sudahMenerima' => $sudahMenerima,
            'belumMenerima' => $belumMenerima,
            'persenSudah' => $persenSudah,
            'persenBelum' => $persenBelum,
            'skPip' => $skPip
        ]);
    }
}
