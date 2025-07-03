@extends('AdminSekolah.layouts.admin')

@section('title', 'konfirmasi pencairan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_konfirmasi.css') }}">
@endpush

  @section('content')
      <section class="content-box">
        <h3>Konfirmasi dan Catat Blockchain</h3>
        <table class="table-konfirmasi">
          <thead>
            <tr>
              <th>NAMA SISWA</th>
              <th>ASAL SEKOLAH</th>
              <th>TANGGAL</th>
              <th>JUMLAH</th>
              <th>STATUS</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Ani Rahmawati</td>
              <td>SMP Negeri 1</td>
              <td>2024-07-01</td>
              <td>500.000</td>
              <td><span class="status belum">Belum Cair</span></td>
              <td><button class="btn-konfirmasi">Konfirmasi</button></td>
            </tr>
            <tr>
              <td>Budi Santoso</td>
              <td>SMP Negeri 2</td>
              <td>2024-06-20</td>
              <td>600.000</td>
              <td><span class="status sudah">Sudah Cair</span></td>
              <td><button class="btn-terkonfirmasi"><i class="fas fa-check"></i> Terkonfirmasi</button></td>
            </tr>
          </tbody>
        </table>
      </section>
  @endsection
