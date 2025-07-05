@extends('AdminSekolah.layouts.admin')

@section('title', 'Tambah Siswa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_create.css') }}">
@endpush

@section('content')

<div class="content-box">
  <h3 class="box-title">Tambah Siswa</h3>
  <form action="{{ route('siswa.store') }}" method="POST" class="form-siswa">
    @csrf
    <div class="form-grid">
      <div class="form-group">
        <label for="nama">Nama Siswa</label>
        <input type="text" name="nama" id="nama" required>
      </div>
      <div class="form-group">
        <label for="nisn">NISN</label>
        <input type="text" name="nisn" id="nisn" required>
      </div>
      <div class="form-group">
        <label for="asal_sekolah">Asal Sekolah</label>
        <input type="text" name="asal_sekolah" id="asal_sekolah" required>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" required></textarea>
      </div>
      <div class="form-group" style="grid-column: span 2;">
        <label for="kelas">Kelas</label>
        <select name="kelas" id="kelas" required>
          <option value="">Pilih Kelas</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
          <option value="XII">XII</option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn-tambah">Simpan</button>
  </form>
</div>


@endsection
