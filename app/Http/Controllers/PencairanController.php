<?php

namespace App\Http\Controllers;

use App\Models\Pencairan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PencairanController extends Controller
{

    public function create()
    {
        $siswa = Siswa::all();
        return view('pencairan.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_cair' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required|string'
        ]);

        Pencairan::create([
            'siswa_id' => $request->siswa_id,
            'tanggal_cair' => $request->tanggal_cair,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'status' => 'Menunggu',
            'blockchain_tx' => null
        ]);

        return redirect()->back()->with('success', 'Data pencairan berhasil disimpan!');
    }

    public function dashboard()
{
    $user = auth()->user();

    // Ambil riwayat pencairan berdasarkan siswa_id
    $pencairan_riwayat = \App\Models\Pencairan::where('siswa_id', $user->id)->get();

    return view('Siswa.dashboardSiswa', compact('pencairan_riwayat'));
}

    // Menampilkan daftar data untuk dikonfirmasi admin
    public function konfirmasiView()
    {
        $data = Pencairan::with('siswa')->orderBy('created_at', 'desc')->get();
        return view('pencairan.konfirmasi', compact('data'));
    }
    public function riwayat()
    {
        $pencairan_riwayat = Pencairan::with('siswa')->orderBy('created_at', 'desc')->get();
        return view('riwayatPencairanSiswa', compact('pencairan_riwayat'));
        return view('Siswa.dashboardSiswa', compact('pencairan_riwayat'));

    }


    public function riwayatSekolah()
{
    $data = \App\Models\Pencairan::with('siswa')->orderBy('tanggal_cair', 'desc')->get();
    return view('(AdminSekolah).riwayat_pencairan', compact('data'));
}

    // Mengonfirmasi pencairan dan menambahkan TX simulatif
    public function konfirmasi($id)
    {
        $pencairan = Pencairan::findOrFail($id);

        $txId = 'TX-' . strtoupper(uniqid()); // Simulasi TX hash

        $pencairan->update([
            'status' => 'Sudah Cair',
            'blockchain_tx' => $txId
        ]);

        return redirect()->route('konfirmasi.index')->with('success', 'Pencairan telah dikonfirmasi dan dicatat di blockchain (simulasi)!');
    }

    //integrasi Web3.js
    public function simpanDenganTx(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_cair' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required|string',
            'blockchain_tx' => 'required|string'
        ]);

        $data = Pencairan::create([
            'siswa_id' => $request->siswa_id,
            'tanggal_cair' => $request->tanggal_cair,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'status' => 'Sudah Cair',
            'blockchain_tx' => $request->blockchain_tx
        ]);

        return response()->json(['message' => 'Data dengan transaksi blockchain berhasil disimpan!', 'data' => $data]);
    }

    public function lihatLaporan()
    {
    $laporan = \App\Models\Laporan::with('pencairan.siswa')->orderBy('created_at', 'desc')->get();
    return view('admin.laporan', compact('laporan'));
    }

}
