<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Transparansi Dana - PIPGuard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --success-color: #4cc9f0;
      --warning-color: #f8961e;
      --danger-color: #f72585;
      --bg-color: #f8f9fa;
      --card-color: #ffffff;
      --text-color: #2b2d42;
      --text-light: #8d99ae;
    }
    
    body {
      background-color: var(--bg-color);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--text-color);
    }
    
    .hero-section {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border-radius: 15px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .stat-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-bottom: 3rem;
    }
    
    .stat-card {
      background: var(--card-color);
      border-radius: 15px;
      padding: 1.5rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      border: none;
      display: flex;
      align-items: center;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: rgba(67, 97, 238, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1.5rem;
      font-size: 1.5rem;
      color: var(--primary-color);
    }
    
    .stat-label {
      font-size: 0.9rem;
      color: var(--text-light);
      margin-bottom: 0.3rem;
    }
    
    .stat-value {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text-color);
    }
    
    .section-title {
      position: relative;
      padding-bottom: 0.8rem;
      margin-bottom: 1.5rem;
      color: var(--primary-color);
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 3px;
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
      border-radius: 3px;
    }
    
    .notification-box {
      background: var(--card-color);
      border-radius: 15px;
      padding: 1.5rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 2rem;
    }
    
    .notification-item {
      padding: 1rem 0;
      border-bottom: 1px solid #f0f0f0;
      display: flex;
      align-items: center;
    }
    
    .notification-item:last-child {
      border-bottom: none;
    }
    
    .notification-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(76, 201, 240, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      color: var(--success-color);
    }
    
    .report-section {
      background: var(--card-color);
      border-radius: 15px;
      padding: 1.5rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 2rem;
    }
    
    .report-item {
      padding: 1.5rem;
      border-radius: 10px;
      background: #f8f9fa;
      margin-bottom: 1.5rem;
      border-left: 4px solid var(--danger-color);
    }
    
    .report-header {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }
    
    .report-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(247, 37, 133, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      color: var(--danger-color);
    }
    
    .report-content {
      flex: 1;
    }
    
    .report-author {
      font-weight: 600;
      margin-bottom: 0.3rem;
    }
    
    .report-message {
      color: var(--text-color);
      margin-bottom: 1rem;
    }
    
    .report-proof {
      margin-top: 1rem;
      border-radius: 8px;
      overflow: hidden;
      max-width: 300px;
    }
    
    .report-proof img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      cursor: pointer;
      transition: transform 0.3s;
    }
    
    .report-proof img:hover {
      transform: scale(1.03);
    }
    
    .report-tx {
      font-size: 0.8rem;
      color: var(--text-light);
      margin-top: 0.5rem;
    }
    
    .footer-info {
      text-align: center;
      padding: 1.5rem;
      color: var(--text-light);
      font-size: 0.9rem;
    }
    
    .footer-info a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
    }
    
    .footer-info a:hover {
      text-decoration: underline;
    }
    
    /* Modal untuk preview gambar */
    .proof-modal .modal-content {
      border-radius: 15px;
      overflow: hidden;
    }
    
    .proof-modal .modal-body {
      padding: 0;
    }
    
    .proof-modal img {
      width: 100%;
      height: auto;
    }
    
    /* Animations */
    .animate-delay-1 { animation-delay: 0.2s; }
    .animate-delay-2 { animation-delay: 0.4s; }
    .animate-delay-3 { animation-delay: 0.6s; }
  </style>
</head>
<body>
  <main class="container py-4">
    <div class="hero-section animate__animated animate__fadeIn">
      <h1 class="display-5 fw-bold mb-3">Transparansi Dana PIP</h1>
      <p class="lead">Platform transparansi pencairan dana Bantuan Indonesia Pintar</p>
    </div>

    <!-- Statistik Cards -->
    <div class="stat-cards">
      <div class="stat-card animate__animated animate__fadeInLeft">
        <div class="stat-icon">
          <i class="fas fa-money-bill-wave"></i>
        </div>
        <div>
          <div class="stat-label">Total Dana Cair</div>
          <div class="stat-value">Rp{{ number_format($totalDana, 0, ',', '.') }}</div>
        </div>
      </div>
      
      <div class="stat-card animate__animated animate__fadeIn animate-delay-1">
        <div class="stat-icon">
          <i class="fas fa-user-friends"></i>
        </div>
        <div>
          <div class="stat-label">Jumlah Penerima</div>
          <div class="stat-value">{{ $jumlahPenerima }} siswa</div>
        </div>
      </div>
      
      <div class="stat-card animate__animated animate__fadeInRight animate-delay-2">
        <div class="stat-icon">
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div>
          <div class="stat-label">Periode Terbaru</div>
          <div class="stat-value">{{ $periodeTerbaru ?? 'Belum ada' }}</div>
        </div>
      </div>
    </div>

    <!-- Info Pencairan Terbaru -->
    <div class="notification-box animate__animated animate__fadeIn animate-delay-1">
      <h3 class="section-title">
        <i class="fas fa-bell me-2"></i> Info Terbaru Pencairan Dana
      </h3>
      
      @forelse($infoTerbaru as $info)
        <div class="notification-item">
          <div class="notification-icon">
            <i class="fas fa-check-circle"></i>
          </div>
          <div>
            <strong>{{ $info->siswa->nama ?? 'N/A' }}</strong> telah berhasil mencairkan dana PIP pada 
            {{ \Carbon\Carbon::parse($info->tanggal_cair)->format('d M Y') }}.
          </div>
        </div>
      @empty
        <div class="text-center py-3 text-muted">
          <i class="fas fa-inbox me-2"></i> Belum ada pencairan terbaru
        </div>
      @endforelse
    </div>

    <!-- Laporan Ketidaksesuaian -->
    <div class="report-section animate__animated animate__fadeIn animate-delay-2">
      <h3 class="section-title">
        <i class="fas fa-exclamation-triangle me-2"></i> Laporan Ketidaksesuaian Dana
      </h3>
      
      @forelse($laporan as $lapor)
        <div class="report-item">
          <div class="report-header">
            <div class="report-avatar">
              <i class="fas fa-user"></i>
            </div>
            <div class="report-content">
              <div class="report-author">{{ $lapor->pencairan->siswa->nama ?? 'Tidak diketahui' }}</div>
              <div class="report-message">"{{ $lapor->pesan }}"</div>
              
              @if($lapor->bukti)
                <div class="report-proof">
                  <img src="{{ asset('storage/' . $lapor->bukti) }}" 
                       alt="Bukti Laporan" 
                       data-bs-toggle="modal" 
                       data-bs-target="#proofModal"
                       data-bs-image="{{ asset('storage/' . $lapor->bukti) }}">
                </div>
              @endif
              
              <div class="report-tx">
                <i class="fas fa-link me-1"></i> TX: {{ $lapor->blockchain_tx }}
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="text-center py-4 text-muted">
          <i class="fas fa-check-circle me-2"></i> Tidak ada laporan ketidaksesuaian
        </div>
      @endforelse
    </div>

    <div class="footer-info animate__animated animate__fadeIn animate-delay-3">
      Info lebih lanjut kunjungi situs resmi 
      <a href="https://pip.kemendikdasmen.go.id" target="_blank" rel="noopener noreferrer">pip.kemendikdasmen.go.id</a>
    </div>
  </main>

  <!-- Modal untuk Preview Gambar -->
  <div class="modal fade proof-modal" id="proofModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <img id="modalProofImage" src="" alt="Bukti Laporan">
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script>
    // Inisialisasi modal preview gambar
    const proofModal = document.getElementById('proofModal');
    if (proofModal) {
      proofModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const imageUrl = button.getAttribute('data-bs-image');
        const modalImage = proofModal.querySelector('#modalProofImage');
        modalImage.src = imageUrl;
      });
    }
    
    // Animasi saat elemen muncul di viewport
    document.addEventListener('DOMContentLoaded', function() {
      const animateElements = document.querySelectorAll('.animate__animated');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const animation = entry.target.getAttribute('class').match(/animate__\w+/)[0];
            entry.target.classList.add(animation);
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });
      
      animateElements.forEach(el => observer.observe(el));
    });
  </script>
</body>
</html>