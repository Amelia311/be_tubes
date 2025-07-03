@extends('AdminSekolah.layouts.admin')

@section('title', 'Daftar Siswa')

<!-- @push('styles')
@endpush -->

@section('content')

<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_daftar_siswa.css') }}">
      <section class="content-box">
        <div class="header-table">
          <h3>Daftar Siswa</h3>
          <div class="actions">
            <form method="GET" action="{{ route('siswa.index') }}" class="actions">
              <input type="text" name="cari" placeholder="Cari nama siswa..." value="{{ request('cari') }}">
              <button type="submit" class="btn-tambah"><i class="fas fa-search"></i> Cari</button>
            </form>
            <a href="{{ route('siswa.create') }}" class="btn-tambah"><i class="fas fa-plus"></i> Tambah Siswa</a>
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
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
          @forelse ($siswa as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->nisn }}</td>
              <td>{{ $item->asal_sekolah }}</td>
              <td>{{ $item->alamat }}</td>
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
            @if(request('cari'))
              <tr>
                <td colspan="6">Tidak ditemukan siswa dengan kata kunci tersebut.</td>
              </tr>
            @else
              <tr>
                <td colspan="6">Belum ada data siswa.</td>
              </tr>
            @endif
          @endforelse
        </tbody>
        </table>
      </section>
      @endsection
