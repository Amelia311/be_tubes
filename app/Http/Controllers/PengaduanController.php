<?php

// namespace App\Http\Controllers;

// use App\Models\Pengaduan;
// use App\Models\Siswa;
// use Illuminate\Http\Request;

// class PengaduanController extends Controller
// {
//     public function index()
//     {
//         $pengaduan = Pengaduan::with('siswa')->latest()->get();
//         return view('AdminSekolah.laporanpengaduan.laporan_pengaduan', compact('pengaduan'));
//     }

//     public function updateStatus(Request $request, $id)
//     {
//         $request->validate([
//             'status' => 'required|in:diajukan,diproses,selesai',
//         ]);
    
//         $pengaduan = Pengaduan::findOrFail($id);
//         $pengaduan->update(['status' => $request->status]);
    
//         return response()->json(['message' => 'Status berhasil diperbarui']);
//     }
// }

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Laporan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with('siswa')->latest()->get();
        $laporan = Laporan::with('pencairan.siswa')->latest()->get();
    
        $pengaduanMapped = collect($pengaduan->map(function($item) {
            return [
                'id' => $item->id,
                'nama' => $item->siswa->nama,
                'kelas' => $item->siswa->kelas,
                'pesan' => $item->masalah,
                'bukti' => $item->bukti,
                'status' => $item->status,
                'tipe' => 'pengaduan',
                'created_at' => $item->created_at,
            ];
        }));
    
        $laporanMapped = collect($laporan->map(function($item) {
            return [
                'id' => $item->id,
                'nama' => $item->pencairan->siswa->nama ?? 'N/A',
                'kelas' => $item->pencairan->siswa->kelas ?? 'N/A',
                'pesan' => $item->pesan,
                'bukti' => $item->bukti,
                'status' => $item->status,
                'tipe' => 'laporan',
                'blockchain_tx' => $item->blockchain_tx ?? $item->pencairan->blockchain_tx ?? null, // 🔥 tambahkan ini
                'created_at' => $item->created_at,
            ];
        }));
        
        $data = $pengaduanMapped->merge($laporanMapped)->sortByDesc('created_at');
    
        return view('AdminSekolah.laporanpengaduan.laporan_pengaduan', ['pengaduan' => $data]);
    }
    
    
    

    // fungsi updateStatus tetap untuk pengaduan saja (kalau mau update laporan harus buat fungsi khusus)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diajukan,diproses,selesai',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => $request->status]);

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }
}

