<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - PIPGuard</title>
  <style>
    :root {
      --pip-blue-dark: #003366;
      --pip-yellow: #F9B233;
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
    }
    .container {
      background: white;
      color: var(--pip-text-dark);
      border-radius: 12px;
      max-width: 400px;
      width: 100%;
      padding: 2rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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
    .error-msg {
      color: red;
      margin-top: 0.5rem;
      font-size: 0.9rem;
      text-align: center;
    }
    .hidden {
      display: none;
    }
    .link {
      margin-top: 0.75rem;
      text-align: center;
    }
    .link a {
      color: #0056b3;
      text-decoration: none;
      font-size: 0.9rem;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container" id="login-section">
    <div class="header-logo">
      <img src="img/logo.png" alt="PIPGuard Logo" />
      <h2>PIPGuard Login</h2>
    </div>

    <select id="role-select" aria-label="Pilih Role">
      <option value="" selected disabled>-- Pilih Role --</option>
      <option value="siswa">Siswa</option>
      <option value="sekolah">Sekolah</option>
      <option value="pemerintah">Pemerintah</option>
    </select>

    <input type="text" id="username" placeholder="NISN / NPSN / Email" autocomplete="username" />
    <input type="password" id="password" placeholder="Password" autocomplete="current-password" />
    <button id="login-btn">Masuk</button>

    <div class="link">
      <a href="lupa-password.html" id="forgot-password">Lupa password?</a>
    </div>

    <p id="error-msg" class="error-msg hidden"></p>
  </div>

  <script>
    const roleSelect = document.getElementById('role-select');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const loginBtn = document.getElementById('login-btn');
    const errorMsg = document.getElementById('error-msg');
    const forgotPasswordLink = document.getElementById('forgot-password');

    // Update placeholder berdasarkan role
    roleSelect.addEventListener('change', () => {
      const role = roleSelect.value;
      usernameInput.placeholder = role === 'siswa' ? 'NISN' :
                                 role === 'sekolah' ? 'NPSN' :
                                 role === 'pemerintah' ? 'Email' :
                                 'NISN / NPSN / Email';
    });

    loginBtn.addEventListener('click', () => {
      const role = roleSelect.value;
      const username = usernameInput.value.trim();
      const password = passwordInput.value.trim();

      if (!role) {
        errorMsg.textContent = 'Harap pilih role.';
        errorMsg.classList.remove('hidden');
        return;
      }
      if (!username) {
        errorMsg.textContent = 'Username tidak boleh kosong.';
        errorMsg.classList.remove('hidden');
        return;
      }
      if (!password) {
        errorMsg.textContent = 'Password tidak boleh kosong.';
        errorMsg.classList.remove('hidden');
        return;
      }

      errorMsg.classList.add('hidden');

      // Redirect sesuai role (pastikan path file dashboard benar)
      if (role === 'siswa') {
        window.location.href = 'siswa/dashboard.html';
      } else if (role === 'sekolah') {
        window.location.href = 'sekolah/dashboard.html';
      } else if (role === 'pemerintah') {
        window.location.href = 'pemerintah/dashboard.html';
      }
    });
    
  </script>
</body>
</html>



