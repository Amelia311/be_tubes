@extends('AdminSekolah.layouts.admin')

@section('title', 'Daftar Siswa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_dashboard.css') }}">
@endpush

@section('content')

      <section class="content-box">
          <div class="header-table">
            <h3 style="color: white;">Daftar Siswa</h3>
          <div class="actions">
           <input type="text" placeholder="Cari siswa...">
           <a href="{{ route('siswa.create') }}" class="btn-tambah">+ Tambah Siswa</a>
        </div>
    </div>

        @if(session('success'))
          <div style="background-color: #22c55e; color: white; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
            {{ session('success') }}
          </div>
        @endif

        <table class="table-siswa">
  <thead>
    <tr>
      <th>NO</th>
      <th>NAMA SISWA</th>
      <th>NISN</th>
      <th>ASAL SEKOLAH</th>
      <th>ALAMAT</th>
      <th>KELAS</th>
      <th>AKSI</th>
    </tr>
  </thead>
  <tbody class="scroll-table-body">
    @forelse ($siswa as $item)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->nisn }}</td>
        <td>{{ $item->asal_sekolah }}</td>
        <td>{{ $item->alamat }}</td>
        <td>{{ $item->kelas ?? '-' }}</td>
        <td>
          <a href="{{ route('siswa.edit', $item->id) }}"><i class="fas fa-pen action-icon"></i></a>
          <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Yakin ingin menghapus siswa ini?')" style="background: none; border: none;">
              <i class="fas fa-trash action-icon"></i>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="7">Data siswa tidak ditemukan.</td>
      </tr>
    @endforelse
  </tbody>
</table>

      </section>
      @endsection