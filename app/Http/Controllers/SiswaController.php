<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Laporan;
use App\Models\Pencairan;
use App\Models\SkPip;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new SiswaImport, $request->file('excel_file'));
        
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diimpor dari Excel.');
    }

    public function index(Request $request)
    {
        $query = Siswa::query();
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('nisn', 'like', "%$search%")
                  ->orWhere('no_rekening', 'like', "%$search%")
                  ->orWhere('bank', 'like', "%$search%")
                  ->orWhere('kelas', 'like', "%$search%");
        }
    
        $siswa = $query->paginate(10);
    
        return view('AdminSekolah.siswa.daftarSiswa', compact('siswa'));
    }
    
    
    public function store(Request $request)
    {
        Siswa::create([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'no_rekening' => $request->no_rekening,
            'bank' => $request->bank,
            'kelas' => $request->kelas,
        ]);
        
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function akunSiswa()

    {

        $siswaList = Siswa::all();

        return view('AdminSekolah.akun.akun_siswa', compact('siswaList'));

    }


    public function show($id)
    {
        return response()->json(Siswa::findOrFail($id));

    }

    public function create()
    {
        return view('AdminSekolah.siswa.create'); // sesuaikan dengan nama file view form kamu
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('AdminSekolah.siswa.edit', compact('siswa'));
        
    }



    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');

    }

    public function destroy($id)
    {
        Siswa::destroy($id);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }

    public function riwayatSaya()
    {
        $nisn = auth()->user()->nisn;

        $riwayat = \App\Models\Pencairan::whereHas('siswa', function($q) use ($nisn) {
            $q->where('nisn', $nisn);
        })->orderBy('tanggal_cair', 'desc')->get();

        return view('Siswa.riwayat.riwayatPencairanSiswa', compact('riwayat'));
    }


    public function konfirmasiPencairan(Request $request, $id)
    {
        $pencairan = \App\Models\Pencairan::findOrFail($id);

        // Pastikan hanya siswa yang bersangkutan yang bisa konfirmasi
        if ($pencairan->siswa_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status_konfirmasi' => 'required|in:diterima,tidak_sesuai'
        ]);

        $pencairan->update([
            'status_konfirmasi' => $request->status_konfirmasi
        ]);

        return redirect()->back()->with('success', 'Konfirmasi pencairan berhasil dikirim.');
    }

    public function lapor($id)
    {
        \App\Models\Laporan::create([
            'pencairan_id' => $id,
            'pesan' => 'Dana tidak sesuai atau belum diterima.',
            'status' => 'belum dibaca',
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Laporan telah dikirim ke admin/pemerintah!');
    }

    public function laporStore(Request $request)
    {
        $request->validate([
            'pencairan_id' => 'required|exists:pencairan,id',
            'pesan' => 'required|string',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);
        
        // Simpan file ke folder storage/app/public/bukti_laporan
        $buktiPath = $request->file('bukti')->store('bukti_laporan', 'public');

        \App\Models\Laporan::create([
            'pencairan_id' => $request->pencairan_id,
            'pesan' => $request->pesan,
            'status' => 'belum dibaca',
            'bukti' => $buktiPath
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function dashboard()
    {
        // $nisn = auth()->user()->nisn;
        $nisn = Session::get('nisn');
        $sk_riwayat = SkPip::latest()->take(3)->get(); // ambil 3 SK terbaru

        $pencairan_riwayat = Pencairan::whereHas('siswa', function ($q) use ($nisn) {
            $q->where('nisn', $nisn);
        })->get();

        return view('Siswa.dashboardSiswa', compact('pencairan_riwayat', 'sk_riwayat'));
    }

    public function pencairan()
    {
        return $this->hasMany(Pencairan::class);
    }

    public function statusDana()
    {
        $nisn = session('nisn');
        $siswa = Siswa::where('nisn', $nisn)->first();
        if (!$siswa) {
            abort(403, 'Akses ditolak. Tidak ada data siswa.');
        }
    
        // Ambil data pencairan terbaru milik siswa
        $latestStatus = $siswa->pencairan()->latest('tanggal_cair')->first();
    
        // Mapping status
        if (!$latestStatus) {
            $status = 'Belum Cair';
        } elseif (in_array($latestStatus->status, ['Menunggu', 'Sudah Cair']) && !$latestStatus->bukti) {
            $status = 'Belum Tarik Dana';
        } elseif ($latestStatus->status === 'Sudah Cair' && $latestStatus->bukti) {
            $status = 'Sudah Tarik Dana';
        } else {
            $status = 'Belum Cair';
        }
    
        // Ambil riwayat pencairan
        $pencairan = $siswa->pencairan()->orderBy('tanggal_cair', 'desc')->get();
        $riwayat = [];
        foreach ($pencairan as $item) {
            $semesterText = 'Semester ' . $item->semester;
            // $riwayat[] = [
            //     'periode' => $semesterText . ' ' . $item->tahun,
            //     'status'  => $item->status,
            //     'nominal' => 'Rp' . number_format($item->jumlah, 0, ',', '.'),
            //     'tanggal' => \Carbon\Carbon::parse($item->tanggal_cair)->format('d M Y'),
            //     'kelas'   => $siswa->kelas,
            //     'nama'    => $siswa->nama,
            //     'bank'    => $siswa->bank,
            //     'no_rek'  => $siswa->no_rekening,
            // ];

            $riwayat[$siswa->kelas][] = [
                'periode' => $semesterText . ' ' . $item->tahun,
                'status' => $item->status,
                'nominal' => 'Rp' . number_format($item->jumlah, 0, ',', '.'),
                'tanggal' => \Carbon\Carbon::parse($item->tanggal_cair)->format('d M Y'),
                'nama' => $siswa->nama,
                'kelas' => $siswa->kelas,
                'no_rek' => $siswa->no_rekening
            ];
            
        }
    
        return view('Siswa.status.statusDana', compact('status', 'riwayat', 'siswa'));
    }
    

    public function detailPenarikan()
    {
        // Mock data - replace with your actual data logic
        $pencairan = (object)[
            'jumlah' => 1000000,
            'created_at' => '2025-07-11',
            'status' => 'Sedang Diproses',
            'blockchain_tx' => 'TX1234567890'
        ];

        return view('siswa.detail.detail-penarikan', compact('pencairan'));
    }
    
    public function laporan()
    {
        $nisn = session('nisn');

        $pencairanTerbaru = \App\Models\Pencairan::whereHas('siswa', function ($query) use ($nisn) {
            $query->where('nisn', $nisn);
        })->latest()->first();

        return view('Siswa.laporan.laporanKetidaksesuaian', [
            'pencairan_id' => $pencairanTerbaru ? $pencairanTerbaru->id : null,
        ]);
    }

    public function transparansi()
    {
        $totalDana = Pencairan::where('status', 'Sudah Cair')->sum('jumlah');
        $jumlahPenerima = Pencairan::where('status', 'Sudah Cair')->distinct('siswa_id')->count('siswa_id');
        $periodeTerbaru = Pencairan::orderBy('tanggal_cair', 'desc')->value('periode');
    
        $infoTerbaru = Pencairan::with('siswa')
            ->orderBy('tanggal_cair', 'desc')
            ->take(3)
            ->get();
    
        $laporan = Laporan::with('pencairan.siswa')->latest()->take(3)->get();
    
        // Jika login sebagai admin
        if (auth()->check() && auth()->user()->role === 'sekolah') {
            return view('AdminSekolah.transparansiDana', compact(
                'totalDana',
                'jumlahPenerima',
                'periodeTerbaru',
                'infoTerbaru',
                'laporan'
            ));
        }
    
        // Default siswa
        return view('Siswa.transparansiDana', compact(
            'totalDana',
            'jumlahPenerima',
            'periodeTerbaru',
            'infoTerbaru',
            'laporan'
        ));
    }
    public function RiwayatPenarikan()
{
    $status = 'Belum Cair'; // Ganti dengan status dari database
    $riwayat = [
        'X' => [
            [
                'periode' => 'Semester 1',
                'status' => 'Sudah Dicairkan',
                'nominal' => 'Rp 1.000.000,-',
                'tanggal' => '10 Februari 2025',
                'nama_rekening' => 'Bank BNI',
                'nomor_rekening' => '1234567890'
            ],
            [
                'periode' => 'Semester 2',
                'status' => 'Sudah Dicairkan',
                'nominal' => 'Rp 1.000.000,-',
                'tanggal' => '27 September 2025',
                'nama_rekening' => 'Bank BNI',
                'nomor_rekening' => '1234567890'
            ]
        ],
        'XI' => [],
        'XII' => []
    ];

    return view('Siswa.status.statusDana', compact('status', 'riwayat'));
}
}
