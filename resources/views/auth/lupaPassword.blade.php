<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lupa Password - PIPGuard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
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
      padding: 1rem;
    }

    .forgot-card {
      background: var(--card-color);
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      padding: 2.5rem;
      width: 100%;
      max-width: 450px;
      position: relative;
      z-index: 1;
    }

    .forgot-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .forgot-header h2 {
      color: var(--text-color);
      font-weight: 700;
    }

    .form-floating label {
      color: var(--text-light);
    }

    .form-control {
      border-radius: 10px;
      padding: 1rem;
      border: 2px solid #e9ecef;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }

    .btn-reset {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border: none;
      border-radius: 10px;
      padding: 1rem;
      font-weight: 600;
      width: 100%;
      margin-top: 1rem;
      color: white;
    }

    .btn-reset:hover {
      transform: translateY(-3px);
      box-shadow: 0 7px 20px rgba(67, 97, 238, 0.4);
    }

    .back-link {
      text-align: center;
      margin-top: 1.5rem;
    }

    .back-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
    }

    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="forgot-card animate__animated animate__fadeIn">
    <div class="forgot-header">
      <h2><i class="fas fa-unlock-alt me-2"></i>Lupa Password</h2>
      <p class="text-muted">Masukkan identitas Anda untuk mengganti password.</p>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.change') }}">
      @csrf
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="user_identifier" name="user_identifier"
               placeholder="Email / NISN / NPSN" required>
        <label for="user_identifier"><i class="fas fa-user me-2"></i>Email / NISN / NPSN</label>
      </div>

      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="new_password" name="new_password"
               placeholder="Password Baru" required>
        <label for="new_password"><i class="fas fa-lock me-2"></i>Password Baru</label>
      </div>

      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
               placeholder="Konfirmasi Password Baru" required>
        <label for="new_password_confirmation"><i class="fas fa-lock me-2"></i>Konfirmasi Password</label>
      </div>

      <button type="submit" class="btn btn-reset">
        <i class="fas fa-sync-alt me-2"></i> Ganti Password
      </button>
    </form>

    <div class="back-link">
      <a href="{{ url('/login') }}"><i class="fas fa-arrow-left me-1"></i> Kembali ke Login</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
