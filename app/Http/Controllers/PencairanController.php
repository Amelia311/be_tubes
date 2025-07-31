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
            'semester' => 'required|string',
        ]);
        Pencairan::create([
            'siswa_id' => $request->siswa_id,
            'tanggal_cair' => $request->tanggal_cair,
            'jumlah' => $request->jumlah,
            'semester' => $request->semester,
            'status' => 'Menunggu',
            'blockchain_tx' => null,
        ]);

        return redirect()->route('pencairan.create')->with('success', 'Data pencairan berhasil disimpan!'); 
    }

    public function dashboard()
    {
        $nisn = session('nisn');
        $siswa = Siswa::where('nisn', $nisn)->first();
    
        if (!$siswa) {
            return redirect('/login')->with('error', 'Data siswa tidak ditemukan.');
        }
    
        $rawData = Pencairan::where('siswa_id', $siswa->id)
            ->orderBy('tanggal_cair', 'desc')
            ->get();
    
        $riwayat = [];
    
        foreach ($rawData as $item) {
            $kelas = $siswa->kelas;
            $riwayat[$kelas][] = [
                'semester' => $item->semester,
                'status' => $item->status,
                'nominal' => number_format($item->jumlah, 0, ',', '.'),
                'tanggal' => \Carbon\Carbon::parse($item->tanggal_cair)->format('d M Y'),
            ];
        }
    
        if ($rawData->isEmpty()) {
            $statusTerakhir = 'Belum Cair';
        } else {
            $latest = $rawData->first();
            
            if ($latest->status === 'Sudah Cair' && $latest->bukti) {
                $statusTerakhir = 'Sudah Tarik Dana';
            } elseif ($latest->status === 'Sudah Cair' && !$latest->bukti) {
                $statusTerakhir = 'Belum Tarik Dana';
            } else {
                $statusTerakhir = 'Belum Tarik Dana';
            }
        }
        
        return view('Siswa.dashboardSiswa', compact('riwayat', 'statusTerakhir'))->with('status', $statusTerakhir);
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
    
        $siswa = Siswa::where('nisn', $nisn)->first();
    
        if (!$siswa) {
            return redirect('/login')->with('error', 'Data siswa tidak ditemukan');
        }

        // Find existing pending withdrawal
        $pencairan = Pencairan::where('siswa_id', $siswa->id)
            ->where('status', 'Menunggu')
            ->latest()
            ->first();

        if (!$pencairan) {
            return redirect()->route('siswa.statusDana')
                ->with('error', 'Tidak ada pencairan yang perlu dikonfirmasi');
        }

        return view('Siswa.konfirmasi.konfirmasiPencairan', [
            'siswa' => $siswa,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'jumlah' => $pencairan->jumlah
        ]);
    }

    /**
     * Process konfirmasi form submission
     */
    public function submitKonfirmasi(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $nisn = Session::get('nisn');
        $siswa = Siswa::where('nisn', $nisn)->first();

        if (!$siswa) {
            return redirect('/login')->with('error', 'Data siswa tidak ditemukan');
        }

        // Find existing pending withdrawal
        $pencairan = Pencairan::where('siswa_id', $siswa->id)
            ->where('status', 'Menunggu')
            ->latest()
            ->first();

        if (!$pencairan) {
            return redirect()->route('Siswa.status.status-dana')
                ->with('error', 'Tidak ada pencairan yang perlu dikonfirmasi');
        }

        // Process the file upload
        $buktiPath = $request->file('bukti')->store('bukti_penarikan', 'public');

        // Update the withdrawal record
        $pencairan->update([
            'tanggal_cair' => $request->tanggal,
            'bukti' => $buktiPath,
            'keterangan' => 'Konfirmasi pencairan oleh siswa',
            // Status remains "Menunggu" for admin verification
        ]);
        
        

        return redirect()->route('siswa.statusDana')
            ->with('success', 'Konfirmasi penarikan berhasil dikirim!');
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

    public function transparansiPublik()
    {
        // Ambil semester terakhir yang sudah cair, berdasarkan tanggal_cair terbaru
        $semesterTerakhir = Pencairan::where('status', 'Sudah Cair')
            ->whereNotNull('semester')
            ->orderBy('tanggal_cair', 'desc')
            ->value('semester');
    
        // Ambil daftar semester unik (semua semester yang ada di data pencairan)
        $semesterList = Pencairan::whereNotNull('semester')
            ->select('semester')
            ->distinct()
            ->orderBy('semester', 'asc')
            ->pluck('semester');
    
        // Total dana yang sudah cair
        $totalDana = Pencairan::where('status', 'Sudah Cair')->sum('jumlah');
    
        // Jumlah penerima yang sudah cair (distinct siswa_id)
        $jumlahPenerima = Pencairan::where('status', 'Sudah Cair')
            ->distinct('siswa_id')
            ->count('siswa_id');
    
        // Ambil 5 pencairan terbaru yang sudah cair beserta data siswa
        $infoTerbaru = Pencairan::with('siswa')
            ->where('status', 'Sudah Cair')
            ->orderBy('tanggal_cair', 'desc')
            ->take(5)
            ->get();
    
        // Ambil 5 laporan terbaru
        $laporan = Laporan::with('pencairan.siswa')
            ->latest()
            ->take(5)
            ->get();
    
        return view('transparansiDana', compact(
            'semesterTerakhir',
            'semesterList',
            'totalDana',
            'jumlahPenerima',
            'infoTerbaru',
            'laporan'
        ));
    }    

    public function index()
    {
        $SemesterList = Pencairan::whereNotNull('semester')
            ->select('semester')
            ->distinct()
            ->orderBy('semester', 'asc')
            ->pluck('semester');
    
        return view('transparansiDana', compact('SemesterList'));
    }
}



