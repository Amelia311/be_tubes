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

        // Statistik umum
        $sudahMenerima = Pencairan::where('semester', 'Ganjil')
            ->distinct('siswa_id')
            ->count('siswa_id');
        $belumMenerima = $totalPenerima - $sudahMenerima;

        $persenSudah = $totalPenerima > 0 ? round(($sudahMenerima / $totalPenerima) * 100) : 0;
        $persenBelum = 100 - $persenSudah;

        // Ambil data SK terbaru
        $skPip = SkPip::latest()->take(5)->get();

        // Data untuk grafik
        $kelasList = ['X', 'XI', 'XII'];

        // === Ganjil ===
        $sudahTarikGanjil = [];
        $belumTarikGanjil = [];

        foreach ($kelasList as $kelas) {
            $sudahCount = Pencairan::where('semester', 'Ganjil')
                ->where('status', 'Sudah Cair')
                ->whereNotNull('bukti')
                ->whereHas('siswa', function ($q) use ($kelas) {
                    $q->where('kelas', $kelas);
                })
                ->count();

            $total = Siswa::where('kelas', $kelas)->count();
            $sudahTarikGanjil[] = $sudahCount;
            $belumTarikGanjil[] = max($total - $sudahCount, 0);
        }

        // === Genap ===
        $sudahTarikGenap = [];
        $belumTarikGenap = [];

        foreach ($kelasList as $kelas) {
            $sudahCount = Pencairan::where('semester', 'Genap')
                ->where('status', 'Sudah Cair')
                ->whereHas('siswa', function ($q) use ($kelas) {
                    $q->where('kelas', $kelas);
                })
                ->count();

            $total = Siswa::where('kelas', $kelas)->count();
            $sudahTarikGenap[] = $sudahCount;
            $belumTarikGenap[] = max($total - $sudahCount, 0);
        }

        return view('AdminSekolah.dashboard', [
            'totalPenerima' => $totalPenerima,
            'sudahMenerima' => $sudahMenerima,
            'belumMenerima' => $belumMenerima,
            'persenSudah' => $persenSudah,
            'persenBelum' => $persenBelum,
            'skPip' => $skPip,
            'sudahTarikGanjil' => $sudahTarikGanjil, // cukup array
            'belumTarikGanjil' => $belumTarikGanjil,
            'sudahTarikGenap' => $sudahTarikGenap,
            'belumTarikGenap' => $belumTarikGenap,
        ]);
    }
}
