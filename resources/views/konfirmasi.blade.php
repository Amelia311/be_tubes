@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Konfirmasi dan Catat Blockchain</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Asal Sekolah</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->siswa->nama }}</td>
                <td>{{ $item->siswa->asal_sekolah }}</td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>
                    @if($item->status == 'Sudah Cair')
                        <span class="badge bg-success">Sudah Cair</span>
                    @else
                        <span class="badge bg-warning text-dark">Belum Cair</span>
                    @endif
                </td>
                <td>
                    @if($item->status == 'Sudah Cair')
                        <button class="btn btn-secondary" disabled>✓ Terkonfirmasi</button>
                    @else
                        <form method="POST" action="{{ route('konfirmasi.update', $item->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
