<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - PIPGuard</title>
  <link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}">
</head>
<body>
  <header>
    <div class="logo-header">
      <img src="../img/logo.png" alt="Logo PIPGuard" />
      <h1>PIPGuard</h1>
    </div>
    <nav class="menu-nav">
      <a href="dashboard.html" class="active"><i class="fas fa-home"></i>Dashboard</a>
      <a href="status_dana.html"><i class="fas fa-wallet"></i>Status Dana</a>
      <a href="detail_pencairan.html"><i class="fas fa-info-circle"></i>Detail</a>
      <a href="laporan.html"><i class="fas fa-exclamation-triangle"></i>Laporan</a>
      <a href="transparansi.html"><i class="fas fa-chart-pie"></i>Transparansi</a>
      <button class="logout-btn" onclick="logout()">Logout</button>
    </nav>
  </header>

  <main>
    <!-- Gambar + deskripsi -->
    <section class="intro-section">
      <div class="intro-text">
        <h2>Apa itu PIPGuard?</h2>
        <p>
          PIPGuard adalah platform transparansi dan monitoring pencairan dana Bantuan
          Indonesia Pintar (PIP) yang dirancang untuk membantu siswa memantau status
          bantuan secara mudah dan aman. Dengan PIPGuard, siswa dapat mengetahui progres
          pencairan, mengajukan laporan ketidaksesuaian, serta mengakses informasi penting
          terkait dana PIP dengan cepat dan praktis.
        </p>
      </div>
      <div class="intro-image">
        <img src="../img/pip-cartoon.jpeg" alt="Ilustrasi Dashboard PIPGuard" />
      </div>
    </section>

    <!-- Carousel gambar + deskripsi -->
    <!-- Carousel gambar + deskripsi -->
<div class="carousel-container" aria-label="Pengumuman penting">
  <button class="carousel-btn prev" aria-label="Sebelumnya">&#10094;</button>
  <div class="carousel-slide">
    <div class="carousel-item">
      <img src="../img/gambar1.webp" alt="Pencairan Dana Semester 2-2025" />
      <p>Pengumuman pencairan dana semester 2-2025 sudah dimulai</p>
    </div>
    <div class="carousel-item">
      <img src="../img/gambar2.jpg" alt="Tips Penggunaan Dana" />
      <p>Tips penggunaan dana bantuan dengan bijak</p>
    </div>
    <div class="carousel-item">
      <img src="../img/gambar3.jpg" alt="Laporan Ketidaksesuaian" />
      <p>Mulai Laporkan Jika ada ketidaksesuaian dana anda</p>
    </div>
  </div>
  <button class="carousel-btn next" aria-label="Berikutnya">&#10095;</button>
</div>


    <!-- Aktivitas terbaru -->
    <section class="recent-activity">
      <h3>Aktivitas Terbaru</h3>
      <ul class="timeline-list">
        <li><strong>5 Juli 2025:</strong> Pengajuan dokumen lengkap diterima</li>
        <li><strong>12 Juli 2025:</strong> Dana mulai diproses oleh sekolah</li>
        <li><strong>20 Juli 2025:</strong> Dana sudah dikirim ke rekening</li>
      </ul>
    </section>

  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <script>
    function logout() {
      alert("Anda telah logout.");
      location.href = "../index.html";
    }

    const slide = document.querySelector('.carousel-slide');
    const items = document.querySelectorAll('.carousel-item');
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    let index = 0;

    function showSlide(i) {
      index = (i + items.length) % items.length;
      slide.style.transform = `translateX(-${index * 100}%)`;
    }

    prevBtn.addEventListener('click', () => showSlide(index - 1));
    nextBtn.addEventListener('click', () => showSlide(index + 1));

    setInterval(() => showSlide(index + 1), 5000);
    showSlide(index);
  </script>

  <footer class="footer-info">
    <p>&copy; 2025 PIPGuard. Semua hak dilindungi.
    </p>
  </footer>

</body>
</html>
