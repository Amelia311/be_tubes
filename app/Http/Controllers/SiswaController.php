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
    
        return view('AdminSekolah.daftarSiswa', ['siswa' => $data]);
    }

    
    public function store(Request $request) 
    {
        $validated = $request->validate(([
            'nama' => 'required',
            'nisn' => 'required|unique:siswa',
            'asal_sekolah' => 'required',
            'alamat' => 'required',
        ]));

        $siswa = Siswa::create($validated);
        return response()->json($siswa, 201);
    }

    public function show($id)
    {
        return response()->json(Siswa::findOrFail($id));

    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());
        return response()->json($siswa);
    }

    public function destroy($id)
    {
        Siswa::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
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
        return view('AdminSekolah.daftarSiswa', compact('siswa'));
    }



}
