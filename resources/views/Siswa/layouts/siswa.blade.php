<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Siswa - PIPGuard')</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #4cc9f0;
      --light-color: #f8f9fa;
      --dark-color: #212529;
      --success-color: #4ad66d;
      --warning-color: #f8961e;
      --danger-color: #ef233c;
    }
    
    body {
      background-color: #f0f4f8;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background-image: linear-gradient(135deg, rgba(67, 97, 238, 0.05) 0%, rgba(76, 201, 240, 0.05) 100%);
    }
    
    /* Navbar Styling */
    .navbar-custom {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 0.8rem 1rem;
    }
    
    .navbar-brand {
      display: flex;
      align-items: center;
      color: white !important;
      font-weight: 700;
      font-size: 1.5rem;
      transition: all 0.3s ease;
    }
    
    .navbar-brand:hover {
      transform: translateY(-2px);
    }
    
    .navbar-brand img {
      height: 40px;
      margin-right: 10px;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }
    
    .nav-link {
      color: rgba(255, 255, 255, 0.85) !important;
      font-weight: 500;
      margin: 0 5px;
      padding: 8px 15px !important;
      border-radius: 8px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
    }
    
    .nav-link i {
      margin-right: 8px;
      font-size: 1.1rem;
    }
    
    .nav-link:hover, .nav-link.active {
      color: white !important;
      background-color: rgba(255, 255, 255, 0.15);
      transform: translateY(-2px);
    }
    
    .nav-link.active {
      font-weight: 600;
      background-color: rgba(255, 255, 255, 0.25);
    }
    
    .logout-btn {
      background-color: var(--danger-color);
      color: white;
      border: none;
      padding: 8px 20px;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
    }
    
    .logout-btn:hover {
      background-color: #d90429;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(239, 35, 60, 0.3);
    }
    
    .logout-btn i {
      margin-right: 8px;
    }
    
    /* Main Content */
    main {
      flex: 1;
      padding: 2rem 0;
    }
    
    .content-card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
      padding: 2rem;
      margin-bottom: 2rem;
      border: none;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .content-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }
    
    /* Footer */
    .footer-custom {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      color: white;
      padding: 1.5rem 0;
      text-align: center;
      margin-top: auto;
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
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
      .navbar-collapse {
        padding: 1rem 0;
      }
      
      .nav-link {
        margin: 5px 0;
      }
      
      .logout-btn {
        margin-top: 10px;
        width: 100%;
        justify-content: center;
      }
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
  <!-- Animated Background Elements -->
  <div class="position-fixed w-100 h-100" style="pointer-events: none; z-index: -1;">
    <div class="position-absolute top-20 start-10" style="width: 200px; height: 200px; background: radial-gradient(circle, rgba(67, 97, 238, 0.1) 0%, rgba(67, 97, 238, 0) 70%); animation: float 6s ease-in-out infinite;"></div>
    <div class="position-absolute top-60 end-10" style="width: 150px; height: 150px; background: radial-gradient(circle, rgba(76, 201, 240, 0.1) 0%, rgba(76, 201, 240, 0) 70%); animation: float 8s ease-in-out infinite 2s;"></div>
    <div class="position-absolute bottom-20 start-50" style="width: 180px; height: 180px; background: radial-gradient(circle, rgba(244, 162, 97, 0.1) 0%, rgba(244, 162, 97, 0) 70%); animation: float 7s ease-in-out infinite 1s;"></div>
  </div>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">
      <a class="navbar-brand animate__animated animate__fadeInLeft" href="{{ route('siswa.dashboard') }}">
        <img src="{{ asset('storage/img/logo.png') }}" alt="Logo PIPGuard" />
        PIPGuard
      </a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item animate__animated animate__fadeInDown" style="animation-delay: 0.1s;">
            <a class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}" href="{{ route('siswa.dashboard') }}">
              <i class="fas fa-home"></i> Dashboard
            </a>
          </li>
          <li class="nav-item animate__animated animate__fadeInDown" style="animation-delay: 0.2s;">
            <a class="nav-link {{ request()->routeIs('siswa.statusDana') ? 'active' : '' }}" href="{{ route('siswa.statusDana') }}">
              <i class="fas fa-wallet"></i> Status Dana
            </a>
          </li>
          <li class="nav-item animate__animated animate__fadeInDown" style="animation-delay: 0.3s;">
            <a class="nav-link {{ request()->routeIs('siswa.detail') ? 'active' : '' }}" href="{{ route('siswa.detail') }}">
              <i class="fas fa-info-circle"></i> Detail
            </a>
          </li>
          <li class="nav-item animate__animated animate__fadeInDown" style="animation-delay: 0.4s;">
            <a class="nav-link {{ request()->routeIs('siswa.laporan') ? 'active' : '' }}" href="{{ route('siswa.laporan') }}">
              <i class="fas fa-exclamation-triangle"></i> Laporan
            </a>
          </li>
          <li class="nav-item animate__animated animate__fadeInDown" style="animation-delay: 0.5s;">
            <a class="nav-link {{ request()->routeIs('transparansi.publik') ? 'active' : '' }}" href="{{ route('transparansi.publik') }}">
              <i class="fas fa-chart-pie"></i> Transparansi
            </a>
          </li>
          <li class="nav-item animate__animated animate__fadeInDown" style="animation-delay: 0.6s;">
            <form method="POST" action="{{ route('logout') }}" class="d-flex">
              @csrf
              <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container">
    @yield('content')
  </main>

  <footer class="footer-custom animate__animated animate__fadeInUp">
    <div class="container">
      <p class="mb-0">&copy; 2025 PIPGuard. Semua hak dilindungi.</p>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  
  <!-- Font Awesome JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  
  <!-- Scroll Animation -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
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
          0% { transform: translateY(0px); }
          50% { transform: translateY(-20px); }
          100% { transform: translateY(0px); }
        }
      `;
      document.head.appendChild(style);
    });
  </script>
  
  @stack('scripts')
</body>
</html>