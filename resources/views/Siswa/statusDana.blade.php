<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Status Dana - PIPGuard</title>
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
      <a href="status_dana.html" class="active"><i class="fas fa-wallet"></i>Status Dana</a>
      <a href="detail_pencairan.html"><i class="fas fa-info-circle"></i>Detail</a>
      <a href="laporan.html"><i class="fas fa-exclamation-triangle"></i>Laporan</a>
      <a href="transparansi.html"><i class="fas fa-chart-pie"></i>Transparansi</a>
      <button class="logout-btn" onclick="logout()">Logout</button>
    </nav>
  </header>

  <main class="container">
    <section class="status-section">
  <h2>Status Terkini</h2>
  <div class="status-progress">
    <div class="status-step" id="step-belum">
      <div class="circle"></div>
      <p>Belum Dicairkan</p>
    </div>
    <div class="status-step active" id="step-proses">
      <div class="circle"></div>
      <p>Dalam Proses</p>
    </div>
    <div class="status-step" id="step-sudah">
      <div class="circle"></div>
      <p>Sudah Cair</p>
    </div>
  </div>

  <!-- Judul periode & dropdown -->
<div class="periode-section">
  <h3>Periode Pencairan</h3>
  <label for="kelas-dropdown">Pilih Kelas:</label>
  <select id="kelas-dropdown">
    <option value="X">Kelas X</option>
    <option value="XI" selected>Kelas XI</option>
    <option value="XII">Kelas XII</option>
  </select>
</div>
  <!-- Tabel status pencairan -->
  <div class="status-info-table">
    <table class="data-table">
      <thead>
        <tr>
          <th>Periode</th>
          <th>Status</th>
          <th>Nominal</th>
          <th>Tanggal Pencairan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Semester 1</td>
          <td>Sudah Cair</td>
          <td>Rp 1.200.000</td>
          <td>12 Juli 2024</td>
        </tr>
        <tr>
          <td>Semester 2</td>
          <td>Sedang Diproses</td>
          <td>Rp 1.200.000</td>
          <td>-</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <script>
    // Simulasi status dana & riwayat
    const statusDana = 'Sedang Diproses'; // Contoh: 'Belum Dicairkan', 'Sedang Diproses', 'Sudah Cair'
    const stepBelum = document.getElementById('step-belum');
    const stepProses = document.getElementById('step-proses');
    const stepSudah = document.getElementById('step-sudah');
    const statusTextEl = document.getElementById('status-text');

    // Reset semua step
    [stepBelum, stepProses, stepSudah].forEach(step => step.classList.remove('active'));

    // Update progress sesuai status
    const status = statusDana.toLowerCase();
    if (status === 'belum dicairkan') {
      stepBelum.classList.add('active');
    } else if (status === 'sedang diproses' || status === 'dalam proses') {
      stepProses.classList.add('active');
    } else if (status === 'sudah cair') {
      stepSudah.classList.add('active');
    }

    statusTextEl.textContent = statusDana;

    const riwayatTable = document.getElementById('riwayat-table');
    const kelasDropdown = document.getElementById('kelas-dropdown');
    const riwayatData = {
      X: [
        { periode: 'Semester 1', status: 'Sudah Cair', nominal: 'Rp 1.000.000', tanggal: '10 Juli 2023' },
        { periode: 'Semester 2', status: 'Sudah Cair', nominal: 'Rp 1.000.000', tanggal: '15 Januari 2024' }
      ],
      XI: [
        { periode: 'Semester 1', status: 'Sudah Cair', nominal: 'Rp 1.200.000', tanggal: '12 Juli 2024' },
        { periode: 'Semester 2', status: 'Sedang Diproses', nominal: 'Rp 1.200.000', tanggal: '-' }
      ],
      XII: [
        { periode: 'Semester 1', status: 'Belum Dicairkan', nominal: 'Rp 1.200.000', tanggal: '-' },
        { periode: 'Semester 2', status: 'Belum Dicairkan', nominal: 'Rp 1.200.000', tanggal: '-' }
      ]
    };

    function updateRiwayat(kelas) {
      const data = riwayatData[kelas];
      riwayatTable.innerHTML = data.map(row => `
        <tr>
          <td>${row.periode}</td>
          <td>${row.status}</td>
          <td>${row.nominal}</td>
          <td>${row.tanggal}</td>
        </tr>
      `).join('');
    }

    kelasDropdown.addEventListener('change', () => {
      updateRiwayat(kelasDropdown.value);
    });

    // Inisialisasi awal
    updateRiwayat(kelasDropdown.value);

    function logout() {
      alert("Anda telah logout.");
      location.href = "../index.html";
    }
  </script>
</body>
</html>
