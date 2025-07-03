<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Pemerintah - PIPGuard</title>
  <link rel="stylesheet" href="../css/dashboard_pemerintah.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <img src="../img/logo.png" alt="Logo PIPGuard" />
        <h2>PIPGuard</h2>
      </div>
      <ul class="list-unstyled components">
        <li class="active" data-section="dashboard">
          <a href="#"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle"><i class="fas fa-database"></i> Data Master <i class="fas fa-chevron-down arrow"></i></a>
          <ul class="submenu list-unstyled">
            <li data-section="kelola-sekolah"><a href="#">Kelola Sekolah</a></li>
            <li data-section="upload-penerima"><a href="#">Upload Data Penerima</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle"><i class="fas fa-search"></i> Monitoring <i class="fas fa-chevron-down arrow"></i></a>
          <ul class="submenu list-unstyled">
            <li data-section="kelola-pencairan"><a href="#">Kelola Pencairan</a></li>
            <li data-section="laporan-siswa"><a href="#">Laporan Siswa</a></li>
          </ul>
        </li>
        <li data-section="tindak-lanjut">
          <a href="#"><i class="fas fa-tasks"></i> Tindak Lanjut</a>
        </li>
        <li data-section="transparansi">
          <a href="#"><i class="fas fa-chart-pie"></i> Transparansi</a>
        </li>
        <li>
          <button id="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </li>
      </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
      <header>
        <h1>Dashboard Pemerintah</h1>
      <main>
       <section id="dashboard" class="content-section active">
  <!-- Statistik cards -->
  <div class="stats-cards">
    <div class="card">
      <div class="icon">&#x1F4B0;</div> <!-- emoji uang -->
      <div class="info">
        <h3>Total Dana Cair</h3>
        <p>Rp 2.500.000.000</p>
      </div>
    </div>
    <div class="card">
      <div class="icon">&#x1F3EB;</div> <!-- emoji sekolah -->
      <div class="info">
        <h3>Jumlah Sekolah</h3>
        <p>120 Sekolah</p>
      </div>
    </div>
    <div class="card">
      <div class="icon">&#x1F393;</div> <!-- emoji topi wisuda, mewakili siswa -->
      <div class="info">
        <h3>Jumlah Penerima</h3>
        <p>5000 Siswa</p>
      </div>
    </div>
    <div class="card">
      <div class="icon">&#x26A0;</div> <!-- emoji peringatan -->
      <div class="info">
        <h3>Laporan Ketidaksesuaian</h3>
        <p>15 Laporan</p>
      </div>
    </div>
</div>

<div class="chart-container" style="width: 400px; margin: 20px auto;">
    <h2 style="text-align: center;">Grafik Status Pencairan Dana</h2>
  <canvas id="pencairanChart"></canvas>
</div>

  <!-- Daftar laporan ketidaksesuaian terbaru -->
  <div class="laporan-container">
    <h3>Daftar Laporan Ketidaksesuaian Dana Terbaru</h3>
    <table class="laporan-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Sekolah</th>
          <th>Deskripsi</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody id="laporan-tbody">
        <!-- Data laporan terisi dari JS -->
      </tbody>
    </table>
  </div>
</section>
 </header>

<section id="kelola-sekolah" class="content-section">
  <div class="kelola-header">
    <button id="btnTambahSekolah" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Sekolah</button>

    <div class="search-container">
     <input type="text" id="searchSekolah" placeholder="Cari Sekolah atau NPSN..." />

      <button id="btnSearch"><i class="fas fa-search"></i></button>
    </div>
  </div>

  <table id="sekolahTable" class="sekolah-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Sekolah</th>
        <th>NPSN</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <!-- Data sekolah muncul di sini -->
    </tbody>
  </table>

  <!-- Modal Tambah/Edit -->
  <div id="modalSekolah" class="modal hidden">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h3 id="modalTitle">Tambah Sekolah</h3>
      <form id="formSekolah">
        <label for="namaSekolah">Nama Sekolah</label>
        <input type="text" id="namaSekolah" required />

        <label for="npsnSekolah">NPSN</label>
        <input type="text" id="npsnSekolah" maxlength="10" required />

        <label for="alamatSekolah">Alamat</label>
        <textarea id="alamatSekolah" rows="3" required></textarea>

        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
</section>

<section id="upload-penerima" class="content-section">
  <form id="uploadForm" class="upload-form-vertical">
    <label for="fileUpload" class="form-label">Pilih file Excel (.xls atau .xlsx):</label>
    <input type="file" id="fileUpload" accept=".xls,.xlsx" required class="file-input" />
    <button type="submit" class="btn btn-primary upload-btn">Upload</button>
  </form>

  <div id="previewContainer" style="margin-top: 20px; display:none;">
    <h3>Preview Data yang Diunggah</h3>
    <table id="previewTable" border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse: collapse;">
      <thead>
        <tr>
          <th>No</th>
          <th>NISN</th>
          <th>Nama</th>
          <th>Sekolah</th>
          <th>Kelas</th>
          <th>Jumlah Dana</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</section>

        <section id="kelola-pencairan" class="content-section">
          <h2>Kelola Pencairan</h2>
          <p>Monitoring dan kontrol pencairan dana.</p>
        </section>

        <section id="laporan-siswa" class="content-section">
          <h2>Laporan Siswa</h2>
          <p>Data laporan penerima dana per siswa.</p>
        </section>

        <section id="tindak-lanjut" class="content-section">
          <h2>Tindak Lanjut</h2>
          <p>Proses tindak lanjut dari temuan laporan dan audit.</p>
        </section>

        <section id="transparansi" class="content-section">
          <h2>Transparansi</h2>
          <p>Informasi transparansi dana PIP untuk publik.</p>
        </section>
      </main>
    </div>
  </div>

  <script src="../js/dashboard_pemerintah.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script>
  const uploadForm = document.getElementById('uploadForm');
  const fileUpload = document.getElementById('fileUpload');
  const previewContainer = document.getElementById('previewContainer');
  const previewTableBody = document.querySelector('#previewTable tbody');

  uploadForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const file = fileUpload.files[0];
    if (!file) {
      alert("Silakan pilih file Excel terlebih dahulu.");
      return;
    }

    const reader = new FileReader();
    reader.onload = function(event) {
      const data = new Uint8Array(event.target.result);
      const workbook = XLSX.read(data, {type: 'array'});

      // Ambil sheet pertama
      const firstSheetName = workbook.SheetNames[0];
      const worksheet = workbook.Sheets[firstSheetName];

      // Konversi sheet ke JSON
      const jsonData = XLSX.utils.sheet_to_json(worksheet, {header: 1});

      // Validasi kolom minimal (contoh kolom header: NISN, Nama, Sekolah, Kelas, Jumlah Dana)
      const header = jsonData[0];
      if (!header || header.length < 5) {
        alert("Format file Excel tidak sesuai. Pastikan kolom: NISN, Nama, Sekolah, Kelas, Jumlah Dana ada.");
        return;
      }

      // Bersihkan preview
      previewTableBody.innerHTML = '';

      // Tampilkan data mulai dari baris ke-2 (index 1)
      for (let i = 1; i < jsonData.length; i++) {
        const row = jsonData[i];
        if(row && row.length >= 5) {
          const no = i;
          const nisn = row[0] || '';
          const nama = row[1] || '';
          const sekolah = row[2] || '';
          const kelas = row[3] || '';
          const dana = row[4] || 0;

          previewTableBody.innerHTML += `
            <tr>
              <td>${no}</td>
              <td>${nisn}</td>
              <td>${nama}</td>
              <td>${sekolah}</td>
              <td>${kelas}</td>
              <td>Rp ${Number(dana).toLocaleString('id-ID')}</td>
            </tr>
          `;
        }
      }

      previewContainer.style.display = 'block';

      // Simpan jsonData ke variabel global jika mau lanjut upload ke backend
      window.uploadedData = jsonData;
    };

    reader.readAsArrayBuffer(file);
  });
</script>
</body>
</html>
