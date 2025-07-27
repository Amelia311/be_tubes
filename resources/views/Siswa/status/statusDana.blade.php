@extends('Siswa.layouts.siswa')

@section('title', 'Status Dana - PIPGuard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --warning-color: #f8961e;
        --danger-color: #f72585;
        --bg-color: #f8f9fa;
        --card-color: #ffffff;
        --text-color: #2b2d42;
        --text-light: #8d99ae;
    }
    
    body {
        background-color: var(--bg-color);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Card Styles */
    .card-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 24px;
        margin-bottom: 24px;
    }
    .section-header {
        display: flex;
        align-items: center;
        gap: 20px; /* Mengatur jarak ikon dan teks */
    }
    .section-header i {
        font-size: 30px;
        color: var(--primary-color);
        /* margin-right dihapus jika menggunakan gap */
    }
        
    .section-header h2 {
        font-size: 25px;
        font-weight: 600;
        margin: 0;
    }
    
    /* Progress Tracker Styles */
    .progress-tracker {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 2rem 0 3rem;
    }
    
    .progress-tracker::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 6px;
        background: #e9ecef;
        z-index: 1;
        border-radius: 3px;
    }
    
    .progress-tracker::after {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        z-index: 2;
        border-radius: 3px;
        transition: all 0.5s ease;
    }
    
    .status-step {
        text-align: center;
        z-index: 3;
    }
    
    .status-step .circle {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        position: relative;
        transition: all 0.3s ease;
        border: 3px solid white;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .status-step.active .circle {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        transform: scale(1.1);
    }
    
    .status-step p {
        font-weight: 500;
        color: var(--text-light);
        margin-bottom: 0;
    }
    
    /* Empty State for Detail Penarikan */
    .empty-detail {
        text-align: center;
        padding: 40px 0;
    }
    
    .empty-detail i {
        font-size: 48px;
        color: #e9ecef;
        margin-bottom: 16px;
    }
    
    .empty-detail p {
        color: var(--text-light);
        margin: 0;
    }
    
    /* Riwayat Section */
    .riwayat-container {
        margin-top: 32px;
    }
    
    .riwayat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    
    .btn-riwayat {
        background: white;
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-riwayat i {
        margin-right: 8px;
    }
    
    .empty-riwayat {
        text-align: center;
        padding: 40px 0;
        background-color: rgba(233, 236, 239, 0.3);
        border-radius: 12px;
    }
    
    .empty-riwayat i {
        font-size: 48px;
        color: #e9ecef;
        margin-bottom: 16px;
    }
    
    /* Confirmation Button */
    .btn-konfirmasi {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white !important;
        padding: 12px 28px;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        margin: 24px 0;
    }
    
    /* Animations */
    .animate-delay-1 {
        animation-delay: 0.1s;
    }
    
    .animate-delay-2 {
        animation-delay: 0.2s;
    }
    
    .animate-delay-3 {
        animation-delay: 0.3s;
    }
</style>
@endpush

<!-- @php
    $status = $status ?? 'Belum Cair';
@endphp -->
@section('content')
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Status Tracker Card -->
            <div class="card-container animate__animated animate__fadeIn">
                <div class="section-header">
                    <i class="fas fa-tasks"></i>
                    <h2>Status Terkini</h2>
                </div>
                
                <div class="progress-tracker">
                <div class="status-step {{ $status === 'Belum Cair' ? 'active' : '' }} animate__animated animate__fadeInLeft" id="step-belum">
                <div class="circle">
                    <i class="fas fa-clock"></i>
                </div>
                    <p>Belum Cair</p>
                </div>

                <div class="status-step {{ in_array($status, ['Sudah Cair', 'Sedang Diproses']) ? 'active' : '' }} animate__animated animate__fadeIn animate-delay-1" id="step-proses">
                    <div class="circle">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <p>Belum Tarik Dana</p>
                </div>

                <div class="status-step {{ $status === 'Sudah Ditarik' ? 'active' : '' }} animate__animated animate__fadeInRight animate-delay-2" id="step-sudah">
                    <div class="circle">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p>Sudah Tarik Dana</p>
                </div>

                </div>
            </div>

            
            <!-- Riwayat Table -->
            <div class="animate__animated animate__fadeIn animate-delay-2">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="far fa-calendar me-2"></i> Semester</th>
                                <th><i class="fas fa-info-circle me-2"></i> Status</th>
                                <th><i class="fas fa-money-bill-wave me-2"></i> Nominal</th>
                                <th><i class="far fa-clock me-2"></i> Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="riwayat-table">
                            @php
                                $firstKelas = !empty($riwayat) ? array_key_first($riwayat) : null;
                            @endphp
                            @if($firstKelas && isset($riwayat[$firstKelas]))
                                @foreach($riwayat[$firstKelas] as $row)
                                <tr>
                                    <td>{{ $row['periode'] }}</td>
                                    <td>
                                        <span class="status-badge {{ strtolower(str_replace(' ', '-', $row['status'])) }}">
                                            <i class="fas {{ $row['status'] === 'Belum Dicairkan' ? 'fa-clock' : ($row['status'] === 'Menunggu' ? 'fa-spinner' : 'fa-check-circle') }}"></i>
                                            {{ $row['status'] }}
                                        </span>
                                    </td>
                                    <td class="fw-medium">{{ $row['nominal'] }}</td>
                                    <td>{{ $row['tanggal'] }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state py-5">
                                            <i class="far fa-folder-open"></i>
                                            <h5>Belum ada data pencairan</h5>
                                            <p>Riwayat pencairan akan muncul di sini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Confirmation Button - With Proper Spacing -->
            <div class="text-center animate__animated animate__fadeIn animate-delay-2">
                <a href="{{ route('konfirmasi.form') }}" class="btn btn-konfirmasi">
                    <i class="fas fa-paper-plane me-2"></i> Konfirmasi Penarikan
                </a>
            </div>
            
            <!-- Riwayat Penarikan Card - With Proper Spacing -->
            <div class="card-container animate__animated animate__fadeIn animate-delay-3" style="margin-top: 24px;">
                <div class="section-header">
                    <i class="fas fa-history"></i>
                    <h2>Riwayat Penarikan</h2>
                </div>
                
                <div class="riwayat-container">
                    <div class="riwayat-header">
                        <div></div> <!-- Empty div for alignment -->
                        <div>
                            <button class="btn btn-riwayat me-2">
                                <i class="fas fa-filter"></i> Pilih Kelas
                            </button>
                            <button class="btn btn-riwayat">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                    
                    <div class="empty-riwayat">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada riwayat penarikan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script>
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