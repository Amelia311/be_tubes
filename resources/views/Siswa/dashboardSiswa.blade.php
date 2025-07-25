@extends('Siswa.layouts.siswa')

@section('title', 'Dashboard - PIPGuard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<style>
    :root {
        --primary-color: #3a7bd5;
        --secondary-color: #00d2ff;
        --accent-color: #4CAF50;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        position: relative;
        min-height: 280px;
    }
    .hero-content {
        padding: 2.5rem 3rem;
        position: relative;
        z-index: 2;
    }
    .hero-content h1 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 0.8rem;
    }
    .hero-content p {
        font-size: 1.125rem;
        line-height: 1.5;
    }
    .hero-image {
        position: absolute;
        right: 0;
        bottom: 0;
        height: 100%;
        opacity: 0.9;
        z-index: 1;
        max-width: 50%;
        overflow: hidden;
    }
    .hero-image img {
        height: 100%;
        object-fit: contain;
    }

    /* Announcement Carousel */
    .announcement-carousel {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        background: white;
    }
    .carousel-item {
        height: 250px;
        position: relative;
    }
    .carousel-item img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        filter: brightness(0.7);
    }
    .carousel-caption {
        bottom: 30%;
        text-align: left;
        left: 5%;
        right: 5%;
    }
    .carousel-control-prev, .carousel-control-next {
        width: 5%;
    }

    /* Activity Timeline */
    .activity-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 2rem;
    }
    .timeline {
        border-left: 3px solid var(--primary-color);
        padding-left: 1.5rem;
        margin-top: 1rem;
    }
    .timeline-item {
        position: relative;
        padding-left: 2.5rem;
        margin-bottom: 2rem;
    }
    .timeline-item::before {
        content: "";
        position: absolute;
        left: -14px;
        top: 3px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background-color: var(--primary-color);
        border: 3px solid white;
        box-shadow: 0 0 0 2px var(--primary-color);
    }
    .timeline-date {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.3rem;
    }
    .timeline-date i {
        font-size: 1.2rem;
    }
    .timeline-content {
        background: #f8f9fa;
        padding: 1rem 1.25rem;
        border-radius: 10px;
        font-size: 0.95rem;
        color: #212529;
    }
    .timeline-content small {
        color: #6c757d;
    }
    .timeline-content a {
        color: var(--primary-color);
        text-decoration: underline;
        cursor: pointer;
    }
    .timeline-content a:hover {
        color: var(--secondary-color);
        text-decoration: none;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <!-- Hero Section -->
    <section class="hero-section animate__animated animate__fadeIn">
        <div class="row h-100">
            <div class="col-md-6 d-flex align-items-center hero-content">
                <div>
                    <h1>Selamat datang di PIPGuard</h1>
                    <p>
                        Platform transparansi dan monitoring pencairan dana Bantuan Indonesia Pintar (PIP) yang dirancang untuk membantu siswa memantau status bantuan secara mudah dan aman.
                    </p>
                </div>
            </div>
            <div class="col-md-6 hero-image d-none d-md-block">
                <img src="{{ asset('img/pip.jpg') }}" alt="Ilustrasi PIPGuard Cartoon" class="floating">
            </div>
        </div>
    </section>

    <!-- Announcement Carousel -->
    <section class="announcement-carousel animate__animated animate__fadeIn animate__delay-1s">
        <div id="announcementCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/gambar1.webp') }}" alt="Pencairan Dana Semester 2-2025">
                    <div class="carousel-caption">
                        <h5>Pengumuman Penting</h5>
                        <p class="lead">Pencairan dana semester 2-2025 sudah dimulai</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/gambar2.jpg') }}" alt="Tips Penggunaan Dana">
                    <div class="carousel-caption">
                        <h5>Tips & Panduan</h5>
                        <p class="lead">Penggunaan dana bantuan dengan bijak</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/gambar3.jpg') }}" alt="Laporan Ketidaksesuaian">
                    <div class="carousel-caption">
                        <h5>Layanan Pengaduan</h5>
                        <p class="lead">Laporkan jika ada ketidaksesuaian dana anda</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#announcementCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#announcementCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

<!-- Recent Activity (Tabel Estetik + Kosong State) -->
<section class="activity-card animate__animated animate__fadeIn animate__delay-2s">
    <h3 class="mb-4"><i class="fas fa-history me-2"></i> Aktivitas Terbaru</h3>

    @php
        $validItems = $pencairan_riwayat->filter(function($item) {
            $status = strtolower($item->status);
            return in_array($status, ['ditarik', 'ditransfer', 'sk nominasi', 'sk pemerintah']);
        });
    @endphp

    @if($validItems->count() > 0)
    <div class="table-responsive">
        <table class="table table-borderless align-middle shadow-sm">
            <thead class="table-light">
                <tr>
                    <th style="min-width: 140px;">Tanggal</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($validItems as $item)
                @php
                    $status = strtolower($item->status);
                    $judul = match ($status) {
                        'ditarik' => 'Dana Berhasil Ditarik',
                        'ditransfer' => 'Dana Telah Ditransfer Pemerintah',
                        'sk nominasi' => 'SK Nominasi Penerima Bantuan',
                        'sk pemerintah' => 'SK Pemerintah Terbit',
                    };
                @endphp
                <tr class="align-middle">
                    <td>
                        <i class="far fa-calendar-alt me-1 text-primary"></i>
                        {{ \Carbon\Carbon::parse($item->tanggal_cair)->format('d M Y') }}
                    </td>
                    <td><strong>{{ $judul }}</strong></td>
                    <td>
                        @switch($status)
                            @case('ditarik')
                                Penarikan dana Anda telah berhasil dikonfirmasi dan pencairan selesai.
                                @break
                            @case('ditransfer')
                                Dana telah ditransfer oleh pemerintah ke rekening Anda. Silakan tarik dana melalui bank.
                                @break
                            @case('sk nominasi')
                                Anda masuk daftar nominasi penerima bantuan Indonesia Pintar.
                                @break
                            @case('sk pemerintah')
                                Surat Keputusan penerima bantuan telah diterbitkan pusat.
                                @break
                        @endswitch
                    </td>
                    <td>
                        @if(in_array($status, ['sk pemerintah', 'sk nominasi']))
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                {{ $status == 'sk nominasi' ? 'Unduh Disini' : 'Lihat Detail' }}
                            </a>
                        @else
                            <span class="badge bg-success text-capitalize">
                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center py-5 text-muted animate__animated animate__fadeIn">
        <i class="far fa-folder-open fa-4x mb-3"></i>
        <h5>Belum ada aktivitas terbaru</h5>
        <p>Riwayat aktivitas akan tampil di sini setelah ada pencairan atau pembaruan data.</p>
    </div>
    @endif
</section>


</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
    // IntersectionObserver untuk animasi saat elemen muncul di viewport
    document.addEventListener('DOMContentLoaded', function() {
        const animateElements = document.querySelectorAll('.animate__animated');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__fadeInUp');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        animateElements.forEach(el => observer.observe(el));
    });
</script>
@endpush
