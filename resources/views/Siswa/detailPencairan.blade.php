<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Pencairan - PIPGuard</title>
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
      <a href="detail_pencairan.html" class="active"><i class="fas fa-info-circle"></i>Detail</a>
      <a href="laporan.html"><i class="fas fa-exclamation-triangle"></i>Laporan</a>
      <a href="transparansi.html"><i class="fas fa-chart-pie"></i>Transparansi</a>
      <button class="logout-btn" onclick="logout()">Logout</button>
    </nav>
  </header>

  <main class="container">
    <section id="detail-pencairan" class="content-section active">
      <h2>Detail Pencairan Dana</h2>
      <table class="data-table">
        <tbody>
          <tr><th>Nominal Dana</th><td id="nominal-terima"></td></tr>
          <tr><th>Tanggal Pengajuan</th><td id="tanggal-pengajuan"></td></tr>
          <tr><th>Tanggal Pencairan</th><td id="tanggal-cair"></td></tr>
          <tr><th>Status Pencairan</th><td id="status-pencairan"></td></tr>
          <tr><th>Metode Transfer</th><td id="metode-transfer"></td></tr>
          <tr><th>Nomor Referensi Transaksi</th><td id="nomor-ref"></td></tr>
        </tbody>
      </table>
    </section>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <script>
    const detail = {
      nominal: 'Rp 1.200.000',
      tanggalPengajuan: '5 Juni 2025',
      tanggalPencairan: '-', // Jika belum cair
      statusPencairan: 'Sedang Diproses',
      metode: 'Bank BRI',
      referensi: 'TRX1234567890'
    };

    document.getElementById('nominal-terima').textContent = detail.nominal;
    document.getElementById('tanggal-pengajuan').textContent = detail.tanggalPengajuan;
    document.getElementById('tanggal-cair').textContent = detail.tanggalPencairan;
    document.getElementById('status-pencairan').textContent = detail.statusPencairan;
    document.getElementById('metode-transfer').textContent = detail.metode;
    document.getElementById('nomor-ref').textContent = detail.referensi;

    function logout() {
      alert("Anda telah logout.");
      location.href = "../index.html";
    }
  </script>
</body>
</html>
