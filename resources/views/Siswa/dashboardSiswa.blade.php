@extends('Siswa.layouts.siswa')

@section('title', 'Dashboard - PIPGuard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}">
@endpush

@section('content')
<section class="intro-section">
  <div class="intro-text">
    <h2>Apa itu PIPGuard?</h2>
    <p>
      PIPGuard adalah platform transparansi dan monitoring pencairan dana Bantuan
      Indonesia Pintar (PIP) yang dirancang untuk membantu siswa memantau status
      bantuan secara mudah dan aman...
    </p>
  </div>
  <div class="intro-image">
    <img src="{{ asset('storage/img/pip.jpg') }}" alt="Ilustrasi Dashboard PIPGuard" />
  </div>
</section>

<div class="carousel-container" aria-label="Pengumuman penting">
  <button class="carousel-btn prev" aria-label="Sebelumnya">&#10094;</button>
  <div class="carousel-slide">
    <div class="carousel-item">
      <img src="{{ asset('storage/img/gambar1.webp') }}" alt="Pencairan Dana Semester 2-2025" />
      <p>Pengumuman pencairan dana semester 2-2025 sudah dimulai</p>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('storage/img/gambar2.jpg') }}" alt="Tips Penggunaan Dana" />
      <p>Tips penggunaan dana bantuan dengan bijak</p>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('storage/img/gambar3.jpg') }}" alt="Laporan Ketidaksesuaian" />
      <p>Mulai Laporkan Jika ada ketidaksesuaian dana anda</p>
    </div>
  </div>
  <button class="carousel-btn next" aria-label="Berikutnya">&#10095;</button>
</div>

<section class="recent-activity">
  <h3>Aktivitas Terbaru</h3>
  <ul class="timeline-list">
    @forelse ($pencairan_riwayat as $item)
      <li>
        <strong>{{ \Carbon\Carbon::parse($item->tanggal_cair)->format('d M Y') }}:</strong>
        Dana sejumlah <strong>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</strong> 
        ({{ $item->status }})
      </li>
    @empty
      <li>Tidak ada riwayat pencairan dana.</li>
    @endforelse
  </ul>
</section>
@endsection

@push('scripts')
<script>
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
@endpush
