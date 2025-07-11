<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Laporan;
use App\Models\Pencairan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();
    
        if ($request->has('search')) {
            $search = $request->search;
    
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('nisn', 'like', "%$search%")
                  ->orWhere('asal_sekolah', 'like', "%$search%");
        }
    
        $siswa = $query->paginate(10); // atau get() kalau tidak ingin pakai pagination
    
        return view('AdminSekolah.siswa.daftarSiswa', compact('siswa'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6'
        ]);
        Siswa::create([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat' => $request->alamat,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password)
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

    public function adminFull(Request $request)
    {
        // Cari
        $query = Siswa::query();
        if ($request->has('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        // Tambah (jika POST)
        if ($request->isMethod('post') && $request->has('nama')) {
            $request->validate([
                'nama' => 'required',
                'nisn' => 'required|unique:siswa',
                'asal_sekolah' => 'required',
                'alamat' => 'required',
            ]);
            Siswa::create($request->only(['nama', 'nisn', 'asal_sekolah', 'alamat']));
            return redirect()->back()->with('success', 'Data siswa ditambahkan!');
        }

        $siswa = $query->get();
        return view('AdminSekolah.siswa.daftarSiswa', compact('siswa'));
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


        $pencairan_riwayat = Pencairan::whereHas('siswa', function ($q) use ($nisn) {
            $q->where('nisn', $nisn);
        })->get();

        return view('Siswa.dashboardSiswa', compact('pencairan_riwayat'));
    }

    public function pencairan()
    {
        return $this->hasMany(Pencairan::class);
    }

    public function detail()
    {
        $nisn = Session::get('nisn'); 
        $pencairan = \App\Models\Pencairan::with('siswa')
            ->whereHas('siswa', function ($q) use ($nisn) {
                $q->where('nisn', $nisn);
            })
            ->latest('tanggal_cair')
            ->first(); 

        return view('Siswa.detail.detailPencairan', compact('pencairan'));
    }

    public function statusDana()
    {
        
        $nisn = session('nisn');
    
        // Ambil data pencairan berdasarkan NISN siswa
        $pencairan = Pencairan::whereHas('siswa', function ($query) use ($nisn) {
            $query->where('nisn', $nisn);
        })->get();
        
        // Kumpulkan data riwayat berdasarkan kelas
        $riwayat = [];
        foreach ($pencairan as $item) {
            $kelas = $item->siswa->kelas ?? 'Tidak Diketahui';
            
            $riwayat[$kelas][] = [
                'periode' => $item->periode ?? 'Periode tidak diketahui',
                'status' => $item->status,
                'nominal' => $item->jumlah,
                'tanggal' => $item->tanggal_cair,
            ];
        }
        
        // Hitung status terakhir (ambil status dari pencairan terakhir)
        $status = $pencairan->last()->status ?? 'Belum Dicairkan';
        
 
        return view('Siswa.status.statusDana', compact('status', 'riwayat'));
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
    
    


}
