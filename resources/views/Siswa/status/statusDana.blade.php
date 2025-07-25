@section('title', 'Status Dana - PIPGuard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
        color: var(--text-color);
    }
    
    .status-card {
        background: var(--card-color);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        border: none;
    }
    
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
    
    .status-step .circle {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
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
    
    .periode-filter {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.05), rgba(63, 55, 201, 0.05));
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--primary-color);
    }
    
    /* Tabel yang Lebih Elegan */
    .table-container {
        background: var(--card-color);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }
    
    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table thead th {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.1rem 1.5rem;
        font-weight: 500;
        border: none;
        position: sticky;
        top: 0;
    }
    
    .table th:first-child {
        border-top-left-radius: 12px;
    }
    
    .table th:last-child {
        border-top-right-radius: 12px;
    }
    
    .table tbody tr {
        transition: all 0.2s;
    }
    
    .table tbody tr:not(:last-child) td {
        border-bottom: 1px solid #f0f0f0;
    }
    
    .table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.03);
    }
    
    .table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }
    
    .table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }
    
    .table td {
        padding: 1.1rem 1.5rem;
        vertical-align: middle;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 0.4rem 0.9rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    .status-badge i {
        margin-right: 0.4rem;
        font-size: 0.8rem;
    }
    
    .status-badge.belum-dicairkan {
        background-color: #f8f9fa;
        color: var(--text-light);
        border: 1px solid #e9ecef;
    }
    
    .status-badge.menunggu {
        background-color: rgba(248, 150, 30, 0.1);
        color: #f8961e;
        border: 1px solid rgba(248, 150, 30, 0.2);
    }
    
    .status-badge.sudah-cair {
        background-color: rgba(76, 201, 240, 0.1);
        color: #4cc9f0;
        border: 1px solid rgba(76, 201, 240, 0.2);
    }
    
    /* Tombol */
    .btn-konfirmasi {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 12px 28px;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 8px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-konfirmasi:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 20px rgba(67, 97, 238, 0.4);
        color: white;
    }
    
    .btn-konfirmasi i {
        margin-right: 0.7rem;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
    }
    
    .empty-state i {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        color: #e9ecef;
    }
    
    .empty-state h5 {
        color: var(--text-light);
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        color: var(--text-light);
        font-size: 0.95rem;
    }
</style>
@endpush

@section('content')
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Status Tracker Card -->
            <div class="status-card animate__animated animate__fadeIn">
                <h2 class="mb-4"><i class="fas fa-tasks me-2"></i> Status Terkini</h2>
                
                <div class="progress-tracker">
                    <div class="status-step {{ $status === 'Belum Dicairkan' ? 'active' : '' }} animate__animated animate__fadeInLeft" id="step-belum">
                        <div class="circle">
                            <i class="fas fa-clock"></i>
                        </div>
                        <p>Belum Dicairkan</p>
                    </div>
                    
                    <div class="status-step {{ $status === 'Menunggu' ? 'active' : '' }} animate__animated animate__fadeIn animate-delay-1" id="step-proses">
                        <div class="circle">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <p>Dalam Proses</p>
                    </div>
                    
                    <div class="status-step {{ $status === 'Sudah Cair' ? 'active' : '' }} animate__animated animate__fadeInRight animate-delay-2" id="step-sudah">
                        <div class="circle">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p>Sudah Cair</p>
                    </div>
                </div>
                
                <style>
                    .progress-tracker::after {
                        width: {{ $status === 'Belum Dicairkan' ? '0%' : ($status === 'Menunggu' ? '50%' : '100%') }};
                    }
                </style>
            </div>
            
            <!-- Periode Filter -->
            <div class="periode-filter animate__animated animate__fadeIn animate-delay-1">
                <h3 class="mb-3"><i class="fas fa-filter me-2"></i> Periode Pencairan</h3>
                <div class="row">
                    <div class="col-md-6">
                        <label for="kelas-dropdown" class="form-label fw-medium">Pilih Kelas:</label>
                        <select id="kelas-dropdown" class="form-select">
                            @foreach(array_keys($riwayat) as $kelas)
                                <option value="{{ $kelas }}" {{ $loop->first ? 'selected' : '' }}>Kelas {{ $kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Riwayat Table -->
            <div class="animate__animated animate__fadeIn animate-delay-2">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="far fa-calendar me-2"></i> Periode</th>
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
            
            <!-- Tombol Konfirmasi -->
            <div class="text-center mt-4 animate__animated animate__fadeIn animate-delay-3">
                <a href="{{ route('konfirmasi.form') }}" class="btn btn-konfirmasi">
                    <i class="fas fa-paper-plane me-2"></i> Konfirmasi Pencairan
                </a>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
    const riwayatData = {!! json_encode($riwayat ?? []) !!};

    document.addEventListener('DOMContentLoaded', function() {
        const kelasDropdown = document.getElementById('kelas-dropdown');
        const riwayatTable = document.getElementById('riwayat-table');

        function updateRiwayat(kelas) {
            if (!riwayatData[kelas]) {
                riwayatTable.innerHTML = `
                    <tr>
                        <td colspan="4">
                            <div class="empty-state py-5">
                                <i class="far fa-folder-open"></i>
                                <h5>Belum ada data pencairan</h5>
                                <p>Riwayat pencairan akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            const rows = riwayatData[kelas].map(row => `
                <tr>
                    <td>${row.periode}</td>
                    <td>
                        <span class="status-badge ${row.status.toLowerCase().replace(' ', '-')}">
                            <i class="fas ${row.status === 'Belum Dicairkan' ? 'fa-clock' : (row.status === 'Menunggu' ? 'fa-spinner' : 'fa-check-circle')}"></i>
                            ${row.status}
                        </span>
                    </td>
                    <td class="fw-medium">${row.nominal}</td>
                    <td>${row.tanggal}</td>
                </tr>
            `).join('');
            
            riwayatTable.innerHTML = rows;
        }

        kelasDropdown.addEventListener('change', () => {
            updateRiwayat(kelasDropdown.value);
        });

        // Animasi saat elemen muncul di viewport
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