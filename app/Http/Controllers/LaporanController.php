<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Http;


class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pencairan_id' => 'required|exists:pencairan,id',
            'pesan' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_laporan', 'public');
        }

        Laporan::create([
            'pencairan_id' => $request->pencairan_id,
            'pesan' => $request->pesan,
            'bukti' => $path,
            'status' => 'belum dibaca',
            // simpan tx kalau dikirim dari MetaMask
            'blockchain_tx' => $request->blockchain_tx ?? null,
        ]);

        return back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:belum dibaca,diproses,selesai'
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update(['status' => $request->status]);

        return response()->json(['message' => 'Status laporan berhasil diperbarui']);
    }

}
