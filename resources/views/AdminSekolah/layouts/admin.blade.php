<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #3a0ca3;
      --secondary-color: #7209b7;
      --accent-color: #4361ee;
      --light-color: #f8f9fa;
      --dark-color: #212529;
      --sidebar-width: 280px;
    }
    
    body {
      background-color: #f5f7fb;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      background-image: linear-gradient(135deg, rgba(58, 12, 163, 0.03) 0%, rgba(114, 9, 183, 0.03) 100%);
    }
    
    /* Sidebar Styling */
    .sidebar {
      width: var(--sidebar-width);
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      color: white;
      min-height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
      padding: 2rem 1.5rem;
      z-index: 1000;
      transition: all 0.3s ease;
      overflow-y: auto;
    }
    
    .sidebar h2 {
      color: white;
      font-weight: 700;
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid rgba(255, 255, 255, 0.2);
      text-align: center;
      font-size: 1.5rem;
    }
    
    .sidebar nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .sidebar nav li {
      margin-bottom: 0.5rem;
    }
    
    .sidebar nav a {
      display: flex;
      align-items: center;
      color: rgba(255, 255, 255, 0.9);
      text-decoration: none;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    .sidebar nav a:hover, 
    .sidebar nav a.active {
      background-color: rgba(255, 255, 255, 0.15);
      color: white;
      transform: translateX(5px);
    }
    
    .sidebar nav a i {
      margin-right: 12px;
      font-size: 1.1rem;
      width: 24px;
      text-align: center;
    }
    
    .logout-form {
      margin-top: 2rem;
      padding-top: 1.5rem;
      border-top: 2px solid rgba(255, 255, 255, 0.2);
    }
    
    .logout-form button {
      width: 100%;
      background-color: rgba(10, 51, 232, 0.39);
      color: white;
      border: none;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .logout-form button:hover {
      background-color: rgba(255, 255, 255, 0.2);
      transform: translateX(5px);
    }
    
    .logout-form button i {
      margin-right: 10px;
    }
    
    /* Main Content */
    main {
      flex: 1;
      margin-left: var(--sidebar-width);
      padding: 2rem;
      transition: all 0.3s ease;
    }
    
    /* Cards */
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 2rem;
      transition: all 0.3s ease;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
      background-color: white;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      font-weight: 600;
      padding: 1.25rem 1.5rem;
      border-radius: 12px 12px 0 0 !important;
    }
    
    /* Buttons */
    .btn-primary {
      background-color: var(--accent-color);
      border-color: var(--accent-color);
    }
    
    .btn-primary:hover {
      background-color: #3a56e8;
      border-color: #3a56e8;
    }
    
    /* Animations */
    .animate-on-scroll {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .animate-on-scroll.visible {
      opacity: 1;
      transform: translateY(0);
    }
    
    /* Floating background elements */
    .bg-elements {
      position: fixed;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }
    
    .bg-element {
      position: absolute;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(67, 97, 238, 0.1) 0%, rgba(67, 97, 238, 0) 70%);
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
      .sidebar {
        transform: translateX(-100%);
        width: 280px;
      }
      
      .sidebar.active {
        transform: translateX(0);
      }
      
      main {
        margin-left: 0;
      }
      
      .sidebar-toggle {
        display: block !important;
      }
    }
    
    .sidebar-toggle {
      position: fixed;
      top: 20px;
      left: 20px;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 10px;
      z-index: 1100;
      display: none;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
      background: var(--primary-color);
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: var(--secondary-color);
    }
  </style>
  
  @stack('styles')
</head>
<body>
  <!-- Floating background elements -->
  <div class="bg-elements">
    <div class="bg-element" style="width: 200px; height: 200px; top: 10%; left: 10%; animation: float 8s ease-in-out infinite;"></div>
    <div class="bg-element" style="width: 150px; height: 150px; top: 60%; right: 15%; animation: float 10s ease-in-out infinite 2s;"></div>
    <div class="bg-element" style="width: 180px; height: 180px; bottom: 20%; left: 50%; animation: float 9s ease-in-out infinite 1s;"></div>
  </div>

  <!-- Sidebar Toggle Button (mobile) -->
  <button class="sidebar-toggle animate__animated animate__fadeIn" id="sidebarToggle">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Sidebar -->
  <aside class="sidebar animate__animated animate__fadeInLeft">
    <h2><i class="fas fa-shield-alt me-2"></i>PIP Admin</h2>
    <nav>
      <ul>
        <li class="animate__animated animate__fadeInLeft" style="animation-delay: 0.1s;">
          <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Dashboard Admin
          </a>
        </li>
        <li class="animate__animated animate__fadeInLeft" style="animation-delay: 0.1s;">
          <a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.index') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Daftar Siswa
          </a>
        </li>
        <li class="animate__animated animate__fadeInLeft" style="animation-delay: 0.2s;">
          <a href="{{ route('pencairan.create') }}" class="{{ request()->routeIs('pencairan.create') ? 'active' : '' }}">
            <i class="fas fa-money-bill-wave"></i> Input Penarikan Dana
          </a>
        </li>
        <li class="animate__animated animate__fadeInLeft" style="animation-delay: 0.3s;">
          <a href="{{ url('/dashboard/sekolah/konfirmasi') }}" class="{{ request()->is('dashboard/sekolah/konfirmasi') ? 'active' : '' }}">
            <i class="fas fa-check-circle"></i> Konfirmasi
          </a>
        </li>
        <li class="animate__animated animate__fadeInLeft" style="animation-delay: 0.4s;">
          <a href="{{ url('/dashboard/sekolah/riwayat') }}" class="{{ request()->is('dashboard/sekolah/riwayat') ? 'active' : '' }}">
            <i class="fas fa-history"></i> Riwayat Penarikan Dana
          </a>
        </li>
        <li class="animate__animated animate__fadeInLeft" style="animation-delay: 0.5s;">
          <a href="{{ route('transparansi.publik') }}" class="{{ request()->routeIs('transparansi.publik') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i> Transparansi
          </a>
        </li>
      </ul>
    </nav>
    
    <form method="POST" action="{{ route('logout') }}" class="logout-form animate__animated animate__fadeInLeft" style="animation-delay: 0.6s;">
      @csrf
      <button type="submit" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Logout
      </button>
    </form>
  </aside>

  <!-- Main Content -->
  <main class="animate__animated animate__fadeIn">
    @yield('content')
  </main>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  
  <!-- Custom JS -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Sidebar toggle for mobile
      const sidebarToggle = document.getElementById('sidebarToggle');
      const sidebar = document.querySelector('.sidebar');
      
      sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
      });
      
      // Scroll animation
      const animateElements = document.querySelectorAll('.animate-on-scroll');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
          }
        });
      }, {
        threshold: 0.1
      });
      
      animateElements.forEach(el => observer.observe(el));
      
      // Floating animation for background elements
      const style = document.createElement('style');
      style.textContent = `
        @keyframes float {
          0% { transform: translateY(0px) rotate(0deg); }
          50% { transform: translateY(-20px) rotate(5deg); }
          100% { transform: translateY(0px) rotate(0deg); }
        }
      `;
      document.head.appendChild(style);
    });
  </script>
  
  @stack('scripts')
</body>
</html>