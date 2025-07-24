@extends('AdminSekolah.layouts.admin')

@section('title', 'Edit Siswa')

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
        --text-color: #5a5c69;
    }
    
    .content-box {
        background: white;
        border-radius: 15px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        overflow: hidden;
        animation: fadeIn 0.5s ease-in-out;
    }
    
    .form-container {
        padding: 2rem;
    }
    
    h3 {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
        animation: fadeInDown 0.5s ease-in-out;
    }
    
    h3::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background: var(--primary-color);
        border-radius: 3px;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d3e2;
        transition: all 0.3s;
        margin-bottom: 1.25rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }
    
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }
    
    .btn-submit {
        background-color: var(--success-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-submit:hover {
        background-color: #17a673;
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
    
    .btn-back {
        background-color: var(--secondary-color);
        color: var(--text-color);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    
    .btn-back:hover {
        background-color: #e6e6e6;
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
    
    .alert-success {
        border-left: 5px solid var(--success-color);
        animation: slideInRight 0.5s ease-in-out;
    }
    
    .alert-danger {
        border-left: 5px solid var(--danger-color);
        animation: slideInRight 0.5s ease-in-out;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        animation: fadeIn 0.5s ease-in-out;
    }
    
    .form-group label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-group label i {
        color: var(--primary-color);
    }
    
    .password-note {
        font-size: 0.85rem;
        color: var(--text-color);
        margin-top: -1rem;
        margin-bottom: 1.5rem;
        font-style: italic;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }
        
        .button-group {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-4">
    <div class="content-box animate__animated animate__fadeIn">
        <div class="form-container">
            <h3 class="animate__animated animate__fadeInDown">
                <i class="fas fa-user-edit me-2"></i>Edit Data Siswa
            </h3>
            
            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Validasi error --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0" style="padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="animate__animated animate__fadeIn">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="nama" class="form-label">
                        <i class="fas fa-user"></i> Nama Siswa
                    </label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $siswa->nama) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="nisn" class="form-label">
                        <i class="fas fa-id-card"></i> NISN
                    </label>
                    <input type="text" name="nisn" id="nisn" class="form-control" 
                        required value="{{ old('nisn') }}" 
                        inputmode="numeric" pattern="\d*" maxlength="10"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                
                <div class="form-group">
                    <label for="alamat" class="form-label">
                        <i class="fas fa-map-marker-alt"></i> Alamat
                    </label>
                    <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                </div>
                
                <div class="form-group">
                 <label for="no_rekening" class="form-label">
                 <i class="fas fa-credit-card"></i> No Rekening
                </label>
             <input type="text" name="no_rekening" id="no_rekening" class="form-control">
            </div>

            <div class="form-group">
    <label for="sk_pip" class="form-label">
        <i class="fas fa-file-contract"></i> SK PIP
    </label>
    <input type="file" name="sk_pip" id="sk_pip" class="form-control" accept=".pdf,.doc,.docx">
    <small class="text-muted">Format: PDF/DOC, maks 2MB</small>
        </div>

                
                <div class="form-group">
                    <label for="kelas" class="form-label">
                        <i class="fas fa-graduation-cap"></i> Kelas
                    </label>
                    <select name="kelas" id="kelas" class="form-select" required>
                        <option value="">Pilih Kelas</option>
                        <option value="X" {{ (old('kelas', $siswa->kelas) == 'X') ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ (old('kelas', $siswa->kelas) == 'XI') ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ (old('kelas', $siswa->kelas) == 'XII') ? 'selected' : '' }}>XII</option>
                    </select>
                </div>
                
                <div class="d-flex justify-content-between mt-4 button-group">
                    <a href="{{ route('siswa.index') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-submit animate__animated animate__pulse animate__infinite animate__slower">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
         </div>
         </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
    // Animasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            group.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endsection