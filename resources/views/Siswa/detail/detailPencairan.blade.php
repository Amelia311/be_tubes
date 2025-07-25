@extends('Siswa.layouts.siswa')

@section('title', 'Detail Penarikan Dana - PIPGuard')

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
    
    /* Header Styles */
    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
    }
    
    .section-header i {
        font-size: 24px;
        color: var(--primary-color);
        margin-right: 12px;
    }
    
    .section-header h2 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }
    
    /* Detail Table Styles - Figma Matching */
    .detail-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .detail-table tr:not(:last-child) td {
        border-bottom: 1px solid #f0f0f0;
    }
    
    .detail-table td {
        padding: 16px 0;
        vertical-align: middle;
    }
    
    .detail-label {
        font-size: 14px;
        color: var(--text-light);
        width: 40%;
        padding-right: 16px;
    }
    
    .detail-value {
        font-weight: 500;
        color: var(--text-color);
    }
    
    .nominal-value {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 16px;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
    }
    
    .status-badge i {
        margin-right: 8px;
        font-size: 14px;
    }
    
    .status-badge.belum-ditarik {
        background-color: rgba(248, 249, 250, 0.5);
        color: var(--text-light);
        border: 1px solid #e9ecef;
    }
    
    .status-badge.sedang-diproses {
        background-color: rgba(248, 150, 30, 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(248, 150, 30, 0.2);
    }
    
    .status-badge.sudah-ditarik {
        background-color: rgba(76, 201, 240, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(76, 201, 240, 0.2);
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
    
    .riwayat-title {
        display: flex;
        align-items: center;
        font-size: 20px;
        font-weight: 600;
    }
    
    .riwayat-title i {
        font-size: 24px;
        color: var(--primary-color);
        margin-right: 12px;
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
    
    .empty-riwayat p {
        color: var(--text-light);
        margin: 0;
    }
</style>
@endpush

@section('content')
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Detail Penarikan Card -->
            <div class="card-container animate__animated animate__fadeIn">
                <div class="section-header">
                    <i class="fas fa-info-circle"></i>
                    <h2>Detail Penarikan Dana</h2>
                </div>
                
                <table class="detail-table">
                    <tr class="animate__animated animate__fadeIn animate-delay-1">
                        <td class="detail-label">Nominal Dana</td>
                        <td class="detail-value nominal-value">Rp {{ number_format($pencairan->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="animate__animated animate__fadeIn animate-delay-1">
                        <td class="detail-label">Tanggal Penarikan</td>
                        <td class="detail-value">{{ \Carbon\Carbon::parse($pencairan->created_at)->format('d M Y') }}</td>
                    </tr>
                    <tr class="animate__animated animate__fadeIn animate-delay-2">
                        <td class="detail-label">Metode Penarikan</td>
                        <td class="detail-value">Bank BNI</td>
                    </tr>
                    <tr class="animate__animated animate__fadeIn animate-delay-2">
                        <td class="detail-label">Nomor Rekening</td>
                        <td class="detail-value">1234567890</td>
                    </tr>
                    <tr class="animate__animated animate__fadeIn animate-delay-3">
                        <td class="detail-label">Status</td>
                        <td class="detail-value">
                            @php
                                $statusClass = '';
                                $statusIcon = '';
                                switch(strtolower($pencairan->status)) {
                                    case 'belum ditarik':
                                        $statusClass = 'belum-ditarik';
                                        $statusIcon = 'fa-clock';
                                        break;
                                    case 'sedang diproses':
                                        $statusClass = 'sedang-diproses';
                                        $statusIcon = 'fa-spinner';
                                        break;
                                    case 'sudah ditarik':
                                        $statusClass = 'sudah-ditarik';
                                        $statusIcon = 'fa-check-circle';
                                        break;
                                    default:
                                        $statusClass = 'belum-ditarik';
                                        $statusIcon = 'fa-clock';
                                }
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                <i class="fas {{ $statusIcon }}"></i>
                                {{ ucfirst($pencairan->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Riwayat Penarikan Card -->
            <div class="card-container animate__animated animate__fadeIn animate-delay-2">
                <div class="riwayat-container">
                    <div class="riwayat-header">
                        <div class="riwayat-title">
                            <i class="fas fa-history"></i>
                            <span>Riwayat Penarikan</span>
                        </div>
                        <button class="btn btn-riwayat">
                            <i class="fas fa-filter"></i> Pilih Kelas
                        </button>
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