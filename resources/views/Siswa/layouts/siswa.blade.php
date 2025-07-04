<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Siswa - PIPGuard')</title>
  <link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}">
  @stack('styles')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body>
  <header>
    <div class="logo-header">
      <img src="{{ asset('storage/logo.png') }}" alt="Logo PIPGuard" />
      <h1>PIPGuard</h1>
    </div>
    <nav class="menu-nav">
      <a href="{{ route('siswa.dashboard') }}" class="{{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
        <i class="fas fa-home"></i>Dashboard
      </a>
      <a href="{{ route('siswa.statusDana') }}"><i class="fas fa-wallet"></i>Status Dana</a>
      <a href="{{ route('siswa.detail') }}"><i class="fas fa-info-circle"></i>Detail</a>
      <a href="{{ route('siswa.laporan') }}"><i class="fas fa-exclamation-triangle"></i>Laporan</a>
      <a href="{{ route('siswa.transparansi') }}"><i class="fas fa-chart-pie"></i>Transparansi</a>
      <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
      </form>
    </nav>



  </header>

  <main>
    @yield('content')
  </main>

  <footer class="footer-info">
    <p>&copy; 2025 PIPGuard. Semua hak dilindungi.</p>
  </footer>

  @stack('scripts')
</body>
</html>
