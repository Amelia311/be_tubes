<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Daftar Siswa</title>
  <link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_daftar_siswa.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>Dashboard</h2>
      <nav>
        <ul>
          <li><a href="{{ url('/dashboard/sekolah/daftar-siswa') }}" class="active"><i class="fas fa-users"></i> Daftar Siswa</a></li>
          <li><a href="{{ url('/dashboard/sekolah/input') }}"><i class="fas fa-money-bill-wave"></i> Input Pencairan</a></li>
          <li><a href="{{ url('/dashboard/sekolah/konfirmasi') }}"><i class="fas fa-check-circle"></i> Konfirmasi & Catat Blockchain</a></li>
          <li><a href="{{ url('/dashboard/sekolah/riwayat') }}"><i class="fas fa-history"></i> Riwayat Pencairan</a></li>
          <li><a href="#"><i class="fas fa-globe"></i> Transparansi Umum</a></li>
        </ul>
      </nav>
      <div class="logout">
        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </aside>

    <main class="main-content">
      <header class="topbar">
        <h3>Admin Sekolah</h3>
      </header>

      <section class="content-box">
        <div class="header-table">
          <h3>Daftar Siswa</h3>
          <div class="actions">
            <form method="GET" action="{{ route('siswa.index') }}" class="actions">
              <input type="text" name="cari" placeholder="Cari nama siswa..." value="{{ request('cari') }}">
              <button type="submit" class="btn-tambah"><i class="fas fa-search"></i> Cari</button>
            </form>
            <a href="{{ route('siswa.create') }}" class="btn-tambah"><i class="fas fa-plus"></i> Tambah Siswa</a>
          </div>
        </div>

        @if(session('success'))
          <div style="background-color: #22c55e; color: white; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
            {{ session('success') }}
          </div>
        @endif

        <table class="table-siswa">
          <thead>
            <tr>
              <th>NO</th>
              <th>NAMA SISWA</th>
              <th>NISN</th>
              <th>ASAL SEKOLAH</th>
              <th>ALAMAT</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
          @forelse ($siswa as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->nisn }}</td>
              <td>{{ $item->asal_sekolah }}</td>
              <td>{{ $item->alamat }}</td>
              <td>
                <a href="{{ route('siswa.edit', $item->id) }}"><i class="fas fa-pen action-icon"></i></a>
                <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Yakin ingin menghapus siswa ini?')" style="background: none; border: none;">
                    <i class="fas fa-trash action-icon"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6">Belum ada data siswa atau hasil pencarian tidak ditemukan.</td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>
</html>
