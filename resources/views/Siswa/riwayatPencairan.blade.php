@extends('AdminSekolah.layouts.admin')

@section('title', 'riwayat pencairan')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_riwayat.css') }}">
@endpush

@section('content')
      <section class="content-box">
        <div class="header-table">
          <h3>Riwayat Pencairan</h3>
          <input type="text" placeholder="Search..." class="search-input" />
        </div>

        <table class="table-riwayat">
          <thead>
            <tr>
              <th>NO</th>
              <th>NAMA</th>
              <th>JUMLAH</th>
              <th>STATUS</th>
              <th>BUKTI</th>
              <th>BLOCKCHAIN TX</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Ani Rahmawati</td>
              <td>500.000</td>
              <td><span class="status sudah">Sudah</span></td>
              <td><a href="#" class="link">Lihat</a></td>
              <td><a href="#" class="link">link</a></td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>
  @endsection

