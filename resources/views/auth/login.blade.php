<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - PIPGuard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #F9B233;
      --bg-gradient: linear-gradient(135deg, #004e92, #000428);
      --card-color: rgba(255, 255, 255, 0.95);
      --text-color: #2b2b2b;
      --text-light: #6c757d;
    }
    
    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: var(--bg-gradient);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: white;
      position: relative;
      overflow: hidden;
      padding: 1rem;
    }
    
    /* Background Animation */
    .bg-particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      overflow: hidden;
    }
    
    .particle {
      position: absolute;
      border-radius: 50%;
      opacity: 0.3;
      animation: float 15s infinite linear;
    }
    
    .particle-1 {
      width: 300px;
      height: 300px;
      background: var(--accent-color);
      top: -50px;
      left: -100px;
      animation-delay: 0s;
    }
    
    .particle-2 {
      width: 400px;
      height: 400px;
      background: var(--primary-color);
      bottom: -150px;
      right: -150px;
      animation-delay: 2s;
    }
    
    .particle-3 {
      width: 200px;
      height: 200px;
      background: #00BCD4;
      top: 60%;
      left: 40%;
      animation-delay: 4s;
    }
    
    @keyframes float {
      0% { transform: translate(0, 0) rotate(0deg); }
      50% { transform: translate(50px, 30px) rotate(180deg); }
      100% { transform: translate(0, 0) rotate(360deg); }
    }
    
    /* Login Card */
    .login-card {
      background: var(--card-color);
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      padding: 2.5rem;
      width: 100%;
      max-width: 450px;
      position: relative;
      z-index: 1;
      transition: all 0.5s ease;
      overflow: hidden;
    }
    
    .login-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
    
    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 8px;
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }
    
    /* Header */
    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }
    
    .login-logo {
      width: 80px;
      height: 80px;
      margin: 0 auto 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 50%;
      color: white;
      font-size: 2rem;
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }
    
    .login-title {
      color: var(--text-color);
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    
    .login-subtitle {
      color: var(--text-light);
      font-size: 0.95rem;
    }
    
    /* Form */
    .form-floating label {
      color: var(--text-light);
    }
    
    .form-control {
      border-radius: 10px;
      padding: 1rem;
      border: 2px solid #e9ecef;
      transition: all 0.3s;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .form-select {
      border-radius: 10px;
      padding: 1rem;
      border: 2px solid #e9ecef;
    }
    
    /* Button */
    .btn-login {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border: none;
      border-radius: 10px;
      padding: 1rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: all 0.3s;
      width: 100%;
      margin-top: 1rem;
    }
    
    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 7px 20px rgba(67, 97, 238, 0.4);
    }
    
    /* Alert */
    .alert {
      border-radius: 10px;
      border: none;
    }
    
    .alert-success {
      background-color: rgba(76, 201, 240, 0.1);
      color: var(--text-color);
      border-left: 4px solid #4cc9f0;
    }
    
    .alert-danger {
      background-color: rgba(247, 37, 133, 0.1);
      color: var(--text-color);
      border-left: 4px solid #f72585;
    }
    
    /* Link */
    .login-link {
      text-align: center;
      margin-top: 1.5rem;
    }
    
    .login-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s;
    }
    
    .login-link a:hover {
      color: var(--secondary-color);
      text-decoration: underline;
    }
    
    /* Animations */
    .animate-delay-1 { animation-delay: 0.2s; }
    .animate-delay-2 { animation-delay: 0.4s; }
  </style>
</head>
<body>
  <!-- Background Particles -->
  <div class="bg-particles">
    <div class="particle particle-1 animate_animated animatepulse animate_infinite"></div>
    <div class="particle particle-2 animate_animated animatepulse animate_infinite"></div>
    <div class="particle particle-3 animate_animated animatepulse animate_infinite"></div>
  </div>

  <!-- Login Card -->
  <div class="login-card animate_animated animate_fadeIn">
    <div class="login-header">
      <div class="login-logo animate_animated animate_bounceIn">
        <i class="fas fa-shield-alt"></i>
      </div>
      <h2 class="login-title animate_animated animate_fadeInDown">PIPGuard</h2>
      <p class="login-subtitle animate_animated animate_fadeIn animate-delay-1">Masuk ke akun Anda</p>
    </div>

    @if(session('success'))
      <div class="alert alert-success animate_animated animate_fadeIn animate-delay-1 mb-4">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger animate_animated animate_fadeIn animate-delay-1 mb-4">
        <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ url('/login') }}" class="animate_animated animate_fadeIn animate-delay-2">
      @csrf

      <div class="mb-3">
        <select class="form-select" name="role" required>
          <option value="" disabled selected>-- Pilih Role --</option>
          <option value="siswa" {{ old('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
          <option value="sekolah" {{ old('role') === 'sekolah' ? 'selected' : '' }}>Sekolah</option>
        </select>
      </div>

      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="username" name="username" value="{{ old('username') }}" 
               placeholder="NISN / NPSN / Email" autocomplete="username" required>
        <label for="username"><i class="fas fa-user me-2"></i>NISN / NPSN</label>
      </div>

      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" 
               placeholder="Password" autocomplete="current-password" required>
        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
      </div>

      <div class="text-end mb-2">
  <a href="{{ url('/forgot-password') }}" class="text-decoration-none fw-semibold" style="color: var(--primary-color);">
    <i class="fas fa-unlock-alt me-1"></i> Lupa Password?
  </a>
</div>

      <button type="submit" class="btn btn-primary btn-login">
        <i class="fas fa-sign-in-alt me-2"></i> Masuk
      </button>
    </form>

    <div class="login-link animate_animated animate_fadeIn animate-delay-3">
      <a href="{{ route('transparansi.publik') }}">
        <i class="fas fa-external-link-alt me-2"></i> Transparansi Umum
      </a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script>
    // Animasi saat elemen muncul di viewport
    document.addEventListener('DOMContentLoaded', function() {
      const animateElements = document.querySelectorAll('.animate__animated');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const animation = entry.target.getAttribute('class').match(/animate__\w+/)[0];
            entry.target.classList.add(animation);
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });
      
      animateElements.forEach(el => observer.observe(el));
    });
  </script>
</body>
</html>