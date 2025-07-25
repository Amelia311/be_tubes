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
        $validator = Validator::make($request->all(), [
            'nama_sk' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer',
            'semester' => 'required|in:1,2',
            'file_sk' => 'required|file|mimes:pdf,doc,docx|max:5120' // 5MB
        ]);
        dd($request->semester);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('file_sk');
        $filePath = $file->store('sk_pip_files', 'public');

        $sk = SkPip::create([
            'nama_sk' => $request->nama_sk,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'file_path' => $filePath
        ]);

        return response()->json([
            'message' => 'SK PIP berhasil diupload',
            'data' => $sk
        ]);
    }
}
