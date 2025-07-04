<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Siswa - PIPGuard</title>
  <link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <header>
    <div class="logo-header">
      <img src="{{ asset('img/logo.png') }}" alt="Logo PIPGuard" />
      <h1>PIPGuard</h1>
    </div>
    <nav class="menu-nav">
      <a href="{{ route('siswa.dashboard') }}"><i class="fas fa-info-circle"></i>Detail</a>
      <a href="{{ route('siswa.riwayat') }}"><i class="fas fa-exclamation-triangle"></i>Laporan</a>
      <a href="#transparansi"><i class="fas fa-chart-pie"></i>Transparansi</a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
      </form>

    </nav>
  </header>

  <main class="container">
    <section id="status-dana" class="content-section active">
      <h2>Status Terkini</h2>

      <div class="status-progress">
        <div class="status-step" id="step-belum"><div class="circle"></div><p>Belum Dicairkan</p></div>
        <div class="status-step" id="step-proses"><div class="circle"></div><p>Dalam Proses</p></div>
        <div class="status-step" id="step-sudah"><div class="circle"></div><p>Sudah Cair</p></div>
      </div>

      <p class="status-info" id="status-text">Memuat status dana...</p>

      <div class="periode-info">
        <strong>Periode Pencairan:</strong> Januari - Juni 2025
      </div>

      <div class="kelas-select">
        <label for="kelas-dropdown"><strong>Pilih Kelas:</strong></label>
        <select id="kelas-dropdown">
          <option value="X">Kelas X</option>
          <option value="XI" selected>Kelas XI</option>
          <option value="XII">Kelas XII</option>
        </select>
      </div>

      <table class="data-table">
        <thead>
          <tr>
            <th>Periode</th>
            <th>Status</th>
            <th>Nominal</th>
            <th>Tanggal Pencairan</th>
            <th>Blockchain TX</th>
          </tr>
        </thead>
        <tbody>
@forelse($pencairan_riwayat as $item)
<tr>
    <td>{{ $item->periode }}</td>
    <td>{{ $item->status }}</td>
    <td>{{ number_format($item->jumlah) }}</td>
    <td>{{ $item->tanggal_cair }}</td>
    <td>{{ $item->blockchain_tx ?? '-' }}</td>
</tr>
@empty
<tr><td colspan="5">Belum ada data pencairan</td></tr>
@endforelse
</tbody>
      </table>
    </section>


    <section id="transparansi" class="content-section">
      <h2>Statistik Dana PIP</h2>
      <div class="cards">
        <div class="card"><i class="fas fa-money-bill-wave"></i><div class="content"><div class="label">Total Dana Cair</div><div class="value">2.500.000.000</div></div></div>
        <div class="card"><i class="fas fa-user-friends"></i><div class="content"><div class="label">Jumlah Penerima</div><div class="value">5.000 siswa</div></div></div>
        <div class="card"><i class="fas fa-calendar-alt"></i><div class="content"><div class="label">Periode Terbaru</div><div class="value">Semester 1-2025</div></div></div>
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
          <li><a href="#">Laporan Pencairan Semester 2 Tahun 2024</a></li>
          <li><a href="#">Ringkasan Audit Keuangan PIP Tahun 2024</a></li>
        </ul>
      </div>

      <div class="footer-info">
        Info lebih lanjut kunjungi situs resmi <a href="https://pip.kemendikdasmen.go.id" target="_blank">pip.kemendikdasmen.go.id</a>
      </div>
    </section>
  </main>

  <script src="{{ asset('js/dashboard_siswa.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
