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
    /* Table Styles */
.table-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    padding: 24px;
    margin-bottom: 24px;
    overflow: hidden;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table thead th {
    background-color: rgba(67, 97, 238, 0.1);
    color: var(--primary-color);
    font-weight: 600;
    padding: 12px 16px;
    text-align: left;
    border-bottom: 2px solid rgba(67, 97, 238, 0.2);
}

.table tbody td {
    padding: 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    vertical-align: middle;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 500;
}

.status-badge i {
    margin-right: 6px;
}

.belum-dicairkan {
    background-color: rgba(248, 150, 30, 0.1);
    color: var(--warning-color);
}

.menunggu {
    background-color: rgba(76, 201, 240, 0.1);
    color: var(--success-color);
}

.sudah-dicairkan {
    background-color: rgba(74, 214, 109, 0.1);
    color: var(--success-color);
}

/* Empty State Improvements */
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    text-align: center;
}

.empty-state i {
    font-size: 48px;
    color: var(--text-light);
    margin-bottom: 16px;
    opacity: 0.5;
}

.empty-state h5 {
    color: var(--text-color);
    font-weight: 600;
    margin-bottom: 8px;
}

.empty-state p {
    color: var(--text-light);
    margin: 0;
    font-size: 0.9rem;
}
/* Detail Penarikan Styles */
.detail-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.detail-table th {
    background-color: rgba(67, 97, 238, 0.05);
    color: var(--primary-color);
    font-weight: 600;
    padding: 12px 16px;
    text-align: left;
    border-bottom: 2px solid rgba(67, 97, 238, 0.1);
}

.detail-table td {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    vertical-align: middle;
}

.detail-table tr:last-child td {
    border-bottom: none;
}

.detail-table .semester-header {
    background-color: rgba(67, 97, 238, 0.1);
    font-weight: 600;
    color: var(--primary-color);
}

.method-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 500;
    background-color: rgba(76, 201, 240, 0.1);
    color: var(--success-color);
}
/* Style untuk judul semester */
.semester-title {
    color: var(--primary-color);
    font-weight: 600;
    display: flex;
    align-items: center;
    padding-bottom: 8px;
    border-bottom: 2px solid rgba(67, 97, 238, 0.1);
}

/* Style untuk tabel detail */
.detail-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.detail-table th {
    background-color: rgba(67, 97, 238, 0.05);
    color: var(--primary-color);
    font-weight: 600;
    padding: 12px 16px;
    text-align: left;
}

.detail-table td {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.method-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
    background-color: rgba(76, 201, 240, 0.1);
    color: var(--success-color);
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
        <!-- <p class="text-muted">Status Terkini: <strong>{{ $status }}</strong></p> -->
        <div class="card-container animate__animated animate__fadeIn">
            <div class="section-header">
                <i class="fas fa-tasks"></i>
                <h2>Status Terkini</h2>
            </div>
            
            <div class="progress-tracker">
                <!-- Step 1 -->
                <div class="status-step {{ $status === 'Belum Cair' ? 'active' : '' }} animate__animated animate__fadeInLeft" id="step-belum">
                    <div class="circle">
                        <i class="fas fa-clock"></i>
                    </div>
                    <p>Belum Cair</p>
                </div>

                <!-- Step 2 -->
                <div class="status-step {{ $status === 'Belum Tarik Dana' ? 'active' : '' }} animate__animated animate__fadeIn animate-delay-1" id="step-proses">
                    <div class="circle">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <p>Belum Tarik Dana</p>
                </div>

                <!-- Step 3 -->
                <div class="status-step {{ $status === 'Sudah Tarik Dana' ? 'active' : '' }} animate__animated animate__fadeInRight animate-delay-2" id="step-sudah">
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
        <tr class="animate__animated animate__fadeIn">
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
<div class="empty-state text-center py-4">
    <i class="far fa-folder-open mb-2" style="font-size: 2rem; color: #adb5bd;"></i>
    <h5 class="mb-1 fw-semibold" style="font-size: 1.1rem;">Belum ada data penarikan</h5>
    <p class="text-muted m-0" style="font-size: 0.9rem;">Silahkan lakukan Konfirmasi terlebih dahulu</p>
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
                
<div class="riwayat-content">
    <!-- Ganti empty-riwayat dengan ini -->
    <div class="detail-penarikan">
        <!-- Semester 1 -->
        <h5 class="semester-title mt-4 mb-3">
            <i class="fas fa-calendar-alt me-2 text-primary"></i> Semester 1
        </h5>
        <table class="detail-table mb-4">
            <thead>
                <tr>
                    <th>Nominal Dana</th>
                    <th>Tanggal Penarikan</th>
                    <th>Metode Penarikan</th>
                    <th>Nomor Rekening</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-bold text-success">Rp1.200.000</td>
                    <td>27 Juli 2024</td>
                    <td><span class="method-badge">BNI</span></td>
                    <td>1234567890</td>
                </tr>
            </tbody>
        </table>

        <!-- Semester 2 -->
        <h5 class="semester-title mt-4 mb-3">
            <i class="fas fa-calendar-alt me-2 text-primary"></i> Semester 2
        </h5>
        <table class="detail-table">
            <thead>
                <tr>
                    <th>Nominal Dana</th>
                    <th>Tanggal Penarikan</th>
                    <th>Nama Rekening</th>
                    <th>Nomor Rekening</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-bold text-success">Rp1.200.000</td>
                    <td>15 Juli 2025/td>
                    <td><span class="method-badge">BNI</span></td>
                    <td>1234567890</td>
                </tr>
            </tbody>
        </table>
    </div>
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
        // Tambahkan ini di dalam DOMContentLoaded
const tableRows = document.querySelectorAll('#riwayat-table tr');
tableRows.forEach((row, index) => {
    row.style.animationDelay = `${index * 0.1}s`;
});
// Tambahkan ini di dalam DOMContentLoaded
document.querySelector('.btn-riwayat .fa-eye').closest('button').addEventListener('click', function() {
    const detailSection = document.querySelector('.detail-penarikan');
    const emptyState = document.querySelector('.empty-riwayat');
    
    if (detailSection) {
        detailSection.classList.toggle('d-none');
        emptyState.classList.toggle('d-none');
        
        // Ganti icon eye/open-eye
        const icon = this.querySelector('i');
        if (icon.classList.contains('fa-eye')) {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    });
    
</script>
@endpush