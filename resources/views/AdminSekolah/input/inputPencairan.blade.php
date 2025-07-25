@extends('AdminSekolah.layouts.admin')

@section('title', 'Input Penarikan Dana')

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
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d3e2;
        transition: all 0.3s;
        margin-bottom: 1.5rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
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
        width: 100%;
        justify-content: center;
        margin-top: 1rem;
    }
    
    .btn-submit:hover {
        background-color: #17a673;
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
        margin-bottom: 1rem;
        animation: fadeIn 0.5s ease-in-out;
    }
    
    .input-group-text {
        background-color: var(--secondary-color);
        border: 1px solid #d1d3e2;
        border-right: none;
    }
    
    .currency-input {
        border-left: none;
        padding-left: 0;
    }
    
    .currency-input:focus {
        border-left: none;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-4">
    <div class="content-box animate__animated animate__fadeIn">
        <div class="form-container">
            <h3 class="animate__animated animate__fadeInDown">
                <i class="fas fa-money-bill-wave me-2"></i>Input Penarikan Dana
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
            
            <form method="POST" action="{{ route('pencairan.store') }}" class="animate__animated animate__fadeIn">
                @csrf
                
                <div class="form-group">
                    <label for="siswa_id" class="form-label">
                        <i class="fas fa-user-graduate"></i> Pilih Siswa
                    </label>
                    <select class="form-select" id="siswa_id" name="siswa_id" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswa as $item)
                            <option value="{{ $item->id }}" {{ old('siswa_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
    <label for="nomor_rekening" class="form-label">
        <i class="fas fa-credit-card"></i> Nomor Rekening
    </label>
    <input type="text"
           class="form-control"
           id="nomor_rekening"
           name="nomor_rekening"
           value="{{ old('nomor_rekening') }}"
           placeholder="Masukkan 10 digit nomor rekening "
           required
           maxlength="10"
           inputmode="numeric"/>
                
                <div class="form-group">
                    <label for="tanggal_cair" class="form-label">
                        <i class="fas fa-calendar-alt"></i> Tanggal Penarikan
                    </label>
                    <input type="date" class="form-control" id="tanggal_cair" name="tanggal_cair" 
                           value="{{ old('tanggal_cair') }}" 
                           max="{{ date('Y-m-d') }}" 
                           min="2000-01-01" required />
                </div>

                <div class="form-group">
                    <label for="jumlah" class="form-label">
                        <i class="fas fa-money-bill"></i> Nominal yang Diterima
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control currency-input" id="jumlah" name="jumlah" 
                               value="{{ old('jumlah') }}" 
                               placeholder="Contoh: 500000" 
                               required 
                               oninput="formatCurrency(this)" />
                    </div>
                </div>


                <div class="form-group">
                    <label for="keterangan" class="form-label">
                        <i class="fas fa-info-circle"></i> Keterangan
                    </label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" 
                           value="{{ old('keterangan') }}" 
                           placeholder="Contoh: Semester 1" required />
                </div>
                
                <button type="submit" class="btn btn-submit animate__animated animate__pulse animate__infinite animate__slower">
                    <i class="fas fa-save"></i> Simpan 
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
    // Format input currency
    function formatCurrency(input) {
        // Hapus semua karakter non-digit
        let value = input.value.replace(/\D/g, '');
        
        // Simpan nilai asli ke hidden field
        input.value = value;
        
        // Tampilkan nilai yang sudah diformat (opsional)
        // input.value = new Intl.NumberFormat('id-ID').format(value);
    }

    // Animasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            group.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Set tanggal default ke hari ini
        if (!document.getElementById('tanggal_cair').value) {
            document.getElementById('tanggal_cair').valueAsDate = new Date();
        }
    });
     function formatRekening(input) {
        let value = input.value.replace(/\D/g, '').substring(0, 15); // ambil hanya angka, max 15 digit
        let formatted = value.replace(/(.{4})/g, '$1 ').trim(); // beri spasi tiap 4 digit
        input.value = formatted;
    }
</script>
@endsection