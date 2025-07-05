@extends('AdminSekolah.layouts.admin')

@section('content')
<section class="content-box">
  <h3 style="color: #fcd34d;">Edit Siswa</h3>
  <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="form-siswa">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="nama">Nama Siswa</label>
      <input type="text" id="nama" name="nama" value="{{ $siswa->nama }}" required>
    </div>
    <div class="form-group">
      <label for="nisn">NISN</label>
      <input type="text" id="nisn" name="nisn" value="{{ $siswa->nisn }}" required>
    </div>
    <div class="form-group">
      <label for="asal_sekolah">Asal Sekolah</label>
      <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ $siswa->asal_sekolah }}" required>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea id="alamat" name="alamat" rows="3" required>{{ $siswa->alamat }}</textarea>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" required>
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
    <button type="submit" class="btn-tambah">Update</button>
  </form>
</section>
@endsection
