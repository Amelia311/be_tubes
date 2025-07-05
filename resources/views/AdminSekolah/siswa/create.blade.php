@extends('AdminSekolah.layouts.admin')

@section('title', 'Form Siswa')

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  @endpush

@section('content')
<section class="content-box">
  <div class="form-container">
      <h5 class="mb-0">{{ isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa' }}</h5>
    <div class="card-body">
      <form method="POST" action="{{ isset($siswa) ? route('siswa.update', $siswa->id) : route('siswa.store') }}">
        @csrf
        @if(isset($siswa))
          @method('PUT')
        @endif
           <a href="{{ route('siswa.index') }}"
            style="position: absolute; top: 45px; right: 170px; background: transparent; color: #163450FF; font-size: 1.3rem; text-decoration: none; padding: 6px; border-radius: 6px;"
            title="Kembali ke daftar siswa"
            onmouseover="this.style.color='#410F0FFF'"
            onmouseout="this.style.color='#151F2AFF'">
            <i class="fas fa-times"></i>
          </a>
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $siswa->nama ?? '') }}" required>
          
          
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" class="form-control" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn ?? '') }}" required>
         
           <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
           <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah ?? '') }}" required>
          
           <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $siswa->alamat ?? '') }}">
       
            <label for="kelas" class="form-label">Kelas</label>
            <select class="form-select" id="kelas" name="kelas" required>
              <option value="" disabled selected>-- Pilih Kelas --</option>
              <option value="X" {{ old('kelas', $siswa->kelas ?? '') == 'X' ? 'selected' : '' }}>X</option>
              <option value="XI" {{ old('kelas', $siswa->kelas ?? '') == 'XI' ? 'selected' : '' }}>XI</option>
              <option value="XII" {{ old('kelas', $siswa->kelas ?? '') == 'XII' ? 'selected' : '' }}>XII</option>
            </select>
          

       <div class="mt-4 d-flex justify-content-between gap-3 flex-wrap">
         
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
