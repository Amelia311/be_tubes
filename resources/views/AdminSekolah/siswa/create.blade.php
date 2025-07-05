@extends('AdminSekolah.layouts.admin')

@section('title', 'Tambah Siswa')
 
@section ('content')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_create.css') }}">


   <section class="content-box">
  <div class="form-container">
          
      <h3>Tambah Siswa</h3>
      
      <br>
   {{-- Pesan sukses --}} 
    @if (session('success'))
      <div class="success-message">
        {{ session('success') }}
      </div>
    @endif

    {{-- Validasi error --}}
    @if ($errors->any())
      <div class="error-message">
        <ul style="margin: 0; padding-left: 20px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
 <form action="{{ route('siswa.store') }}" method="POST" class="actions">
    @csrf
        <label for="nama">Nama Siswa</label>
        <input type="text" name="nama" required>
      
   
        <label for="nisn">NISN</label>
        <input type="text" name="nisn" required>
      
   
        <label for="asal_sekolah">Asal Sekolah</label>
        <input type="text" name="asal_sekolah" required>
      
   
        <label for="alamat">Alamat</label>
        <textarea name="alamat" required></textarea>
      
   
        <label for="password">Password</label>
        <input type="password" name="password" required>
      
   
        <label for="kelas">Kelas</label>
        <select name="kelas" required>
          <option value="">Pilih Kelas</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
          <option value="XII">XII</option>
        </select>
      
    <div class="mt-4 d-flex justify-content-between gap-3 flex-wrap">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Simpan
          </button>
        </div>
  </form>

</div></section></div>
@endsection


