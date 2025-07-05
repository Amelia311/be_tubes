@extends('AdminSekolah.layouts.admin')

@section('title', 'Akun Siswa')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_akun_siswa.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@section('content')
<div class="page-wrapper">
    <h3>Daftar Akun Siswa</h3>

    <div class="table-container">
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
                    <td>
                        <div class="user-cell">
                            <div class="user-initial">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</div>
                            <div>
                                <div class="user-name">{{ $siswa->nama }}</div>
                                <div class="user-nisn">{{ $siswa->nisn }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->password }}</td>
                    <td class="aksi-cell">
                        <div class="action-buttons">
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="icon-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach

                @if($siswaList->isEmpty())
                <tr>
                    <td colspan="5" style="text-align:center;">Belum ada data siswa.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
