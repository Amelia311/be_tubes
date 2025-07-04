<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  @stack('styles')
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>PIP Admin</h2>
      <nav>
      <ul>
          <li><a href="{{ route('siswa.index') }}"><i class="fas fa-users"></i> Daftar Siswa</a></li>
          <li><a href="{{ route('pencairan.create') }}"><i class="fas fa-money-bill-wave"></i> Input Pencairan</a></li>
          <li><a href="{{ url('/dashboard/sekolah/konfirmasi') }}"><i class="fas fa-check-circle"></i> Konfirmasi</a></li>
          <li><a href="{{ url('/dashboard/sekolah/riwayat') }}"><i class="fas fa-history"></i> Riwayat Pencairan</a></li>
          <li><a href="{{ route('laporan.kendala') }}"><i class="fas fa-exclamation-triangle"></i> Laporan</a></li>
          <li><a href="{{ route('akun.siswa') }}"><i class="fas fa-user-cog"></i> Akun Siswa</a></li>
          <li><a href="{{ route('siswa.transparansi') }}"><i class="fas fa-chart-pie"></i>Transparansi</a></li>
        </ul>
      </nav>
      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
      </form>
    </aside>

    <main class="main-section">
      <header class="topbar">
        <h3>Dashboard</h3>
      </header>

      @yield('content')
    </main>
  </div>
  @stack('scripts')
</body>
</html>