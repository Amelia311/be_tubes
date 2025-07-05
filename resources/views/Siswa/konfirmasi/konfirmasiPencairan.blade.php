@extends('Siswa.layouts.siswa')

@section('title', 'Konfirmasi Pencairan')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<style>
    .card-confirm {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.5s ease;
    }
    
    .card-confirm.visible {
        transform: translateY(0);
        opacity: 1;
    }
    
    .card-header {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        color: white;
        padding: 1.5rem;
        border-bottom: none;
        position: relative;
        overflow: hidden;
    }
    
    .card-header::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to bottom right,
            rgba(255, 255, 255, 0.3),
            rgba(255, 255, 255, 0)
        );
        transform: rotate(30deg);
        animation: shine 3s infinite;
    }
    
    @keyframes shine {
        0% { transform: rotate(30deg) translate(-30%, -30%); }
        100% { transform: rotate(30deg) translate(30%, 30%); }
    }
    
    .form-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: #3a7bd5;
        box-shadow: 0 0 0 0.25rem rgba(58, 123, 213, 0.25);
    }
    
    .form-control[readonly] {
        background-color: #f8f9fa;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #4CAF50, #2E7D32);
        border: none;
        padding: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 8px;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(46, 125, 50, 0.4);
    }
    
    .btn-submit::after {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to bottom right,
            rgba(255, 255, 255, 0.3),
            rgba(255, 255, 255, 0)
        );
        transform: rotate(30deg);
        animation: shine 3s infinite;
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .btn-submit:hover::after {
        opacity: 1;
    }
    
    .alert-success {
        border-left: 5px solid #4CAF50;
        border-radius: 8px;
        animation: fadeInRight 0.5s;
    }
    
    .file-upload {
        position: relative;
        overflow: hidden;
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s;
        background-color: #f8f9fa;
    }
    
    .file-upload:hover {
        border-color: #3a7bd5;
        background-color: #f0f7ff;
    }
    
    .file-upload input {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    
    .file-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #666;
    }
    
    .file-upload-label i {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #3a7bd5;
    }
    
    .file-name {
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #333;
        font-weight: 500;
    }
    
    .form-section {
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.5s;
    }
    
    .form-section:nth-child(1) { animation-delay: 0.1s; }
    .form-section:nth-child(2) { animation-delay: 0.2s; }
    .form-section:nth-child(3) { animation-delay: 0.3s; }
    .form-section:nth-child(4) { animation-delay: 0.4s; }
    .form-section:nth-child(5) { animation-delay: 0.5s; }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-confirm">
                <div class="card-header">
                    <h4 class="mb-0 animate__animated animate__fadeInDown"><i class="fas fa-check-circle me-2"></i> Form Konfirmasi Pencairan Dana</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success animate__animated animate__fadeInRight mb-4">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ url('/siswa/konfirmasi') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-section animate__animated">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}" readonly>
                        </div>

                        <div class="form-section animate__animated">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control" value="{{ $siswa->asal_sekolah }}" readonly>
                        </div>

                        <div class="form-section animate__animated">
                            <label class="form-label">Tanggal Konfirmasi</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}" readonly>
                        </div>

                        <div class="form-section animate__animated">
                            <label class="form-label">Jumlah (Rp)</label>
                            <input type="number" name="jumlah" class="form-control" required min="10000" step="1000">
                            <div class="invalid-feedback">
                                Harap masukkan jumlah yang valid
                            </div>
                        </div>

                        <div class="form-section animate__animated">
                            <label class="form-label">Bukti Transfer</label>
                            <div class="file-upload mb-2">
                                <input type="file" name="bukti" id="buktiInput" accept="image/*" required>
                                <label for="buktiInput" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Klik untuk mengunggah bukti transfer</span>
                                    <small class="text-muted">(Format: JPG, PNG, maksimal 2MB)</small>
                                </label>
                            </div>
                            <div id="fileName" class="file-name d-none"></div>
                            <div class="invalid-feedback">
                                Harap unggah bukti transfer
                            </div>
                        </div>

                        <div class="form-section animate__animated mt-4">
                            <button type="submit" class="btn btn-submit w-100 py-3">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Konfirmasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
    // Animasi card saat dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const card = document.querySelector('.card-confirm');
        setTimeout(() => {
            card.classList.add('visible');
        }, 100);
        
        // Menampilkan nama file yang diunggah
        const fileInput = document.getElementById('buktiInput');
        const fileName = document.getElementById('fileName');
        
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileName.textContent = this.files[0].name;
                fileName.classList.remove('d-none');
            }
        });
        
        // Validasi form
        (function () {
            'use strict'
            
            const forms = document.querySelectorAll('.needs-validation')
            
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    });
</script>
@endsection