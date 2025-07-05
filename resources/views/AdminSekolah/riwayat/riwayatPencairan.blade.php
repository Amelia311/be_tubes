@extends('AdminSekolah.layouts.admin')

@section('title', 'Riwayat Pencairan')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #f8f9fc;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
        --warning-color: #f6c23e;
        --info-color: #36b9cc;
        --text-color: #5a5c69;
    }
    
    .content-box {
        background: white;
        border-radius: 15px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        overflow: hidden;
        animation: fadeIn 0.5s ease-in-out;
    }
    
    .header-table {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--info-color) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .header-table h3 {
        margin: 0;
        font-weight: 600;
        color: white;
    }
    
    .search-box {
        position: relative;
        flex-grow: 1;
        max-width: 400px;
    }
    
    .search-box input {
        width: 100%;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        border-radius: 50px;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: all 0.3s;
    }
    
    .search-box input:focus {
        box-shadow: 0 0 0 0.25rem rgba(54, 185, 204, 0.25);
        outline: none;
    }
    
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-color);
    }
    
    .table-responsive {
        padding: 1.5rem;
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: var(--text-color);
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table thead th {
        background-color: var(--secondary-color);
        color: var(--primary-color);
        font-weight: 600;
        padding: 1rem;
        border-bottom: 2px solid #e3e6f0;
        position: sticky;
        top: 0;
    }
    
    .table tbody tr {
        transition: all 0.3s;
    }
    
    .table tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transform: translateX(5px);
    }
    
    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #e3e6f0;
    }
    
    .status {
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .status.sudah {
        background-color: rgba(28, 200, 138, 0.2);
        color: var(--success-color);
    }
    
    .status.menunggu {
        background-color: rgba(246, 194, 62, 0.2);
        color: var(--warning-color);
    }
    
    .link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    
    .link:hover {
        color: var(--info-color);
        text-decoration: underline;
    }
    
    .empty-row {
        text-align: center;
        padding: 2rem;
        color: var(--text-color);
    }
    
    .empty-row td {
        border: none;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @media (max-width: 768px) {
        .header-table {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .search-box {
            max-width: 100%;
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-4">
    <div class="content-box animate__animated animate__fadeIn">
        <div class="header-table">
            <h3 class="animate__animated animate__fadeInDown">
                <i class="fas fa-history me-2"></i>Riwayat Pencairan
            </h3>
            <form method="GET" action="{{ route('riwayat.sekolah') }}" class="search-box animate__animated animate__fadeIn">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari nama siswa..." value="{{ request('search') }}" class="form-control"/>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>JUMLAH</th>
                        <th>STATUS</th>
                        <th>BUKTI</th>
                        <th>BLOCKCHAIN TX</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="animate__animated animate__fadeIn">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->siswa->nama ?? '-' }}</td>
                            <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td>
                                <span class="status {{ strtolower($item->status) == 'sudah cair' ? 'sudah' : 'menunggu' }}">
                                    <i class="fas {{ strtolower($item->status) == 'sudah cair' ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                @if ($item->bukti)
                                    <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank" class="link">
                                        <i class="fas fa-file-image"></i> Lihat Bukti
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($item->blockchain_tx)
                                    <a href="https://sepolia.etherscan.io/tx/{{ $item->blockchain_tx }}" target="_blank" class="link">
                                        <i class="fas fa-link"></i> Lihat Transaksi
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-row">
                                <i class="fas fa-info-circle fa-2x mb-3" style="color: var(--info-color);"></i>
                                <p class="mb-0">Tidak ada riwayat pencairan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
    // Animasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
        });
    });
</script>
@endsection