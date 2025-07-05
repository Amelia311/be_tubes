@extends('AdminSekolah.layouts.admin')

@section('title', 'Form Siswa')

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container py-4">
  <div class="card shadow-sm rounded">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">{{ isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa' }}</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ isset($siswa) ? route('siswa.update', $siswa->id) : route('siswa.store') }}">
        @csrf
        @if(isset($siswa))
          @method('PUT')
        @endif

        <div class="row g-3">
          <div class="col-md-6">
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $siswa->nama ?? '') }}" required>
          </div>

          <div class="col-md-6">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" class="form-control" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn ?? '') }}" required>
          </div>

          <div class="col-md-6">
            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah ?? '') }}" required>
          </div>

          <div class="col-md-6">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $siswa->alamat ?? '') }}">
          </div>

          <div class="col-md-4">
            <label for="kelas" class="form-label">Kelas</label>
            <select class="form-select" id="kelas" name="kelas" required>
              <option value="" disabled selected>-- Pilih Kelas --</option>
              <option value="X" {{ old('kelas', $siswa->kelas ?? '') == 'X' ? 'selected' : '' }}>X</option>
              <option value="XI" {{ old('kelas', $siswa->kelas ?? '') == 'XI' ? 'selected' : '' }}>XI</option>
              <option value="XII" {{ old('kelas', $siswa->kelas ?? '') == 'XII' ? 'selected' : '' }}>XII</option>
            </select>
          </div>
        </div>

        <div class="mt-4 d-flex justify-content-between">
          <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
          </a>
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
