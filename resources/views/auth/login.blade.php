<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - PIPGuard</title>
  <style>
:root {
  --pip-blue-dark: #004e92;
  --accent-color: #ffb347;
  --pip-yellow: #F9B233;
  --green-pip: #1abc9c;
  --pip-text-dark: #2b2b2b;
  --pip-text-light: #555;
}

  * {
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
  }
  body {
    margin: 0;
    background-color: var(--pip-blue-dark);
    color: #fff;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
    position: relative;
    overflow: hidden;
  }

  /* 🎨 Lingkaran-lingkaran background */
  body::before {
    content: "";
    position: absolute;
    width: 200%;
    height: 200%;
    top: -50%;
    left: -50%;
    background: radial-gradient(circle at 20% 30%, var(--pip-yellow) 10%, transparent 30%),
                radial-gradient(circle at 80% 20%, #ffffff55 10%, transparent 30%),
                radial-gradient(circle at 50% 70%, #00bcd48f 10%, transparent 30%);
    z-index: 0;
    animation: floatCircles 20s infinite linear;
  }

  @keyframes floatCircles {
    0% { transform: translate(0, 0); }
    50% { transform: translate(50px, 30px); }
    100% { transform: translate(0, 0); }
  }

  .container {
    background: white;
    color: var(--pip-text-dark);
    border-radius: 12px;
    max-width: 400px;
    width: 100%;
    padding: 2rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    position: relative;
    z-index: 1;
  }
    #login-section {
      text-align: center;
    }
    .header-logo {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-bottom: 1rem;
    }
    .header-logo img {
      width: 50px;
      height: 50px;
      object-fit: contain;
    }
    .header-logo h2 {
      margin: 0;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--pip-text-dark);
    }
    select, input[type="text"], input[type="password"] {
      width: 100%;
      padding: 0.7rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }
    button {
      background-color: var(--pip-yellow);
      color: white;
      border: none;
      width: 100%;
      padding: 0.7rem;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #d99725;
    }
    .error-msg, .alert {
      margin-top: 0.5rem;
      font-size: 0.9rem;
      text-align: center;
      padding: 0.5rem;
      border-radius: 6px;
    }
    .alert-success {
      background-color: #d4edda;
      color: #155724;
    }
    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
    }
    .link {
      margin-top: 0.75rem;
      text-align: center;
    }
    .link a {
      color: #0056b3;
      text-decoration: none;
      font-size: 0.9rem;
    }
    .circle {
  position: absolute;
  border-radius: 50%;
  opacity: 0.5;
  z-index: 0;
}

/* Kuning */
.circle.accent {
  background: var(--accent-color);
  width: 400px;
  height: 400px;
  top: -100px;
  left: -120px;
}

/* Biru Gelap */
.circle.blue {
  background: var(--pip-blue-dark);
  width: 500px;
  height: 500px;
  bottom: -150px;
  right: -150px;
}

/* Biru Muda */
.circle.cyan {
  background: #00BCD4;
  width: 300px;
  height: 300px;
  top: 60%;
  left: 40%;
  transform: translate(-50%, -50%);
}

/* Hijau */
.circle.green {
  background: var(--green-pip);
  width: 350px;
  height: 350px;
  top: 20%;
  right: -100px;
}




  </style>
</head>
<body>
<div class="circle accent"></div>
<div class="circle blue"></div>
<div class="circle cyan"></div>
<div class="circle green"></div>
<div class="circle yellow"></div>
  <div class="container" id="login-section">
    <div class="header-logo">
      <img src="{{ asset('/storage/img/logo.png') }}" alt="PIPGuard Logo" />
      <h2>PIPGuard Login</h2>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
      @csrf

      <select name="role" required>
        <option value="" disabled selected>-- Pilih Role --</option>
        <option value="siswa" {{ old('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
        <option value="sekolah" {{ old('role') === 'sekolah' ? 'selected' : '' }}>Sekolah</option>
      </select>

      <input type="text" name="username" value="{{ old('username') }}" placeholder="NISN / NPSN / Email" autocomplete="username" required />
      <input type="password" name="password" placeholder="Password" autocomplete="current-password" required />

      <button type="submit">Masuk</button>
    </form>

    <div class="link">
      <a href="{{ route('transparansi.publik') }}">Transparansi Umum</a>
    </div>


  </div>
</body>
</html>
