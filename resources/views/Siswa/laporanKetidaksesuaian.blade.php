<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Laporan Ketidaksesuaian - PIPGuard</title>
  <link rel="stylesheet" href="../css/dashboard_siswa.css" />
</head>
<body>
  <header>
    <div class="logo-header">
      <img src="../img/logo.png" alt="Logo PIPGuard" />
      <h1>PIPGuard</h1>
    </div>
    <nav class="menu-nav">
        <a href="dashboard.html"><i class="fas fa-home"></i>Dashboard</a>
      <a href="status_dana.html"><i class="fas fa-wallet"></i>Status Dana</a>
      <a href="detail_pencairan.html"><i class="fas fa-info-circle"></i>Detail</a>
      <a href="laporan.html" class="active"><i class="fas fa-exclamation-triangle"></i>Laporan</a>
      <a href="transparansi.html"><i class="fas fa-chart-pie"></i>Transparansi</a>
      <button class="logout-btn" onclick="logout()">Logout</button>
    </nav>
  </header>

  <main class="container">
    <section id="laporan-ketidaksesuaian" class="content-section active">
      <h2>Laporkan Ketidaksesuaian Dana</h2>

      <textarea id="laporan-text" placeholder="Tuliskan perbedaan dana yang Anda terima..."></textarea>

      <label for="bukti-upload" style="display:block; margin-top: 1rem; margin-bottom: 0.25rem; font-weight: 600;">Upload Bukti</label>
      <input type="file" id="bukti-upload" accept="image/*,application/pdf" />

      <button id="lapor-btn" style="margin-top: 1rem; display: block;">Kirim Laporan</button>
      <p id="lapor-msg" class="msg hidden"></p>
    </section>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <script>
    const laporBtn = document.getElementById('lapor-btn');
    const laporanText = document.getElementById('laporan-text');
    const laporMsg = document.getElementById('lapor-msg');
    const buktiUpload = document.getElementById('bukti-upload');

    laporBtn.addEventListener('click', () => {
      const laporan = laporanText.value.trim();
      const file = buktiUpload.files[0];

      if (!laporan) {
        laporMsg.textContent = 'Mohon isi laporan ketidaksesuaian.';
        laporMsg.classList.remove('hidden', 'success');
        return;
      }

      if (!file) {
        laporMsg.textContent = 'Mohon upload bukti pendukung.';
        laporMsg.classList.remove('hidden', 'success');
        return;
      }

      laporMsg.textContent = 'Laporan berhasil dikirim. Terima kasih.';
      laporMsg.classList.remove('hidden');
      laporMsg.classList.add('success');
      laporanText.value = '';
      buktiUpload.value = ''; // reset input file
    });

    function logout() {
      alert("Anda telah logout.");
      location.href = "../index.html";
    }
  </script>
</body>
</html>
