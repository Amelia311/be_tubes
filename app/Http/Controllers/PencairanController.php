<?php

namespace App\Http\Controllers;

use App\Models\Pencairan;
use App\Models\Siswa;
use App\Models\Laporan;
use Illuminate\Http\Request;

class PencairanController extends Controller
{
    /**
     * Menampilkan form input pencairan
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('AdminSekolah.input.inputPencairan', compact('siswa'));
    }

    /**
     * Menyimpan data pencairan
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_cair' => 'required|date|before_or_equal:today',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required|string',
        ]);

        Pencairan::create([
            'siswa_id' => $request->siswa_id,
            'tanggal_cair' => $request->tanggal_cair,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'status' => 'Menunggu',
            'blockchain_tx' => null,
        ]);

        return redirect()->route('data.input')->with('success', 'Data pencairan berhasil disimpan!');
    }

    /**
     * Menampilkan daftar data untuk dikonfirmasi admin
     */
    public function konfirmasiView()
    {
        $data = Pencairan::with('siswa')->orderBy('created_at', 'desc')->get();
        return view('pencairan.konfirmasi', compact('data'));
    }

    /**
     * Menampilkan riwayat pencairan untuk admin sekolah
     */
    public function riwayatSekolah()
    {
        $data = Pencairan::with('siswa')->orderBy('tanggal_cair', 'desc')->get();
        return view('AdminSekolah.riwayatPencairan', compact('data'));
    }

    /**
     * Mengonfirmasi pencairan dan memberikan simulasi TX ID blockchain
     */
    public function konfirmasi($id)
    {
        $pencairan = Pencairan::findOrFail($id);
        $txId = 'TX-' . strtoupper(uniqid());

        $pencairan->update([
            'status' => 'Sudah Cair',
            'blockchain_tx' => $txId
        ]);

        return redirect()->route('konfirmasi.index')->with('success', 'Pencairan telah dikonfirmasi dan dicatat di blockchain (simulasi)!');
    }

    /**
     * Simpan data dengan input TX dari Web3.js atau eksternal
     */
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

    /**
     * Menampilkan laporan lengkap
     */
    public function lihatLaporan()
    {
        $laporan = Laporan::with('pencairan.siswa')->orderBy('created_at', 'desc')->get();
        return view('admin.laporan', compact('laporan'));
    }
}
