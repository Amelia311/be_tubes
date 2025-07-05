<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
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
          <li><a href="{{ route('transparansi.publik') }}"><i class="fas fa-chart-pie"></i>Transparansi</a></li>
        </ul>
      </nav>
      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
      </form>
    </aside>
    <!-- <main class="main-section">
    <header class="topbar">
      <div class="topbar-left">
        <h3>Dashboard</h3>
      </div>
      <div class="topbar-right">
        <div class="user-profile">
          <img src="{{ asset('/storage/img/admin.png') }}" alt="Admin" />
          <span>Admin Sekolah</span>
        </div> 
      </div>
    </header> 
 </main>
</div>  -->
@yield('content')
  @stack('scripts')
</body>
</html>