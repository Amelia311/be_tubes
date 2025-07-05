@extends('Siswa.layouts.siswa')

@section('title', 'Status Dana - PIPGuard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}">
@endpush



@section('content')


<main class="container">
  <section class="status-section">
    <h2>Status Terkini</h2>
    <div class="status-progress">
    <div class="status-step {{ $status === 'Belum Dicairkan' ? 'active' : '' }}" id="step-belum">
      <div class="circle"></div>
      <p>Belum Dicairkan</p>
    </div>
    <div class="status-step {{ $status === 'Menunggu' ? 'active' : '' }}" id="step-proses">
      <div class="circle"></div>
      <p>Dalam Proses</p>
    </div>
    <div class="status-step {{ $status === 'Sudah Cair' ? 'active' : '' }}" id="step-sudah">
      <div class="circle"></div>
      <p>Sudah Cair</p>
    </div>
    </div>
    <div class="periode-section">
      <h3>Periode Pencairan</h3>
      <label for="kelas-dropdown">Pilih Kelas:</label>
      <select id="kelas-dropdown">
        @foreach(array_keys($riwayat) as $kelas)
          <option value="{{ $kelas }}" {{ $loop->first ? 'selected' : '' }}>Kelas {{ $kelas }}</option>
        @endforeach
      </select>
    </div>

    <div class="status-info-table">
      <table class="data-table">
        <thead>
          <tr>
            <th>Periode</th>
            <th>Status</th>
            <th>Nominal</th>
            <th>Tanggal Pencairan</th>
          </tr>
        </thead>
        <tbody id="riwayat-table">
        @php
          $firstKelas = !empty($riwayat) ? array_key_first($riwayat) : null;
        @endphp
        @if($firstKelas && isset($riwayat[$firstKelas]))
          @foreach($riwayat[$firstKelas] as $row)
          <tr>
            <td>{{ $row['periode'] }}</td>
            <td>{{ $row['status'] }}</td>
            <td>{{ $row['nominal'] }}</td>
            <td>{{ $row['tanggal'] }}</td>
          </tr>
          @endforeach
          @else
            <tr>
              <td colspan="4">Belum ada data pencairan.</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>

    <!-- Tombol ke halaman konfirmasi pencairan -->
    <div style="margin-top: 1.5rem;">
      <a href="{{ route('konfirmasi.form') }}" class="btn btn-primary" style="padding:0.7rem 1.2rem; background:#27ae60; color:#fff; border-radius:6px; text-decoration:none;">Konfirmasi Pencairan</a>
    </div>

  </section>
</main>
@endsection

@push('scripts')
<script>
  const riwayatData = {!! json_encode($riwayat ?? []) !!};

  const kelasDropdown = document.getElementById('kelas-dropdown');
  const riwayatTable = document.getElementById('riwayat-table');

  function updateRiwayat(kelas) {
    const data = riwayatData[kelas];
    riwayatTable.innerHTML = data.map(row => `
      <tr>
        <td>${row.periode}</td>
        <td>${row.status}</td>
        <td>${row.nominal}</td>
        <td>${row.tanggal}</td>
      </tr>
    `).join('');
  }

  kelasDropdown.addEventListener('change', () => {
    updateRiwayat(kelasDropdown.value);z
  });

  updateRiwayat(kelasDropdown.value);
</script>
@endpush
