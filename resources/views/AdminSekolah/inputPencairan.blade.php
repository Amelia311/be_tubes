<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Input Pencairan</title>
  <link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_input.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>Dashboard</h2>
      <nav>
        <ul>
          <li><a href="{{ route('admin.daftarSiswa') }}"><i class="fas fa-users"></i> Daftar Siswa</a></li>
          <li><a href="{{ route('pencairan.create') }}"><i class="fas fa-money-bill-wave"></i> Input Pencairan</a></li>
          <li><a href="{{ route('konfirmasi.index') }}"><i class="fas fa-check-circle"></i> Konfirmasi & Catat Blockchain</a></li>
          <li><a href="/dashboard/sekolah/riwayat"><i class="fas fa-history"></i> Riwayat Pencairan</a></li>
          <li><a href="#"><i class="fas fa-globe"></i> Transparansi Umum</a></li>
        </ul>
      </nav>
      <div class="logout">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </aside>

    <main class="main-content">
      <header class="topbar">
        <h3>Admin Sekolah</h3>
      </header>

      <section class="content-box">
        <div class="form-container">
          <h3>Input Pencairan</h3>

          @if (session('success'))
            <div style="background: #22c55e; padding: 10px; border-radius: 6px; margin-bottom: 10px; color: white;">
              {{ session('success') }}
            </div>
          @endif

          <form method="POST" action="{{ route('pencairan.store') }}">
            @csrf

            <label for="siswa_id">Pilih Siswa</label>
            <select id="siswa_id" name="siswa_id" required>
              <option value="">-- Pilih Siswa --</option>
              @foreach ($siswa as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
              @endforeach
            </select>

            <label for="tanggal_cair">Tanggal Cair</label>
            <input type="date" id="tanggal_cair" name="tanggal_cair" required />

            <label for="jumlah">Jumlah yang Diterima</label>
            <input type="text" id="jumlah" name="jumlah" placeholder="Contoh: 500000" required />

            <label for="keterangan">Keterangan</label>
            <input type="text" id="keterangan" name="keterangan" placeholder="Contoh: Tahap 1" required />

            <button type="submit">Simpan</button>
          </form>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
