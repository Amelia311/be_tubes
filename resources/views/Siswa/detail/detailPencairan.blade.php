@extends('Siswa.layouts.siswa')

@section('title', 'Detail Pencairan - PIPGuard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    .card-detail {
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }
    
    .card-detail:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }
    
    .card-header {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        color: white;
        font-weight: 600;
        padding: 1.5rem;
        border-bottom: none;
    }
    
    .detail-item {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #eee;
        transition: background-color 0.2s;
    }
    
    .detail-item:hover {
        background-color: #f9f9f9;
    }
    
    .detail-label {
        font-weight: 600;
        color: #555;
    }
    
    .detail-value {
        color: #333;
    }
    
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
    }
    
    .no-data {
        text-align: center;
        padding: 3rem;
        color: #666;
    }
    
    .no-data i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #ddd;
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
    
    .animate-delay-4 {
        animation-delay: 0.4s;
    }
    
    .animate-delay-5 {
        animation-delay: 0.5s;
    }
</style>
@endpush

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-detail mb-4">
                <div class="card-header animate__animated animate__fadeInDown">
                    <h2 class="h4 mb-0">Detail Pencairan Dana</h2>
                </div>
                
                <div class="card-body p-0">
                    @if($pencairan)
                        <div class="detail-item animate__animated animate__fadeIn animate-delay-1">
                            <div class="row">
                                <div class="col-md-4 detail-label">Nominal Dana</div>
                                <div class="col-md-8 detail-value">
                                    <span class="fw-bold text-primary">Rp {{ number_format($pencairan->jumlah, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item animate__animated animate__fadeIn animate-delay-2">
                            <div class="row">
                                <div class="col-md-4 detail-label">Tanggal Pengajuan</div>
                                <div class="col-md-8 detail-value">
                                    {{ \Carbon\Carbon::parse($pencairan->created_at)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item animate__animated animate__fadeIn animate-delay-3">
                            <div class="row">
                                <div class="col-md-4 detail-label">Tanggal Pencairan</div>
                                <div class="col-md-8 detail-value">
                                    {{ $pencairan->tanggal_cair ? \Carbon\Carbon::parse($pencairan->tanggal_cair)->format('d M Y') : '-' }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item animate__animated animate__fadeIn animate-delay-4">
                            <div class="row">
                                <div class="col-md-4 detail-label">Status Pencairan</div>
                                <div class="col-md-8 detail-value">
                                    @php
                                        $statusClass = '';
                                        switch(strtolower($pencairan->status)) {
                                            case 'diproses':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'diterima':
                                                $statusClass = 'bg-success text-white';
                                                break;
                                            case 'ditolak':
                                                $statusClass = 'bg-danger text-white';
                                                break;
                                            default:
                                                $statusClass = 'bg-secondary text-white';
                                        }
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $pencairan->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item animate__animated animate__fadeIn animate-delay-5">
                            <div class="row">
                                <div class="col-md-4 detail-label">Metode Transfer</div>
                                <div class="col-md-8 detail-value">
                                    Bank BRI
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item animate__animated animate__fadeIn animate-delay-5">
                            <div class="row">
                                <div class="col-md-4 detail-label">Nomor Referensi Transaksi</div>
                                <div class="col-md-8 detail-value">
                                    @if($pencairan->blockchain_tx)
                                        <span class="font-monospace">{{ $pencairan->blockchain_tx }}</span>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="no-data animate__animated animate__fadeIn">
                            <i class="fas fa-inbox"></i>
                            <h4 class="h5">Belum ada data pencairan yang tersedia</h4>
                            <p class="text-muted">Silakan ajukan pencairan dana PIP terlebih dahulu</p>
                        </div>
                    @endif
                </div>
            </div>
            
            @if($pencairan)
            <div class="alert alert-info animate__animated animate__fadeInUp">
                <i class="fas fa-info-circle me-2"></i>
                Jika ada pertanyaan atau masalah terkait pencairan dana, silakan hubungi admin sekolah.
            </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    // Animasi tambahan saat elemen muncul di viewport
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
@endsection