@extends('Siswa.layouts.siswa')

@section('title', 'Konfirmasi Pencairan')

@section('content')
<div class="form-container">
  <h3>Form Konfirmasi Pencairan Dana</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ url('/konfirmasi') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nama Siswa</label>
    <input type="text" name="nama" value="{{ $siswa->nama }}" readonly>

    <label>Asal Sekolah</label>
    <input type="text" name="asal_sekolah" value="{{ $siswa->asal_sekolah }}" readonly>

    <label>Tanggal Konfirmasi</label>
    <input type="date" name="tanggal" value="{{ $tanggal }}" readonly>

    <label>Jumlah</label>
    <input type="number" name="jumlah" required>

    <label>Bukti Transfer</label>
    <input type="file" name="bukti" accept="image/*" required>

    <button type="submit">Kirim Konfirmasi</button>
  </form>
</div>
@endsection
