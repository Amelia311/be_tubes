@extends('AdminSekolah.layouts.admin')

@section('title', 'Daftar Siswa')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_dashboard.css') }}">
<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #f8f9fc;
        --accent-color: #2e59d9;
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
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
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
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }
    
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-color);
    }
    
    .btn-tambah {
        background-color: white;
        color: var(--primary-color);
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: none;
    }
    
    .btn-tambah:hover {
        background-color: #e6e6e6;
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        color: var(--accent-color);
    }
    
    .table-container {
        overflow-x: auto;
        padding: 1.5rem;
    }
    
    .table {
        width: 100%;
        margin-bottom: 18rem;
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
    
    .action-icon {
        font-size: 1.1rem;
        color: var(--text-color);
        margin: 0 0.5rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .fa-pen {
        color:#ffb347;
    }
    
    .fa-pen:hover {
        color:rgb(251, 161, 35);
        transform: scale(1.2);
    }
    
    .fa-trash {
        color: #e74a3b;
    }
    
    .fa-trash:hover {
        color: #be2617;
        transform: scale(1.2);
    }
    
    .alert-success {
        border-left: 5px solid #1cc88a;
        animation: slideInRight 0.5s ease-in-out;
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
            <h3><i class="fas fa-users me-2"></i>Daftar Siswa</h3>
            <div class="d-flex align-items-center gap-3">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Cari siswa...">
                </div>
                <a href="{{ route('siswa.create') }}" class="btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Siswa
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA SISWA</th>
                            <th>NISN</th>
                            <th>ASAL SEKOLAH</th>
                            <th>ALAMAT</th>
                            <th>KELAS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $item)
                            <tr class="animate__animated animate__fadeIn">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nisn }}</td>
                                <td>{{ $item->asal_sekolah }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->kelas ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('siswa.edit', $item->id) }}" class="text-primary me-2">
                                        <i class="fas fa-pen action-icon"></i>
                                    </a>
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
                                <td colspan="7" class="empty-row">
                                    <i class="fas fa-exclamation-circle fa-2x mb-3" style="color: #f6c23e;"></i>
                                    <p class="mb-0">Data siswa tidak ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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