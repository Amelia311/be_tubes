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
    
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        position: relative;
        min-height: 300px;
    }
    
    .hero-content {
        padding: 3rem;
        position: relative;
        z-index: 2;
    }
    
    .hero-image {
        position: absolute;
        right: 0;
        bottom: 0;
        height: 100%;
        opacity: 0.9;
        z-index: 1;
    }
    
    .hero-image img {
        height: 100%;
        object-fit: cover;
    }
    
    .announcement-carousel {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
    
    .activity-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .timeline {
        position: relative;
        padding-left: 2rem;
        margin-top: 2rem;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, var(--secondary-color), var(--primary-color));
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
        padding-left: 2rem;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 5px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: var(--primary-color);
        border: 3px solid white;
        box-shadow: 0 0 0 2px var(--primary-color);
    }
    
    .timeline-date {
        font-weight: 600;
        color: var(--primary-color);
    }
    
    .timeline-content {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 0.5rem;
        border-left: 3px solid var(--primary-color);
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }
    
    .status-diproses {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-diterima {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-ditolak {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .animate-delay-1 {
        animation-delay: 0.1s;
    }
    
    .animate-delay-2 {
        animation-delay: 0.2s;
    }
    
    .animate-delay-3 {
        animation-delay: 0.3s;
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    .floating {
        animation: float 3s ease-in-out infinite;
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
                    <h1 class="display-5 fw-bold mb-3 animate__animated animate__fadeInDown">Selamat Datang di PIPGuard</h1>
                    <p class="lead animate__animated animate__fadeIn animate__delay-1s">
                        Platform transparansi dan monitoring pencairan dana Bantuan Indonesia Pintar (PIP) 
                        yang dirancang untuk membantu siswa memantau status bantuan secara mudah dan aman.
                    </p>
                    <button class="btn btn-light btn-lg mt-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <i class="fas fa-info-circle me-2"></i> Pelajari Lebih Lanjut
                    </button>
                </div>
            </div>
            <div class="col-md-6 hero-image d-none d-md-block">
                <img src="{{ asset('storage/img/pip.jpg') }}" alt="Ilustrasi Dashboard PIPGuard" class="floating">
            </div>
        </div>
    </section>

    <!-- Announcement Carousel -->
    <section class="announcement-carousel animate__animated animate__fadeIn animate__delay-1s">
        <div id="announcementCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/img/gambar1.webp') }}" alt="Pencairan Dana Semester 2-2025">
                    <div class="carousel-caption">
                        <h5 class="animate__animated animate__fadeInDown">Pengumuman Penting</h5>
                        <p class="lead animate__animated animate__fadeIn animate__delay-1s">Pencairan dana semester 2-2025 sudah dimulai</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/img/gambar2.jpg') }}" alt="Tips Penggunaan Dana">
                    <div class="carousel-caption">
                        <h5>Tips & Panduan</h5>
                        <p class="lead">Penggunaan dana bantuan dengan bijak</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/img/gambar3.jpg') }}" alt="Laporan Ketidaksesuaian">
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

    <!-- Recent Activity -->
    <section class="activity-card animate__animated animate__fadeIn animate__delay-2s">
        <h3 class="mb-4"><i class="fas fa-history me-2"></i> Aktivitas Terbaru</h3>
        
        @if($pencairan_riwayat->count() > 0)
        <div class="timeline">
            @foreach ($pencairan_riwayat as $item)
            <div class="timeline-item animate__animated animate__fadeInUp">
                <div class="timeline-date">
                    <i class="far fa-calendar-alt me-2"></i>
                    {{ \Carbon\Carbon::parse($item->tanggal_cair)->format('d M Y') }}
                </div>
                <div class="timeline-content">
                    Dana sejumlah <strong>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</strong> 
                    <span class="status-badge status-{{ strtolower($item->status) }}">
                        {{ $item->status }}
                    </span>
                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="far fa-clock me-1"></i> 
                            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-4 animate__animated animate__fadeIn">
            <i class="far fa-folder-open fa-3x mb-3 text-muted"></i>
            <h5 class="text-muted">Tidak ada riwayat pencairan dana</h5>
            <p class="text-muted">Riwayat pencairan akan muncul disini</p>
        </div>
        @endif
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
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
@endpush