<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Transparansi Dana - PIPGuard</title>
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
      <a href="laporan.html"><i class="fas fa-exclamation-triangle"></i>Laporan</a>
      <a href="transparansi.html" class="active"><i class="fas fa-chart-pie"></i>Transparansi</a>
      <button class="logout-btn" onclick="logout()">Logout</button>
    </nav>
  </header>

  <main class="container">
    <section id="transparansi" class="content-section active">
      <h2>Statistik Dana PIP</h2>

      <div class="cards">
        <div class="card">
          <i class="fas fa-money-bill-wave"></i>
          <div class="content">
            <div class="label">Total Dana Cair</div>
            <div class="value">2.500.000.000</div>
          </div>
        </div>
        <div class="card">
          <i class="fas fa-user-friends"></i>
          <div class="content">
            <div class="label">Jumlah Penerima</div>
            <div class="value">5.000 siswa</div>
          </div>
        </div>
        <div class="card">
          <i class="fas fa-calendar-alt"></i>
          <div class="content">
            <div class="label">Periode Terbaru</div>
            <div class="value">Semester 1-2025</div>
          </div>
        </div>
      </div>

      <div class="recent-activity">
        <h3 class="section-title">🔔 Info Terbaru Pencairan Dana</h3>
        <div class="notification-box">
          <p><strong>SDN 1 Sukamaju</strong> telah berhasil mencairkan dana PIP pada 1 Juli 2025.</p>
          <p><strong>SMPN 5 Harmoni</strong> telah berhasil mencairkan dana PIP pada 28 Juni 2025.</p>
          <p><strong>SMAN 3 Sentosa</strong> telah berhasil mencairkan dana PIP pada 25 Juni 2025.</p>
        </div>
      </div>

      <div class="report-section">
        <h3 class="section-title">📢 Laporan Ketidaksesuaian Dana dari Siswa</h3>
        <ul class="report-list">
          <li><strong>Anonim01 - SMKN 2 Mekarjaya:</strong> “Jumlah dana diterima tidak sesuai dengan yang tertera.”</li>
          <li><strong>AnonimA - SMPN 4 Pelita:</strong> “Dana belum cair meski status sudah cair di sistem.”</li>
          <li><strong>Anonim17 - SMAN 6 Sinar Harapan:</strong> “Tanggal pencairan di dashboard berbeda dengan rekening.”</li>
        </ul>
      </div>

      <div class="laporan-section">
        <h3>Laporan Penting</h3>
        <ul class="laporan-list">
          <li><a href="laporan_pencairan_semester2_2024.html" target="_blank" rel="noopener noreferrer">Laporan Pencairan Semester 2 Tahun 2024</a></li>
          <li><a href="ringkasan_audit_keuangan_2024.html" target="_blank" rel="noopener noreferrer">Ringkasan Audit Keuangan PIP Tahun 2024</a></li>
        </ul>
      </div>

      <div class="footer-info">
        Info lebih lanjut kunjungi situs resmi <a href="https://pip.kemendikdasmen.go.id" target="_blank" rel="noopener noreferrer">pip.kemendikdasmen.go.id</a>
      </div>
    </section>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <script>
    function logout() {
      alert("Anda telah logout.");
      location.href = "../index.html";
    }
  </script>
</body>
</html>