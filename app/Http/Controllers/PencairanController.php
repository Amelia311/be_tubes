<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PencairanController extends Controller
{
    public function showForm()
    {
        return view('Siswa.konfirmasi.konfirmasiPencairan');

    }

    public function submitForm(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            // 'status' otomatis "Sudah Cair", jadi gak perlu validasi input user
        ]);

        // Simpan data ke database, atau proses sesuai kebutuhan
        // Contoh, jika ada model Pencairan:
        /*
        \App\Models\Pencairan::create([
            'nama_siswa' => $request->nama_siswa,
            'asal_sekolah' => $request->asal_sekolah,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'status' => 'Sudah Cair',
        ]);
        */

        // Kalau belum ada model, bisa tambahkan logic sesuai aplikasi kamu

        return redirect()->route('pencairan.konfirmasi')->with('success', 'Konfirmasi pencairan berhasil!');
    }
}
