@extends('AdminSekolah.layouts.admin')

@section('title', 'Akun Siswa')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_akun_siswa.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@section('content')
<div class="page-wrapper">
    <h3 style="color: #FFD700; margin-bottom: 20px;">Akun Siswa</h3>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <div style="flex-grow: 1;">
            <input type="text" class="form-control" placeholder="Cari nama siswa..." style="padding: 8px 12px; border-radius: 5px; border: none; background-color: #1E293B; color: #fff; width: 250px;">
            <button class="btn-cari" style="background-color: #3B82F6; color: white; border: none; padding: 8px 16px; border-radius: 5px; margin-left: 8px;">🔍 Cari</button>
        </div>
        <a href="{{ route('siswa.create') }}" class="btn-tambah" style="background-color: #2563EB; color: white; padding: 8px 16px; border-radius: 5px; text-decoration: none;">+ Tambah Akun</a>
    </div>

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
