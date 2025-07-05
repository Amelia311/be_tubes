<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Transparansi Dana - PIPGuard</title>
  <link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body>


  <main class="container">
    <section id="transparansi" class="content-section active">
      <h2>Statistik Dana PIP</h2>

      <div class="cards">
        <div class="card">
          <i class="fas fa-money-bill-wave"></i>
          <div class="content">
            <div class="label">Total Dana Cair</div>
            <div class="value">{{ number_format($totalDana, 0, ',', '.') }}</div>
          </div>
        </div>
        <div class="card">
          <i class="fas fa-user-friends"></i>
          <div class="content">
            <div class="label">Jumlah Penerima</div>
            <div class="value">{{ $jumlahPenerima }} siswa</div>
          </div>
        </div>
        <div class="card">
          <i class="fas fa-calendar-alt"></i>
          <div class="content">
            <div class="label">Periode Terbaru</div>
            <div class="value">{{ $periodeTerbaru ?? 'Belum ada' }}</div>
          </div>
        </div>
      </div>

      <div class="recent-activity">
        <h3 class="section-title">🔔 Info Terbaru Pencairan Dana</h3>
        <div class="notification-box">
          @forelse($infoTerbaru as $info)
            <p><strong>{{ $info->siswa->nama ?? 'N/A' }}</strong> telah berhasil mencairkan dana PIP pada {{ \Carbon\Carbon::parse($info->tanggal_cair)->format('d M Y') }}.</p>
          @empty
            <p>Belum ada pencairan terbaru.</p>
          @endforelse
        </div>
      </div>

      <div class="report-section">
        <h3 class="section-title">📢 Laporan Ketidaksesuaian Dana dari Siswa</h3>
        <ul class="report-list">
          @forelse($laporan as $lapor)
            <li><strong>Anonim - {{ $lapor->pencairan->siswa->asal_sekolah ?? 'Tidak diketahui' }}:</strong> “{{ $lapor->pesan }}”</li>
          @empty
            <li>Belum ada laporan dari siswa.</li>
          @endforelse
        </ul>
      </div>

      <div class="footer-info">
        Info lebih lanjut kunjungi situs resmi 
        <a href="https://pip.kemendikdasmen.go.id" target="_blank" rel="noopener noreferrer">pip.kemendikdasmen.go.id</a>
      </div>
    </section>
  </main>
</body>
</html>
