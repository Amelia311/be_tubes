@extends('Siswa.layouts.siswa')

@section('title', 'Konfirmasi Penarikan Dana - PIPGuard')

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
    
    .confirmation-card {
        background: var(--card-color);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 2.5rem;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        border: none;
    }
    
    .form-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.5rem;
        border-radius: 12px 12px 0 0;
        margin: -2.5rem -2.5rem 2rem -2.5rem;
    }
    
    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px dashed #e9ecef;
    }
    
    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .form-label-custom {
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 0.5rem;
    }
    
    .form-control-custom {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 0.8rem 1rem;
        transition: all 0.3s;
    }
    
    .form-control-custom:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .file-upload {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }
    
    .file-upload-input {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.8rem 1rem;
        border: 1px dashed #e9ecef;
        border-radius: 8px;
        background-color: #f8f9fa;
        color: var(--text-light);
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .file-upload-label:hover {
        border-color: var(--primary-color);
        background-color: rgba(67, 97, 238, 0.05);
    }
    
    .file-upload-icon {
        color: var(--primary-color);
        font-size: 1.2rem;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 12px 28px;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 8px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        color: white;
        width: 100%;
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 20px rgba(67, 97, 238, 0.4);
    }
    
    .info-text {
        color: var(--text-light);
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }
</style>
@endpush

@section('content')
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="confirmation-card animate__animated animate__fadeIn">
                <div class="form-header animate__animated animate__fadeInDown">
                    <h2 class="mb-0"><i class="fas fa-file-alt me-2"></i> Form Konfirmasi Penarikan Dana</h2>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger animate__animated animate__fadeIn">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ url('/siswa/konfirmasi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-section animate__animated animate__fadeIn animate-delay-1">
                        <h5 class="form-label-custom">Nama Siswa</h5>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user me-2 text-primary"></i>
                            <span class="fw-medium">{{ $siswa->nama }}</span>
                        </div>
                    </div>
                    
                    <div class="form-section animate__animated animate__fadeIn animate-delay-1">
                        <h5 class="form-label-custom">Tanggal Konfirmasi</h5>
                        <input type="date" name="tanggal" class="form-control form-control-custom" value="{{ $tanggal }}" required>
                        <p class="info-text">Tanggal saat Anda menerima dana</p>
                    </div>
                    
                    <div class="form-section animate__animated animate__fadeIn animate-delay-2">
                        <h5 class="form-label-custom">Dana yang diterima</h5>
                        <div class="input-group">
                            <span class="input-group-text bg-light">Rp</span>
                            <input type="number" name="jumlah_dana" class="form-control form-control-custom" value="{{ old('jumlah_dana') }}">
                            <!-- <input type="text" class="form-control form-control-custom" value="{{ number_format($siswa->jumlah, 0, ',', '.') }}" readonly> -->
                        </div>
                    </div>
                    
                    <div class="form-section animate__animated animate__fadeIn animate-delay-3">
                        <h5 class="form-label-custom mb-3">Bukti Penarikan</h5>
                        <div class="file-upload">
                            <input type="file" id="bukti" name="bukti" class="file-upload-input" accept="image/*" required>
                            <label for="bukti" class="file-upload-label">
                                <span id="file-name">Pilih file bukti penarikan</span>
                                <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                            </label>
                        </div>
                        <p class="info-text">Upload buku tabungan sebagai bukti</p>
                    </div>
                    
                    <div class="animate__animated animate__fadeIn animate-delay-4">
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update file name display
        const fileInput = document.querySelector('.file-upload-input');
        const fileName = document.getElementById('file-name');
        
        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = 'Pilih file bukti penarikan';
            }
        });
        
        // Animation on scroll
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