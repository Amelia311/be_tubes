@extends('Siswa.layouts.siswa')

@section('title', 'Konfirmasi Pencairan - PIPGuard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}">
@endpush

@section('content')
<main class="container">
  <section class="form-container">

    <h2>Konfirmasi Pencairan Dana</h2>

    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pencairan.konfirmasi.submit') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="nama_siswa">Nama Siswa</label>
        <input type="text" id="nama_siswa" name="nama_siswa" required>
      </div>

      <div class="form-group">
        <label for="asal_sekolah">Asal Sekolah</label>
        <input type="text" id="asal_sekolah" name="asal_sekolah" required>
      </div>

      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" required>
      </div>

      <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <input type="number" id="jumlah" name="jumlah" required min="0" step="any">
      </div>

      <div class="form-group">
        <label for="status">Status</label>
        <input type="text" id="status" name="status" value="Sudah Cair" readonly>
      </div>

      <button type="submit" class="btn-confirm">Konfirmasi</button>
    </form>
  </section>
</main>
@endsection
