@extends('AdminSekolah.layouts.admin')

@section('title', 'Dashboard Admin')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css">
<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #f8f9fc;
        --accent-color: #2e59d9;
        --text-color: #5a5c69;
        --success-color: #1cc88a;
        --warning-color: #f6c23e;
        --danger-color: #e74a3b;
    }
    
    .content-box {
        background: white;
        border-radius: 15px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        overflow: hidden;
        animation: fadeIn 0.5s ease-in-out;
        margin-bottom: 1.5rem;
    }
    
    .header-box {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        padding: 1.5rem;
        color: white;
    }
    
    .header-box h3 {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .header-box h3 i {
        font-size: 1.5rem;
    }
    
    .card-stat {
        border-left: 5px solid var(--primary-color);
        transition: all 0.3s;
    }
    
    .card-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .card-stat .card-title {
        font-size: 0.9rem;
        color: var(--text-color);
        text-transform: uppercase;
        font-weight: 600;
    }
    
    .card-stat .card-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-color);
    }
    
    .card-stat.success {
        border-left-color: var(--success-color);
    }
    
    .card-stat.success .card-value {
        color: var(--success-color);
    }
    
    .card-stat.warning {
        border-left-color: var(--warning-color);
    }
    
    .card-stat.warning .card-value {
        color: var(--warning-color);
    }
    
    .chart-container {
        padding: 1.5rem;
        height: 300px;
    }
    
    .upload-container {
        padding: 1.5rem;
    }
    
    .btn-upload {
        background-color: var(--primary-color);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        border: none;
    }
    
    .btn-upload:hover {
        background-color: var(--accent-color);
        color: white;
        transform: translateY(-2px);
    }
    
    .sk-list {
        margin-top: 1.5rem;
    }
    
    .sk-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #e3e6f0;
        transition: all 0.3s;
    }
    
    .sk-item:hover {
        background-color: rgba(78, 115, 223, 0.05);
    }
    
    .sk-info {
        flex: 1;
    }
    
    .sk-title {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.25rem;
    }
    
    .sk-meta {
        font-size: 0.85rem;
        color: var(--text-color);
    }
    
    .sk-actions a {
        color: var(--primary-color);
        margin-left: 1rem;
        transition: all 0.2s;
    }
    
    .sk-actions a:hover {
        color: var(--accent-color);
    }
    
    .semester-tabs {
        display: flex;
        border-bottom: 1px solid #e3e6f0;
        padding: 0 1.5rem;
    }
    
    .semester-tab {
        padding: 1rem 1.5rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--text-color);
        position: relative;
    }
    
    .semester-tab.active {
        color: var(--primary-color);
    }
    
    .semester-tab.active:after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
    }
    
    .tab-content {
        display: none;
        padding: 1.5rem;
    }
    
    .tab-content.active {
        display: block;
        animation: fadeIn 0.5s;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .badge-pip {
        background-color: var(--primary-color);
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .badge-semester {
        background-color: var(--secondary-color);
        color: var(--primary-color);
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--text-color);
    }
    
    .empty-state i {
        font-size: 2rem;
        color: #e3e6f0;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .chart-container {
            height: 250px;
        }
        
        .semester-tabs {
            overflow-x: auto;
            flex-wrap: nowrap;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-4">
    <!-- Statistik Utama -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="content-box card-stat animate__animated animate__fadeInLeft">
                <div class="card-body">
                    <h6 class="card-title">Total Penerima PIP</h6>
                    <h2 class="card-value">142</h2>
                    <p class="mb-0"><span class="text-success">+5%</span> dari semester lalu</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="content-box card-stat success animate__animated animate__fadeIn">
                <div class="card-body">
                    <h6 class="card-title">Sudah Menerima Semester Ini</h6>
                    <h2 class="card-value">128</h2>
                    <p class="mb-0"><span class="text-success">90%</span> dari total penerima</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="content-box card-stat warning animate__animated animate__fadeInRight">
                <div class="card-body">
                    <h6 class="card-title">Belum Menerima</h6>
                    <h2 class="card-value">14</h2>
                    <p class="mb-0"><span class="text-warning">10%</span> dari total penerima</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Diagram Penarikan -->
        <div class="col-lg-8">
            <div class="content-box animate__animated animate__fadeIn">
                <div class="header-box">
                    <h3><i class="fas fa-chart-bar"></i> Diagram Penarikan PIP</h3>
                </div>
                <div class="semester-tabs">
                    <div class="semester-tab active" data-tab="semester1">Semester 1</div>
                    <div class="semester-tab" data-tab="semester2">Semester 2</div>
                </div>
                <div class="tab-content active" id="semester1">
                    <div class="chart-container">
                        <canvas id="chartSemester1"></canvas>
                    </div>
                </div>
                <div class="tab-content" id="semester2">
                    <div class="chart-container">
                        <canvas id="chartSemester2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SK PIP Terbaru -->
        <div class="col-lg-4">
            <div class="content-box animate__animated animate__fadeIn">
                <div class="header-box">
                    <h3><i class="fas fa-file-alt"></i> SK PIP Terbaru</h3>
                </div>
                <div class="upload-container">
                    <button class="btn-upload" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        <i class="fas fa-upload"></i> Upload SK Baru
                    </button>
                    
                    <div class="sk-list">
                        @if($skPip->count() > 0)
                            @foreach($skPip as $sk)
                            <div class="sk-item">
                                <div class="sk-info">
                                    <div class="sk-title">{{ $sk->nama_sk }}</div>
                                    <div class="sk-meta">
                                        <span class="badge-pip me-2">PIP {{ $sk->tahun }}</span>
                                        <span class="badge-semester">Semester {{ $sk->semester }}</span>
                                    </div>
                                </div>
                                <div class="sk-actions">
                                    <a href="{{ Storage::url($sk->file_path) }}" target="_blank" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" title="Download">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="fas fa-file-excel"></i>
                                <p>Belum ada SK PIP yang diupload</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Daftar Penerima PIP per Semester -->
    <div class="row">
        <div class="col-12">
            <div class="content-box animate__animated animate__fadeIn">
                <div class="header-box">
                    <h3><i class="fas fa-users"></i> Daftar Penerima PIP</h3>
                </div>
                <div class="semester-tabs">
                    <div class="semester-tab active" data-tab="daftar-semester1">Semester 1</div>
                    <div class="semester-tab" data-tab="daftar-semester2">Semester 2</div>
                </div>
                <div class="tab-content active" id="daftar-semester1">
                    <div class="table-responsive p-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA SISWA</th>
                                    <th>NISN</th>
                                    <th>KELAS</th>
                                    <th>NO REKENING</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penerimaSemester1 as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nisn }}</td>
                                    <td>{{ $siswa->kelas }}</td>
                                    <td>{{ $siswa->no_rekening }}</td>
                                    <td>
                                        @if($siswa->status_pencairan)
                                            <span class="badge bg-success">Sudah Cair</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum Cair</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-content" id="daftar-semester2">
                    <div class="table-responsive p-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA SISWA</th>
                                    <th>NISN</th>
                                    <th>KELAS</th>
                                    <th>NO REKENING</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penerimaSemester2 as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nisn }}</td>
                                    <td>{{ $siswa->kelas }}</td>
                                    <td>{{ $siswa->no_rekening }}</td>
                                    <td>
                                        @if($siswa->status_pencairan)
                                            <span class="badge bg-success">Sudah Cair</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum Cair</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload SK -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload SK PIP Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sk-pip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_sk" class="form-label">Nama SK</label>
                        <input type="text" class="form-control" id="nama_sk" name="nama_sk" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select class="form-select" id="tahun" name="tahun" required>
                            @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-select" id="semester" name="semester" required>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="file_sk" class="form-label">File SK</label>
                        <input class="form-control" type="file" id="file_sk" name="file_sk" accept=".pdf,.doc,.docx" required>
                        <div class="form-text">Format file: PDF, DOC, DOCX (Maks. 5MB)</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching
        const tabs = document.querySelectorAll('.semester-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Remove active class from all tabs and contents
                document.querySelectorAll('.semester-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        // Chart for Semester 1
        const ctx1 = document.getElementById('chartSemester1').getContext('2d');
        const chartSemester1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Kelas 10', 'Kelas 11', 'Kelas 12'],
                datasets: [{
                    label: 'Sudah Menerima',
                    data: [45, 38, 35],
                    backgroundColor: '#1cc88a',
                    borderColor: '#1cc88a',
                    borderWidth: 1
                }, {
                    label: 'Belum Menerima',
                    data: [5, 7, 2],
                    backgroundColor: '#f6c23e',
                    borderColor: '#f6c23e',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Penarikan PIP Semester 1 2023/2024',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });
        
        // Chart for Semester 2
        const ctx2 = document.getElementById('chartSemester2').getContext('2d');
        const chartSemester2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Kelas 10', 'Kelas 11', 'Kelas 12'],
                datasets: [{
                    label: 'Sudah Menerima',
                    data: [42, 40, 32],
                    backgroundColor: '#1cc88a',
                    borderColor: '#1cc88a',
                    borderWidth: 1
                }, {
                    label: 'Belum Menerima',
                    data: [8, 5, 3],
                    backgroundColor: '#f6c23e',
                    borderColor: '#f6c23e',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Penarikan PIP Semester 2 2022/2023',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });
    });
</script>
@endsection