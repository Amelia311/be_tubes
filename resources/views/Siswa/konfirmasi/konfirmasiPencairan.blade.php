@extends('Siswa.layouts.siswa')

@section('title', 'Konfirmasi Pencairan')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
@endpush

@section('content')
<div class="container mt-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Form Konfirmasi Pencairan Dana</h4>
    </div>
    <div class="card-body">

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ url('/siswa/konfirmasi') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label class="form-label">Nama Siswa</label>
          <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Asal Sekolah</label>
          <input type="text" name="asal_sekolah" class="form-control" value="{{ $siswa->asal_sekolah }}" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Konfirmasi</label>
          <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Bukti Transfer</label>
          <input type="file" name="bukti" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Kirim Konfirmasi</button>
      </form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
@endsection
