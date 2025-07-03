<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Laporan;
use App\Models\Pencairan;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();
        if ($request->has('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }
        
        $siswa = $query->get();

        return view('AdminSekolah.siswa.daftarSiswa', compact('siswa'));
    }

    public function create()
    {
        return view('AdminSekolah.siswa.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nisn' => 'required|unique:siswa',
            'asal_sekolah' => 'required',
            'alamat' => 'required',
        ]);
    
        Siswa::create($validated);
    
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }
    
    public function show($id)
    {
        return response()->json(Siswa::findOrFail($id));

    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('AdminSekolah.siswa.edit', compact('siswa'));
    }


    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'nisn' => 'required|unique:siswa,nisn,' . $id,
            'asal_sekolah' => 'required',
            'alamat' => 'required',
        ]);

        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }


    public function destroy($id)
    {
        Siswa::destroy($id);
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
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

    return view('(Siswa).riwayatPencairanSiswa', compact('riwayat'));
}

    public function lapor($id)
{
    \App\Models\Laporan::create([
        'pencairan_id' => $id,
        'pesan' => 'Dana tidak sesuai atau belum diterima.',
        'status' => 'belum dibaca',
    ]);

    return back()->with('success', 'Laporan telah dikirim ke admin/pemerintah!');
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
    $nisn = auth()->user()->nisn;
    $pencairan_riwayat = Pencairan::whereHas('siswa', function($q) use ($nisn) {
        $q->where('nisn', $nisn);
    })->get();

    return view('siswa.dashboard', compact('pencairan_riwayat'));
}


}
