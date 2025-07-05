<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ganti Password - PIPGuard</title>
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
    input[type="text"], input[type="password"] {
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
      margin-bottom: 1rem;
      font-size: 0.9rem;
      text-align: left;
    }
    .success-msg {
      color: green;
      margin-bottom: 1rem;
      font-size: 0.95rem;
      text-align: center;
    }
    .back-link {
      margin-top: 1rem;
      font-size: 0.9rem;
    }
    .back-link a {
      color: var(--pip-yellow);
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header-logo">
      <h2>Ganti Password</h2>
    </div>

    <form id="change-password-form" method="POST" action="{{ route('password.change') }}">
  <input type="text" name="user_identifier" placeholder="Masukkan Email / NISN / NPSN" required />
  <input type="password" name="new_password" placeholder="Password Baru" required />
  <input type="password" name="new_password_confirmation" placeholder="Konfirmasi Password Baru" required />
  <button type="submit">Ganti Password</button>
</form>


    <div class="back-link">
      <a href="index.html">&larr; Kembali ke Login</a>
    </div>
  </div>

  <script>
    const form = document.getElementById('change-password-form');
    const userId = document.getElementById('user-identifier');
    const newPass = document.getElementById('new-password');
    const confirmPass = document.getElementById('confirm-password');
    const errorMsg = document.getElementById('error-msg');
    const successMsg = document.getElementById('success-msg');

    form.addEventListener('submit', e => {
      e.preventDefault();
      errorMsg.style.display = 'none';
      successMsg.style.display = 'none';

      const userVal = userId.value.trim();
      const newPassVal = newPass.value.trim();
      const confirmPassVal = confirmPass.value.trim();

      if (!userVal) {
        showError('Mohon isi Email / NISN / NPSN.');
        return;
      }
      if (!newPassVal) {
        showError('Password baru harus diisi.');
        return;
      }
      if (newPassVal.length < 6) {
        showError('Password baru minimal 6 karakter.');
        return;
      }
      if (newPassVal !== confirmPassVal) {
        showError('Konfirmasi password tidak cocok.');
        return;
      }

      // Simulasi proses ganti password
      // Gantilah dengan proses backend sesungguhnya lewat fetch/ajax kalau ada
      successMsg.textContent = `Password berhasil diganti untuk akun: ${userVal}`;
      successMsg.style.display = 'block';
      form.reset();
    });

    function showError(message) {
      errorMsg.textContent = message;
      errorMsg.style.display = 'block';
    }
  </script>
</body>
</html>
