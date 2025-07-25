@extends('AdminSekolah.layouts.admin')

@section('title', 'Laporan Pengaduan Siswa')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .table-responsive {
        padding: 1.5rem;
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

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #e3e6f0;
    }

    .table tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transform: translateX(5px);
        transition: all 0.3s;
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
</style>
@endpush

@section('content')
<div class="container-fluid p-4">
    <div class="content-box animate__animated animate__fadeIn">
        <div class="header-table">
            <h3 class="animate__animated animate__fadeInDown">
                <i class="fas fa-exclamation-circle me-2"></i>Laporan Pengaduan Siswa
            </h3>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>KELAS</th>
                        <th>MASALAH</th>
                        <th>BUKTI</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Dummy data tampilan awal --}}
                    <tr class="animate__animated animate__fadeIn">
                        <td>1</td>
                        <td>Siti Nur Aisah</td>
                        <td>12 IPA 1</td>
                        <td>Belum menerima dana PIP</td>
                        <td>
                            <a href="#" class="link"><i class="fas fa-file-image"></i> Lihat Bukti</a>
                        </td>
                    </tr>
                    <tr class="animate__animated animate__fadeIn">
                        <td>2</td>
                        <td>Ahmad Rizki</td>
                        <td>11 IPS 2</td>
                        <td>Nominal tidak sesuai</td>
                        <td>
                            <a href="#" class="link"><i class="fas fa-file-image"></i> Lihat Bukti</a>
                        </td>
                    </tr>
                    {{-- Kosongkan jika tidak ada data --}}
                    {{-- <tr>
                        <td colspan="5" class="empty-row">
                            <i class="fas fa-info-circle fa-2x mb-3" style="color: var(--info-color);"></i>
                            <p class="mb-0">Belum ada laporan pengaduan</p>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
