@extends('Siswa.layouts.siswa')

@section('title', 'Laporan Ketidaksesuaian - PIPGuard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}">
@endpush

@section('content')
<main class="container">
  <section id="laporan-ketidaksesuaian" class="content-section active">
    <h2>Laporkan Ketidaksesuaian Dana</h2>

    @if(session('success'))
      <div style="background-color: #22c55e; color: white; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div style="background-color: #ef4444; color: white; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
        <ul style="margin: 0; padding: 0 1rem;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('siswa.laporStore') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <label for="pesan" style="display:block; font-weight:bold;">Tuliskan Laporan</label>
      <textarea id="pesan" name="pesan" placeholder="Tuliskan perbedaan dana yang Anda terima..." required style="width: 100%; min-height: 120px;"></textarea>

      <label for="bukti" style="display:block; margin-top: 1rem; font-weight:bold;">Upload Bukti</label>
      <input type="file" id="bukti" name="bukti" accept="image/*,application/pdf" />

      <input type="hidden" name="pencairan_id" value="{{ $pencairan_id }}"> {{-- pastikan variabel ini dikirim dari controller --}}

      <button type="submit" style="margin-top: 1rem; display: block;" class="btn-tambah">Kirim Laporan</button>
    </form>
  </section>
</main>
@endsection
