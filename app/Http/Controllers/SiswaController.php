<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();
        if ($request->has('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }
    
        $data = $query->get();
    
        return view('AdminSekolah.siswa.daftarSiswa', ['siswa' => $data]);
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



}
