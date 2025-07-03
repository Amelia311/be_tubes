<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard Admin')</title>
  <link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_dashboard.css') }}">
  @stack('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>Dashboard</h2>
      <nav>
        <ul>
          <li><a href="#" class="nav-link" data-url="{{ route('siswa.index') }}"><i class="fas fa-users"></i> Daftar Siswa</a></li>
          <li><a href="#" class="nav-link" data-url="{{ route('pencairan.create') }}"><i class="fas fa-money-bill-wave"></i> Input Pencairan</a></li>
          <li><a href="{{ url('/dashboard/sekolah/konfirmasi') }}"><i class="fas fa-check-circle"></i> Konfirmasi & Catat Blockchain</a></li>
          <li><a href="{{ url('/dashboard/sekolah/riwayat') }}"><i class="fas fa-history"></i> Riwayat Pencairan</a></li>
          <li><a href="#" class="nav-link"><i class="fas fa-globe"></i> Transparansi Umum</a></li>
        </ul>
      </nav>
      <div class="logout">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="background: none; border: none; color: red; cursor: pointer;">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </div>


    </aside>

    <main class="main-content">
      <header class="topbar">
        <h3>Admin Sekolah</h3>
      </header>
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
        $('#content-box').load(url + ' #content-box > *');
      });
    }); 
    
  </script>
</body>
</html>
