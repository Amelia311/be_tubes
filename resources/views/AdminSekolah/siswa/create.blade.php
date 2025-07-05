@extends('AdminSekolah.layouts.admin')

@section('title', 'Tambah Siswa')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_tambah_siswa.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
  <div class="form-container animate__animated animate__fadeIn">
      <h3 class="animate__animated animate__fadeInDown">
          <i class="fas fa-user-plus me-2"></i>Tambah Siswa
      </h3>

      {{-- Pesan sukses --}}
      @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle me-2"></i>
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      {{-- Validasi error --}}
      @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-triangle me-2"></i>
              <ul class="mb-0" style="padding-left: 20px;">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      <form action="{{ route('siswa.store') }}" method="POST" class="animate__animated animate__fadeIn">
          @csrf
          <div class="form-row">
            <div class="form-group">
                <label for="nama" class="form-label">
                    <i class="fas fa-user"></i> Nama Siswa
                </label>
                <input type="text" name="nama" id="nama" class="form-control" required value="{{ old('nama') }}">
            </div>
            <div class="form-group">
                <label for="nisn" class="form-label">
                    <i class="fas fa-id-card"></i> NISN
                </label>
                <input type="text" name="nisn" id="nisn" class="form-control" required value="{{ old('nisn') }}">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
                <label for="asal_sekolah" class="form-label">
                    <i class="fas fa-school"></i> Asal Sekolah
                </label>
                <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" required value="{{ old('asal_sekolah') }}">
            </div>
            <div class="form-group">
                <label for="kelas" class="form-label">
                    <i class="fas fa-graduation-cap"></i> Kelas
                </label>
                <select name="kelas" id="kelas" class="form-select" required>
                    <option value="">Pilih Kelas</option>
                    <option value="X" {{ old('kelas') == 'X' ? 'selected' : '' }}>X</option>
                    <option value="XI" {{ old('kelas') == 'XI' ? 'selected' : '' }}>XI</option>
                    <option value="XII" {{ old('kelas') == 'XII' ? 'selected' : '' }}>XII</option>
                </select>
            </div>
          </div>

          <div class="form-group">
              <label for="alamat" class="form-label">
                  <i class="fas fa-map-marker-alt"></i> Alamat
              </label>
              <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
          </div>

          <div class="form-group">
              <label for="password" class="form-label">
                  <i class="fas fa-lock"></i> Password
              </label>
              <input type="password" name="password" id="password" class="form-control" required>
          </div>

<button type="submit" class="btn btn-submit animate__animated animate__pulse animate__infinite animate__slower">
  <i class="fas fa-save"></i> Simpan Data
</button>

      </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    // Animasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            group.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endsection
