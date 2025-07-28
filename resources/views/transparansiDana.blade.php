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
    
    /* Notification Items */
    /* Enhanced Notification Items */
.notification-item {
    padding: 1.5rem;
    border-radius: 12px;
    background: var(--card-color);
    margin-bottom: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: flex-start;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    border-left: 4px solid var(--success-color);
    position: relative;
    overflow: hidden;
}

.notification-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(74, 214, 109, 0.03), transparent);
    z-index: 0;
    opacity: 0;
    transition: opacity 0.3s;
}

.notification-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    background: var(--card-color);
}

.notification-item:hover::before {
    opacity: 1;
}

.notification-icon {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    background: linear-gradient(135deg, rgba(74, 214, 109, 0.1), rgba(76, 201, 240, 0.1));
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1.5rem;
    color: var(--success-color);
    font-size: 1.4rem;
    flex-shrink: 0;
    box-shadow: 0 5px 15px rgba(74, 214, 109, 0.1);
    position: relative;
    z-index: 1;
}

.notification-content {
    flex: 1;
    position: relative;
    z-index: 1;
}

.notification-text {
    margin-bottom: 0.5rem;
    font-size: 1rem;
    line-height: 1.5;
    color: var(--text-color);
}

.notification-text strong {
    color: var(--primary-color);
    font-weight: 600;
}

.notification-time {
    font-size: 0.85rem;
    color: var(--text-light);
    display: flex;
    align-items: center;
    margin-top: 0.5rem;
}

.notification-time i {
    margin-right: 0.5rem;
    color: var(--primary-light);
}

/* Empty State Enhancement */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    background: rgba(67, 97, 238, 0.03);
    border-radius: 12px;
    margin: 1rem 0;
    border: 1px dashed rgba(67, 97, 238, 0.1);
}

.empty-state i {
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
    color: var(--primary-light);
    opacity: 0.7;
    animation: pulse 2s infinite;
}

.empty-state p {
    color: var(--text-light);
    font-size: 1.1rem;
    margin: 0;
    font-weight: 500;
}

/* Animation for notification items */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.notification-item {
    animation: slideIn 0.5s ease-out forwards;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .notification-item {
        flex-direction: column;
        padding: 1.2rem;
    }
    
    .notification-icon {
        margin-right: 0;
        margin-bottom: 1rem;
        width: 48px;
        height: 48px;
        font-size: 1.2rem;
    }
    
    .notification-text {
        font-size: 0.95rem;
    }
    
    .empty-state {
        padding: 2rem 1rem;
    }
    
    .empty-state i {
        font-size: 2.5rem;
    }
}
    /* Report Items */
    .report-item {
      padding: 1.5rem;
      border-radius: 12px;
      background: #f8f9fa;
      margin-bottom: 1.5rem;
      border-left: 4px solid var(--danger-color);
      transition: all 0.3s;
    }
    
    .report-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .report-header {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }
    
    .report-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: rgba(247, 37, 133, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1.2rem;
      color: var(--danger-color);
      font-size: 1.2rem;
      flex-shrink: 0;
    }
    
    .report-content {
      flex: 1;
    }
    
    .report-author {
      font-weight: 700;
      margin-bottom: 0.3rem;
      color: var(--text-color);
    }
    
    .report-message {
      color: var(--text-color);
      margin-bottom: 1rem;
      font-style: italic;
    }
    
    .report-proof {
      margin-top: 1rem;
      border-radius: 10px;
      overflow: hidden;
      max-width: 300px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s;
    }
    
    .report-proof img {
      width: 100%;
      height: auto;
      border-radius: 10px;
      cursor: pointer;
      transition: transform 0.3s;
    }
    
    .report-proof:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .report-proof img:hover {
      transform: scale(1.02);
    }
    
    .report-tx {
      font-size: 0.8rem;
      color: var(--text-light);
      margin-top: 0.8rem;
      display: flex;
      align-items: center;
    }
    
    .report-tx a {
      color: var(--primary-color);
      text-decoration: none;
      margin-left: 0.3rem;
    }
    
    .report-tx a:hover {
      text-decoration: underline;
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
    }
    .table {
  --bs-table-bg: var(--card-color);
  --bs-table-striped-bg: rgba(67, 97, 238, 0.03);
  --bs-table-hover-bg: rgba(67, 97, 238, 0.05);
  border-radius: 10px;
  overflow: hidden;
}

.table thead th {
  background-color: var(--primary-color);
  color: white;
  border-bottom: none;
  font-weight: 600;
}

.table > :not(:first-child) {
  border-top: none;
}

.table-hover > tbody > tr:hover {
  transform: translateX(5px);
  transition: all 0.3s;
}
/* Tombol Kembali Bulat */
.btn-back-circle {
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: var(--card-color);
  color: var(--primary-color);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  border: 2px solid var(--primary-color);
  font-size: 1.2rem;
}
/* Enhanced Laporan Ketidaksesuaian Table */
.section-container {
    background: var(--card-color);
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 2rem;
    transition: all 0.3s ease;
}

.section-container:hover {
    box-shadow: 0 15px 35px rgba(67, 97, 238, 0.15);
}

.section-title {
    color: var(--primary-color);
    font-weight: 700;
    display: flex;
    align-items: center;
    padding-bottom: 0.5rem;
    border-bottom: 3px solid rgba(67, 97, 238, 0.2);
}

.section-title i {
    margin-right: 10px;
    font-size: 1.5rem;
    color: var(--warning-color);
}

.table-responsive {
    border-radius: 12px;
    overflow: hidden;
}

.table {
    --bs-table-bg: transparent;
    --bs-table-striped-bg: rgba(67, 97, 238, 0.03);
    --bs-table-hover-bg: rgba(67, 97, 238, 0.05);
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    font-weight: 600;
    padding: 1rem 1.25rem;
    border: none;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table tbody td {
    padding: 1.25rem;
    vertical-align: middle;
    border-bottom: 1px solid rgba(0, 0, 0, 0.03);
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.table-hover > tbody > tr:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(67, 97, 238, 0.1);
}

/* Enhanced Table Cells */
.table tbody td:first-child {
    font-weight: 600;
    color: var(--primary-color);
}

.table tbody td:nth-child(2) {
    font-weight: 500;
}

.table tbody td:nth-child(3) {
    position: relative;
    padding-left: 1.5rem;
}

.table tbody td:nth-child(3)::before {
    content: '"';
    position: absolute;
    left: 0.5rem;
    top: 1rem;
    font-size: 1.5rem;
    color: var(--text-light);
    opacity: 0.5;
}

/* Button Enhancements */
.btn-outline-primary, .btn-outline-info {
    border-width: 2px;
    font-weight: 500;
    padding: 0.375rem 0.75rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-primary:hover {
    background: var(--primary-color);
    color: white;
}

.btn-outline-info {
    color: var(--primary-light);
    border-color: var(--primary-light);
}

.btn-outline-info:hover {
    background: var(--primary-light);
    color: white;
}

/* Empty State Enhancement */
.table tbody .empty-state-cell {
    padding: 3rem;
    text-align: center;
    background: rgba(67, 97, 238, 0.03);
}

.empty-state-cell i {
    font-size: 2.5rem;
    color: var(--primary-light);
    margin-bottom: 1rem;
    opacity: 0.7;
}

.empty-state-cell p {
    color: var(--text-light);
    font-size: 1.1rem;
    margin: 0;
    font-weight: 500;
}

/* Animation */
@keyframes fadeInRow {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table tbody tr {
    animation: fadeInRow 0.5s ease-out forwards;
}

/* Responsive */
@media (max-width: 768px) {
    .section-container {
        padding: 1.5rem;
    }
    
    .table thead th {
        padding: 0.75rem;
        font-size: 0.8rem;
    }
    
    .table tbody td {
        padding: 0.75rem;
    }
    
    .btn-outline-primary, .btn-outline-info {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }
    
    .empty-state-cell {
        padding: 2rem 1rem !important;
    }
}

.btn-back-circle:hover {
  background: var(--primary-color);
  color: white;
  transform: translateX(-3px);
  box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
}

/* Untuk posisi di mobile */
@media (max-width: 768px) {
  .position-absolute {
    position: relative !important;
    margin-bottom: 1rem;
    margin-left: 0 !important;
  }
  
  .btn-back-circle {
    width: 45px;
    height: 45px;
    font-size: 1rem;
  }
}
.btn-back-icon {
  display: inline-block;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  color: #4361ee;
  background: rgba(67, 97, 238, 0.1);
  text-align: center;
  line-height: 40px;
  transition: all 0.3s ease;
  text-decoration: none !important;
  border: none !important; /* Pastikan tidak ada border */
}

.btn-back-icon:hover {
  background: rgba(67, 97, 238, 0.2);
  transform: translateX(-3px);
  color: #3a56c9;
}

.btn-back-icon i {
  font-size: 1.2rem;
  vertical-align: middle;
}
  </style>
</head>
<body>
<div class="container pt-3">
  <a href="{{ route('siswa.dashboard') }}" class="btn-back-icon animate_animated animate_fadeInLeft">
    <i class="fas fa-arrow-left"></i>
  </a>
</div>
  <main class="container py-4">
    <!-- Hero Section -->
    <div class="hero-section animate_animated animate_fadeIn">
      <div class="particles" id="particles"></div>
      <h1 class="hero-title animate_animated animate_fadeInDown">Transparansi Dana Program Indonesia Pintar SMK Mashalihul Murshalat</h1>
      <p class="hero-subtitle animate_animated animate_fadeIn animate-delay-1">
        Platform transparansi pencairan dana Bantuan Indonesia Pintar berbasis blockchain
      </p>
    </div>

    <!-- Statistik Cards -->
    <div class="stat-cards">
      <div class="stat-card animate_animated animate_fadeInLeft">
        <div class="stat-icon animate_animated animate_bounceIn animate-delay-1">
          <i class="fas fa-money-bill-wave animate-float"></i>
        </div>
        <div>
          <div class="stat-label">Total Dana</div>
          <div class="stat-value animate_animated animate_fadeIn animate-delay-2">Rp{{ number_format($totalDana, 0, ',', '.') }}</div>
          <div class="stat-desc">Total dana Diterima SIswa</div>
        </div>
      </div>
      
      <div class="stat-card animate_animated animate_fadeIn animate-delay-1">
        <div class="stat-icon animate_animated animate_bounceIn animate-delay-2">
          <i class="fas fa-user-friends animate-pulse"></i>
        </div>
        <div>
          <div class="stat-label">Jumlah Penerima</div>
          <div class="stat-value animate_animated animate_fadeIn animate-delay-3">{{ $jumlahPenerima }} siswa</div>
          <div class="stat-desc">Siswa penerima manfaat PIP</div>
        </div>
      </div>
      
      <div class="stat-card animate_animated animate_fadeInRight animate-delay-2">
        <div class="stat-icon animate_animated animate_bounceIn animate-delay-3">
          <i class="fas fa-calendar-alt animate-float"></i>
        </div>
        <div>
          <div class="stat-label">Semester</div>
          <div class="stat-value animate_animated animate_fadeIn animate-delay-4">{{ $SemesterTerbaru ?? 'Belum ada' }}</div>
          <div class="stat-desc">Semester penarikan</div>
        </div>
      </div>
    </div>

    <!-- Info Pencairan Terbaru -->
    <div class="section-container animate__animated animate__fadeIn animate-delay-1">
      <h3 class="section-title">
        <i class="fas fa-bell"></i> Info Terbaru Pencairan Dana
      </h3>
      
      @forelse($infoTerbaru as $info)
        <div class="notification-item animate__animated animate__fadeIn">
          <div class="notification-icon">
            <i class="fas fa-check-circle"></i>
          </div>
          <div class="notification-content">
            <div class="notification-text">
              <strong>{{ $info->siswa->nama ?? 'N/A' }}</strong> telah berhasil mencairkan dana PIP sebesar 
              <strong>Rp{{ number_format($info->jumlah, 0, ',', '.') }}</strong>
            </div>
            <div class="notification-time">
              <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($info->tanggal_cair)->format('d M Y H:i') }}
            </div>
          </div>
        </div>
      @empty
        <div class="empty-state">
          <i class="fas fa-inbox"></i>
          <p>Belum ada pencairan terbaru</p>
        </div>
      @endforelse
    </div>

    <!-- Laporan Ketidaksesuaian -->
<div class="section-container animate_animated animate_fadeIn animate-delay-2">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="section-title">
      <i class="fas fa-exclamation-triangle"></i> Laporan Ketidaksesuaian
    </h3>
  </div>
  
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Nama Siswa</th>
          <th>Pesan</th>
          <th>Bukti</th>
          <th>Tindak Lanjut</th>
        </tr>
      </thead>
      <tbody>
        @forelse($laporan as $index => $lapor)
          <tr class="animate_animated animate_fadeIn">
            <td>{{ $index + 1 }}</td>
            <td>{{ $lapor->pencairan->siswa->nama ?? 'Tidak diketahui' }}</td>
            <td>"{{ $lapor->pesan }}"</td>
            <td>
              @if($lapor->bukti)
                <button class="btn btn-sm btn-outline-primary" 
                        data-bs-toggle="modal" 
                        data-bs-target="#proofModal"
                        data-bs-image="{{ asset('storage/' . $lapor->bukti) }}">
                  <i class="fas fa-image"></i> Lihat Bukti
                </button>
              @else
                <span class="text-muted">Tidak ada bukti</span>
              @endif
            </td>
            <td>
              <a href="https://sepolia.etherscan.io/tx/{{ $lapor->blockchain_tx }}" 
                 target="_blank" 
                 class="btn btn-sm btn-outline-info">
                <i class="fas fa-link"></i> Lihat TX
              </a>
            </td>
          </tr>
@empty
    <tr>
        <td colspan="5" class="empty-state-cell">
            <i class="fas fa-check-circle"></i>
            <p>Tidak ada laporan ketidaksesuaian</p>
        </td>
    </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

    <div class="footer-info animate_animated animate_fadeIn animate-delay-3">
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
        
        particle.style.width = ${size}px;
        particle.style.height = ${size}px;
        particle.style.left = ${posX}%;
        particle.style.top = ${posY}%;
        particle.style.animationDelay = ${delay}s;
        particle.style.animationDuration = ${duration}s;
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