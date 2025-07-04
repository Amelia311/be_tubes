@extends('AdminSekolah.layouts.admin')

@section('title', 'Akun Siswa')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_akun_siswa.css') }}">

@section('content')
<div class="page-wrapper">
    <h3>Daftar Akun Siswa</h3>

    <table class="table-akun">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswaList as $index => $siswa)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->password }}</td> {{-- tampilkan dengan hati-hati --}}
                <td>
                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($siswaList->isEmpty())
            <tr>
                <td colspan="6" style="text-align:center;">Belum ada data siswa.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
