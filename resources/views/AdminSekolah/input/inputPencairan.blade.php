@extends('AdminSekolah.layouts.admin')

@section('title', 'Input Pencairan')

@section('content')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_input.css') }}">

<section class="content-box">
  <div class="form-container">
    <h3>Input Pencairan</h3>

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

    <form method="POST" action="{{ route('pencairan.store') }}" class="actions">
      @csrf

      <label for="siswa_id">Pilih Siswa</label>
      <select id="siswa_id" name="siswa_id" required>
        <option value="">-- Pilih Siswa --</option>
        @foreach ($siswa as $item)
          <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
      </select>

      <label for="tanggal_cair">Tanggal Cair</label>
      <input type="date" id="tanggal_cair" name="tanggal_cair" max="{{ date('Y-m-d') }}" min="2000-01-01" required />

      <label for="jumlah">Jumlah yang Diterima</label>
      <input type="text" id="jumlah" name="jumlah" placeholder="Contoh: 500000" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" />

      <label for="keterangan">Periode</label>
      <input type="text" id="keterangan" name="keterangan" placeholder="Contoh: Tahap 1" required />

      <button type="submit">Simpan</button>
    </form>
  </div>
</section>
@endsection
