@extends('AdminSekolah.layouts.admin')

@section('title', 'Tambah Siswa')

@section('content')
  <h3 style="color: #fcd34d;">Tambah Siswa</h3>
  <form action="{{ route('siswa.store') }}" method="POST" class="form-siswa">
    @csrf
    <div class="form-group">
      <label for="nama">Nama Siswa</label>
      <input type="text" name="nama" required>
    </div>
    <div class="form-group">
      <label for="nisn">NISN</label>
      <input type="text" name="nisn" required>
    </div>
    <div class="form-group">
      <label for="asal_sekolah">Asal Sekolah</label>
      <input type="text" name="asal_sekolah" required>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea name="alamat" required></textarea>
    </div>
    <div>
      <label>Kelas:</label>
      <select name="kelas" required>
        <option value="">Pilih Kelas</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
        <option value="XII">XII</option>
      </select>
    </div>
    <button type="submit" class="btn-tambah">Simpan</button>
  </form>
@endsection
