<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard Admin')</title>
  <link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_dashboard.css') }}">
  @stack('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">PIP Admin</div>
      <ul class="nav-list">
        <li><a href="#" class="nav-link" data-url="{{ route('siswa.index') }}"><i class="fas fa-users"></i> Daftar Siswa</a></li>
        <li><a href="#" class="nav-link" data-url="{{ route('pencairan.create') }}"><i class="fas fa-money-bill-wave"></i> Input Pencairan</a></li>
        <li><a href="{{ url('/dashboard/sekolah/konfirmasi') }}"><i class="fas fa-check-circle"></i> Konfirmasi</a></li>
        <li><a href="{{ url('/dashboard/sekolah/riwayat') }}"><i class="fas fa-history"></i> Riwayat Pencairan</a></li>
        <li><a href="#" class="nav-link" data-url="{{ route('laporan.kendala') }}"><i class="fas fa-exclamation-triangle"></i> Laporan</a></li>
        <li><a href="{{ route('akun.siswa') }}"><i class="fas fa-user-cog"></i> Akun Siswa</a></li>
        <li><a href="#" class="nav-link"><i class="fas fa-globe"></i> Transparansi Umum</a></li>
      </ul>
      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
      </form>
    </aside>

    <!-- Main Content -->
    <main class="main-section">
      <header class="topbar">
        <input type="text" placeholder="Cari siswa..." />
        <div class="admin-info">
          <img src="https://i.pravatar.cc/40" alt="Admin" />
          <span>Admin Sekolah</span>
        </div>
      </header>

      <!-- Cards -->
      <div class="info-cards">
        <div class="card"> <h3>210</h3> <p>Daftar Siswa</p> </div>
        <div class="card"> <h3>90</h3> <p>Pencairan</p> </div>
        <div class="card"> <h3>75</h3> <p>Konfirmasi</p> </div>
        <div class="card highlight"> <h3>Rp12jt</h3> <p>Total Dana</p> </div>
      </div>

      <!-- Table -->
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

      <div id="content-box">
        @yield('content')
      </div>
    </main>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.nav-link').click(function (e) {
        e.preventDefault();
        const url = $(this).data('url');
        if (url) $('#content-box').load(url + ' #content-box > *');
      });
    });
  </script>
</body>
</html>
