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

        Pencairan::create($request->all());

        return redirect()->back()->with('success', 'Data pencairan berhasil disimpan!');
    }
    public function konfirmasiView()
{
    $data = Pencairan::with('siswa')->orderBy('created_at', 'desc')->get();
    return view('pencairan.konfirmasi', compact('data'));
}

    public function konfirmasi($id){
    $pencairan = Pencairan::findOrFail($id);

    $txId = 'TX' . strtoupper(uniqid());

    $pencairan->update([
        'status' => 'Sudah Cair',
        'blockchain_tx' => $txId
    ]);

    return redirect()->route('konfirmasi.index')->with('success', 'Pencairan telah dikonfirmasi dan dicatat di blockchain!');
}

}
