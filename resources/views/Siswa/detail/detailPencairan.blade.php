@extends('Siswa.layouts.siswa')

@section('title', 'Detail Pencairan - PIPGuard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}">
@endpush

@section('content')
<section id="detail-pencairan" class="content-section active">
  <h2>Detail Pencairan Dana</h2>

  @if($pencairan)
    <table class="data-table">
      <tbody>
        <tr>
          <th>Nominal Dana</th>
          <td>Rp {{ number_format($pencairan->jumlah, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <th>Tanggal Pengajuan</th>
          <td>{{ \Carbon\Carbon::parse($pencairan->created_at)->format('d M Y') }}</td>
        </tr>
        <tr>
          <th>Tanggal Pencairan</th>
          <td>
            {{ $pencairan->tanggal_cair ? \Carbon\Carbon::parse($pencairan->tanggal_cair)->format('d M Y') : '-' }}
          </td>
        </tr>
        <tr>
          <th>Status Pencairan</th>
          <td>{{ $pencairan->status }}</td>
        </tr>
        <tr>
          <th>Metode Transfer</th>
          <td>Bank BRI</td> <!-- Bisa tambahkan kolom `metode_transfer` jika ingin dinamis -->
        </tr>
        <tr>
          <th>Nomor Referensi Transaksi</th>
          <td>{{ $pencairan->blockchain_tx ?? '-' }}</td>
        </tr>
      </tbody>
    </table>
  @else
    <p>Belum ada data pencairan yang tersedia.</p>
  @endif
</section>
@endsection
