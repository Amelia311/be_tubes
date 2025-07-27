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
      --primary-light: #4cc9f0;
      --secondary-color: #3f37c9;
      --success-color: #4ad66d;
      --warning-color: #f8961e;
      --danger-color: #f72585;
      --bg-color: #f8f9fa;
      --card-color: #ffffff;
      --text-color: #2b2d42;
      --text-light: #8d99ae;
    }
    
    body {
      background-color: var(--bg-color);
      font-family: 'Poppins', sans-serif;
      color: var(--text-color);
      overflow-x: hidden;
    }
    
    /* Hero Section */
    .hero-section {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border-radius: 15px;
      padding: 3rem 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 15px 35px rgba(67, 97, 238, 0.2);
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    
    .hero-section::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
      z-index: -1;
    }
    
    .hero-title {
      font-weight: 800;
      font-size: 2.5rem;
      margin-bottom: 1rem;
      text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .hero-subtitle {
      font-weight: 400;
      opacity: 0.9;
      max-width: 600px;
    }
    
    /* Floating Particles */
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }
    
    .particle {
      position: absolute;
      background: rgba(255,255,255,0.3);
      border-radius: 50%;
      animation: float 15s infinite linear;
    }
    
    @keyframes float {
      0% { transform: translateY(0) rotate(0deg); opacity: 1; }
      100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; }
    }
    
    /* Stat Cards */
    .stat-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
      margin-bottom: 3rem;
    }
    
    .stat-card {
      background: var(--card-color);
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      border: none;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    
    .stat-card::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
      transition: all 0.3s;
    }
    
    .stat-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card:hover::after {
      height: 10px;
    }
    
    .stat-icon {
      width: 70px;
      height: 70px;
      border-radius: 20px;
      background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(76, 201, 240, 0.1));
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.5rem;
      font-size: 1.8rem;
      color: var(--primary-color);
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.1);
    }
    
    .stat-label {
      font-size: 0.95rem;
      color: var(--text-light);
      margin-bottom: 0.5rem;
      font-weight: 500;
    }
    
    .stat-value {
      font-size: 2rem;
      font-weight: 800;
      color: var(--text-color);
      line-height: 1;
      margin-bottom: 0.5rem;
    }
    
    .stat-desc {
      font-size: 0.85rem;
      color: var(--text-light);
    }
    
    /* Section Styling */
    .section-container {
      background: var(--card-color);
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
      margin-bottom: 2rem;
      position: relative;
      overflow: hidden;
    }
    
    .section-title {
      position: relative;
      padding-bottom: 1rem;
      margin-bottom: 1.5rem;
      color: var(--primary-color);
      font-weight: 700;
      display: flex;
      align-items: center;
    }
    
    .section-title i {
      margin-right: 0.8rem;
      font-size: 1.4rem;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
      border-radius: 2px;
    }
    
    /* Custom Table Styling */
    .custom-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }
    
    .custom-table thead th {
      background-color: rgba(67, 97, 238, 0.1);
      color: var(--primary-color);
      font-weight: 600;
      border: none;
      padding: 1rem;
      position: sticky;
      top: 0;
    }
    
    .custom-table tbody tr {
      transition: all 0.3s;
    }
    
    .custom-table tbody tr:hover {
      background-color: rgba(67, 97, 238, 0.03);
      transform: translateX(5px);
    }
    
    .custom-table td {
      padding: 1rem;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      vertical-align: middle;
    }
    
    .custom-table tr:last-child td {
      border-bottom: none;
    }
    
    .status-badge {
      padding: 0.35rem 0.75rem;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    
    .badge-success {
      background-color: rgba(74, 214, 109, 0.1);
      color: var(--success-color);
    }
    
    .badge-warning {
      background-color: rgba(248, 150, 30, 0.1);
      color: var(--warning-color);
    }
    
    .badge-danger {
      background-color: rgba(247, 37, 133, 0.1);
      color: var(--danger-color);
    }
    
    .proof-thumbnail {
      width: 80px;
      height: 50px;
      border-radius: 5px;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.3s;
    }
    
    .proof-thumbnail:hover {
      transform: scale(1.05);
    }
    
    .tx-link {
      color: var(--primary-color);
      text-decoration: none;
      font-family: monospace;
      font-size: 0.85rem;
    }
    
    .tx-link:hover {
      text-decoration: underline;
      color: var(--secondary-color);
    }
    
    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 3rem 1rem;
      color: var(--text-light);
    }
    
    .empty-state i {
      font-size: 3rem;
      margin-bottom: 1rem;
      opacity: 0.5;
    }
    
    /* Footer */
    .footer-info {
      text-align: center;
      padding: 2rem;
      color: var(--text-light);
      font-size: 0.9rem;
    }
    
    .footer-info a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s;
    }
    
    .footer-info a:hover {
      color: var(--secondary-color);
      text-decoration: underline;
    }
    
    /* Modal Styling */
    .proof-modal .modal-content {
      border-radius: 15px;
      overflow: hidden;
      border: none;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }
    
    .proof-modal .modal-body {
      padding: 0;
    }
    
    .proof-modal img {
      width: 100%;
      height: auto;
    }
    
    /* Animations */
    .animate-delay-1 { animation-delay: 0.2s !important; }
    .animate-delay-2 { animation-delay: 0.4s !important; }
    .animate-delay-3 { animation-delay: 0.6s !important; }
    
    .animate-bounce {
      animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
      40% { transform: translateY(-20px); }
      60% { transform: translateY(-10px); }
    }
    
    .animate-pulse {
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    .animate-float {
      animation: float 6s ease-in-out infinite;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .stat-cards {
        grid-template-columns: 1fr;
      }
      
      .stat-card {
        padding: 1.5rem;
      }
      
      .section-container {
        padding: 1.5rem;
      }
      
      .custom-table {
        display: block;
        overflow-x: auto;
      }
    }
  </style>
</head>
<body>
  <main class="container py-4">
    <!-- Hero Section -->
    <div class="hero-section animate__animated animate__fadeIn">
      <div class="particles" id="particles"></div>
      <h1 class="hero-title animate__animated animate__fadeInDown">Transparansi Dana Program Indonesia Pintar SMK Mashalihul Murshalat</h1>
      <p class="hero-subtitle animate__animated animate__fadeIn animate-delay-1">
        Platform transparansi pencairan dana Bantuan Indonesia Pintar berbasis blockchain
      </p>
    </div>

    <!-- Statistik Cards -->
    <div class="stat-cards">
      <div class="stat-card animate__animated animate__fadeInLeft">
        <div class="stat-icon animate__animated animate__bounceIn animate-delay-1">
          <i class="fas fa-money-bill-wave animate-float"></i>
        </div>
        <div>
          <div class="stat-label">Total Dana</div>
          <div class="stat-value animate__animated animate__fadeIn animate-delay-2">Rp{{ number_format($totalDana, 0, ',', '.') }}</div>
          <div class="stat-desc">Total dana Diterima SIswa</div>
        </div>
      </div>
      
      <div class="stat-card animate__animated animate__fadeIn animate-delay-1">
        <div class="stat-icon animate__animated animate__bounceIn animate-delay-2">
          <i class="fas fa-user-friends animate-pulse"></i>
        </div>
        <div>
          <div class="stat-label">Jumlah Penerima</div>
          <div class="stat-value animate__animated animate__fadeIn animate-delay-3">{{ $jumlahPenerima }} siswa</div>
          <div class="stat-desc">Siswa penerima manfaat PIP</div>
        </div>
      </div>
      
      <div class="stat-card animate__animated animate__fadeInRight animate-delay-2">
        <div class="stat-icon animate__animated animate__bounceIn animate-delay-3">
          <i class="fas fa-calendar-alt animate-float"></i>
        </div>
        <div>
          <div class="stat-label">Semester</div>
          <div class="stat-value animate__animated animate__fadeIn animate-delay-4">{{ $SemesterTerbaru ?? 'Belum ada' }}</div>
          <div class="stat-desc">Semester penarikan</div>
        </div>
      </div>
    </div>

    <!-- Info Pencairan Terbaru -->
    <div class="section-container animate__animated animate__fadeIn animate-delay-1">
      <h3 class="section-title">
        <i class="fas fa-bell"></i> Info Terbaru Pencairan Dana
      </h3>
      
      <div class="table-responsive">
        <table class="custom-table">
          <thead>
            <tr>
              <th>Nama Siswa</th>
              <th>Jumlah</th>
              <th>Tanggal Cair</th>
              <th>Status</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            @forelse($infoTerbaru as $info)
              <tr class="animate__animated animate__fadeIn">
                <td>{{ $info->siswa->nama ?? 'N/A' }}</td>
                <td>Rp{{ number_format($info->jumlah, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($info->tanggal_cair)->format('d M Y H:i') }}</td>
                <td>
                  <span class="status-badge badge-success">
                    <i class="fas fa-check-circle me-1"></i> Berhasil
                  </span>
                </td>
                <td>
                  <a href="#" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-eye"></i> Detail
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5">
                  <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Belum ada pencairan terbaru</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Laporan Ketidaksesuaian -->
    <div class="section-container animate__animated animate__fadeIn animate-delay-2">
      <h3 class="section-title">
        <i class="fas fa-exclamation-triangle"></i> Laporan Ketidaksesuaian
      </h3>
      
      <div class="table-responsive">
        <table class="custom-table">
          <thead>
            <tr>
              <th>Pelapor</th>
              <th>Penerima</th>
              <th>Pesan</th>
              <th>Bukti</th>
              <th>Transaksi</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse($laporan as $lapor)
              <tr class="animate__animated animate__fadeIn">
                <td>{{ $lapor->pelapor->nama ?? 'Anonim' }}</td>
                <td>{{ $lapor->pencairan->siswa->nama ?? 'Tidak diketahui' }}</td>
                <td class="text-truncate" style="max-width: 200px;" title="{{ $lapor->pesan }}">
                  "{{ $lapor->pesan }}"
                </td>
                <td>
                  @if($lapor->bukti)
                    <img src="{{ asset('storage/' . $lapor->bukti) }}" 
                         class="proof-thumbnail"
                         alt="Bukti Laporan" 
                         data-bs-toggle="modal" 
                         data-bs-target="#proofModal"
                         data-bs-image="{{ asset('storage/' . $lapor->bukti) }}">
                  @else
                    <span class="text-muted">Tidak ada</span>
                  @endif
                </td>
                <td>
                  <a href="https://sepolia.etherscan.io/tx/{{ $lapor->blockchain_tx }}" 
                     target="_blank" 
                     class="tx-link">
                    <i class="fas fa-link me-1"></i> Lihat TX
                  </a>
                </td>
                <td>
                  <span class="status-badge badge-warning">
                    <i class="fas fa-exclamation-circle me-1"></i> Ditinjau
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <p>Tidak ada laporan ketidaksesuaian</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
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
    // Create floating particles
    function createParticles() {
      const container = document.getElementById('particles');
      const particleCount = 15;
      
      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        // Random properties
        const size = Math.random() * 10 + 5;
        const posX = Math.random() * 100;
        const posY = Math.random() * 100;
        const delay = Math.random() * 15;
        const duration = Math.random() * 10 + 10;
        const opacity = Math.random() * 0.5 + 0.1;
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${posX}%`;
        particle.style.top = `${posY}%`;
        particle.style.animationDelay = `${delay}s`;
        particle.style.animationDuration = `${duration}s`;
        particle.style.opacity = opacity;
        
        container.appendChild(particle);
      }
    }
    
    // Initialize modal preview
    const proofModal = document.getElementById('proofModal');
    if (proofModal) {
      proofModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const imageUrl = button.getAttribute('data-bs-image');
        const modalImage = proofModal.querySelector('#modalProofImage');
        modalImage.src = imageUrl;
      });
    }
    
    // Animate elements when they come into view
    document.addEventListener('DOMContentLoaded', function() {
      createParticles();
      
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