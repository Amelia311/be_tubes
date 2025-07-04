@extends('AdminSekolah.layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<section class="table-section">
  <div class="table-header">
    <h4>Riwayat Terbaru</h4>
    <a href="#">Lihat Semua</a>
  </div>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIS</th>
        <th>Sekolah</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td><td>Siti Nur Aisah</td><td>10523000</td><td>Alhamidiyah</td><td><span class="status selesai">Selesai</span></td>
      </tr>
      <tr>
        <td>2</td><td>Mutiara Sani</td><td>10523001</td><td>Miftahul Hidayah</td><td><span class="status proses">Proses</span></td>
      </tr>
    </tbody>
  </table>
</section>
@endsection
