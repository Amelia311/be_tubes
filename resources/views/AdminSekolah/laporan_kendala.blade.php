@extends('AdminSekolah.layouts.admin')

@section('title', 'Laporan Kendala PIP')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_laporan.css') }}">

@section('content')
<div class="page-wrapper">
    <h3 style="color: #FFD700; margin-bottom: 20px;">Laporan Kendala PIP</h3>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <div style="flex-grow: 1;">
            <input type="text" class="form-control" placeholder="Cari nama siswa..." style="padding: 8px 12px; border-radius: 5px; border: none; background-color: #1E293B; color: #fff; width: 250px;">
            <button class="btn-cari" style="background-color: #3B82F6; color: white; border: none; padding: 8px 16px; border-radius: 5px; margin-left: 8px;">🔍 Cari</button>
        </div>
    </div>

    <table class="table-laporan">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA SISWA</th>
                <th>NIS</th>
                <th>KELAS</th>
                <th>ASAL SEKOLAH</th>
                <th>DESKRIPSI KENDALA</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanList as $index => $laporan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $laporan->nama }}</td>
                <td>{{ $laporan->nis }}</td>
                <td>{{ $laporan->kelas }}</td>
                <td>{{ $laporan->asal_sekolah }}</td>
                <td>{{ $laporan->deskripsi_kendala }}</td>
                <td>
                    @if ($laporan->status == 'selesai')
                        <span style="color: #22c55e;">Selesai</span>
                    @else
                        <span style="color: #facc15;">Proses</span>
                    @endif
                </td>
            </tr>
            @endforeach

            @if($laporanList->isEmpty())
            <tr>
                <td colspan="7" style="text-align:center; color: #ccc;">Tidak ada laporan kendala.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
