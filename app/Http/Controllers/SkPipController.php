<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkPip;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SkPipController extends Controller
{
    public function index()
    {
        $skPip = SkPip::latest()->get();

        return response()->json([
            'sk_pip' => $skPip
        ]);
    }

    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama_sk' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer',
            'semester' => 'required|in:1,2',
            'file_sk' => 'required|file|mimes:pdf,doc,docx|max:5120'
        ]);
    
        // Cek apakah file ada
        if (!$request->hasFile('file_sk')) {
            return redirect()->back()->with('error', 'File SK harus diupload!');
        }
    
        try {
            $file = $request->file('file_sk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('sk_files', $filename, 'public');
    
            // Simpan data
            SkPip::create([
                'nama_sk' => $validated['nama_sk'],
                'tahun' => $validated['tahun'],
                'semester' => $validated['semester'],
                'file_path' => $filePath
            ]);
    
            return redirect()->back()->with('success', 'SK berhasil diupload');
    
        } catch (\Exception $e) {
            // // Log error agar bisa dilihat di storage/logs/laravel.log
            // \Log::error('Upload SK Error: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Terjadi kesalahan saat upload SK.');
        }
    }
    
    
}
