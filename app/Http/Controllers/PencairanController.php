<?php

namespace App\Http\Controllers;

use App\Models\Pencairan;
use App\Models\Siswa;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        return redirect()->route('pencairan.create')->with('success', 'Data pencairan berhasil disimpan!'); 
    }

    public function index()
    {
        $laporanList = Laporan::with('pencairan.siswa')->latest()->get();
        return view('AdminSekolah.laporan.laporan_kendala', compact('laporanList'));
    }


    public function dashboard()
    {
        $user = auth()->user();

        $riwayat = \App\Models\Pencairan::where('siswa_id', $user->id)
            ->orderBy('tanggal_cair', 'desc')
            ->get();

        return view('Siswa.dashboardSiswa', compact('riwayat'));
    }


    /**
     * Menampilkan daftar data untuk dikonfirmasi admin
     */
    public function konfirmasiView()
    {
        $data = Pencairan::with('siswa')->orderBy('created_at', 'desc')->get();
        

        return view('AdminSekolah.konfirmasi.konfirmasiBlockchain', compact('data'));

    }

    public function riwayatSekolah(Request $request)
    {
        $query = Pencairan::with('siswa')->orderBy('tanggal_cair', 'desc');
    
        // Filter opsional (bisa diaktifkan nanti)
        if ($request->filled('search')) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }
    
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal_cair', '>=', $request->tanggal_awal);
        }
    
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_cair', '<=', $request->tanggal_akhir);
        }
    
        $data = $query->get();
    
        return view('AdminSekolah.riwayat.riwayatPencairan', compact('data'));
    }
    

    public function formKonfirmasi()
    {
        $nisn = Session::get('nisn');
    
        if (!$nisn) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }
    
        $siswa = \App\Models\Siswa::where('nisn', $nisn)->first();
    
        if (!$siswa) {
            return redirect('/login')->with('error', 'Data siswa tidak ditemukan');
        }
    
        return view('Siswa.konfirmasi.konfirmasiPencairan', [
            'siswa' => $siswa,
            'tanggal' => \Carbon\Carbon::now()->format('Y-m-d'),
        ]);
    }
    

    public function submitKonfirmasi(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'bukti' => 'required|image|max:2048',
        ]);
    
        $nisn = session('nisn');
        $siswa = Siswa::where('nisn', $nisn)->first();
    
        $buktiPath = $request->file('bukti')->store('bukti', 'public');
    
        Pencairan::create([
            'siswa_id' => $siswa->id,
            'jumlah' => $request->jumlah,
            'bukti' => $buktiPath,
            'status' => 'Menunggu',
            'tanggal_cair' => Carbon::now()->format('Y-m-d'),
            'keterangan' => 'Konfirmasi pencairan oleh siswa',
        ]);
    
        return redirect()->back()->with('success', 'Konfirmasi berhasil dikirim.');
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

        return response()->json([
            'message' => 'Data dengan transaksi blockchain berhasil disimpan!',
            'data' => $data
        ]);
    }

    /**
     * Menampilkan laporan lengkap
     */
    public function lihatLaporan()
    {
        $laporan = Laporan::with('pencairan.siswa')->orderBy('created_at', 'desc')->get();
        return view('AdminSekolah.laporan', compact('laporan'));

        return view('admin.laporan', compact('laporan'));

    }

    public function simpanTx(Request $request)
    {
        $request->validate([
            'pencairan_id' => 'required|exists:pencairan,id',
            'blockchain_tx' => 'required|string'
        ]);

        $pencairan = Pencairan::findOrFail($request->pencairan_id);
        $pencairan->update([
            'status' => 'Sudah Cair',
            'blockchain_tx' => $request->blockchain_tx
        ]);

        return response()->json(['message' => 'Berhasil!']);
    }



}
