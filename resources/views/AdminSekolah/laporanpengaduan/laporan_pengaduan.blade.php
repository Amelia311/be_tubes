@extends('AdminSekolah.layouts.admin')

@section('title', 'Laporan Pengaduan Siswa')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Modal Image Viewer CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css">
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
        background: white;
        border-radius: 50px;
        padding: 0.5rem 1rem;
        width: 300px;
        max-width: 100%;
    }

    .search-box .form-control {
        border: none;
        box-shadow: none;
    }

    .search-box .form-control:focus {
        outline: none;
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

    /* Status Badge Styles */
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .status-diajukan {
        background-color: rgba(78, 115, 223, 0.2);
        color: var(--primary-color);
    }
    
    .status-diproses {
        background-color: rgba(246, 194, 62, 0.2);
        color: var(--warning-color);
    }
    
    .status-selesai {
        background-color: rgba(28, 200, 138, 0.2);
        color: var(--success-color);
    }

    /* Select Input Styles */
    .tindakan-select {
        min-width: 120px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .tindakan-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }

    /* Preview Image Modal */
    .modal-preview-image .modal-dialog {
        max-width: 90%;
        max-height: 90vh;
    }
    
    .modal-preview-image .modal-content {
        background: transparent;
        border: none;
    }
    
    .modal-preview-image .modal-body {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }
    
    .modal-preview-image img {
        max-height: 80vh;
        max-width: 100%;
        object-fit: contain;
    }

    /* Konfirmasi Modal */

    /* Paksa modal konfirmasi keluar dari container */
/* Hanya untuk modal konfirmasi */
.modal-konfirmasi.modal.show {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    z-index: 1055 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    overflow: hidden !important;
}

.modal-konfirmasi .modal-dialog {
    margin: 0 !important;
    transform: none !important;
}



/* #konfirmasiModal.show {
    position: fixed !important;
    top: 50% !important;
    left: 50% !important;
    transform: translate(-50%, -50%) !important;
    margin: 0 !important;
    z-index: 9999 !important;
} */


    .modal-konfirmasi .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .modal-konfirmasi .modal-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--info-color) 100%);
        color: white;
        border-bottom: none;
    }
/*     
    .modal-konfirmasi .modal-footer {
        border-top: none;
        justify-content: center;
    }

    .modal.show {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .modal.fade .modal-dialog {
        margin: 0 auto !important;
        transform: none !important;
    } */


    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    /* .modal-backdrop {
        display: none !important;
    } */
</style>
@endpush

@section('content')
<div class="container-fluid p-4">
    <div class="content-box animate__animated animate__fadeIn">
        <div class="header-table">
            <h3 class="animate__animated animate__fadeInDown">
                <i class="fas fa-exclamation-circle me-2"></i>Laporan Pengaduan Siswa
            </h3>
            <div class="search-box animate__animated animate__fadeIn">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama siswa...">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" id="pengaduanTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>KELAS</th>
                        <th>MASALAH</th>
                        <th>BUKTI</th>
                        <th>TINDAKAN</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($pengaduan as $index => $item)
        <tr class="animate__animated animate__fadeIn">
            <td>{{ $index+1 }}</td>
            <td>{{ $item['nama'] }}</td>
            <td>{{ $item['kelas'] }}</td>
            <td>{{ $item['pesan'] }}</td>
            <td>
                @if(!empty($item['bukti']))
                    <a href="{{ asset('storage/' . $item['bukti']) }}" class="link view-bukti" target="_blank" data-image="{{ asset('storage/' . $item['bukti']) }}">
                        <i class="fas fa-file-image"></i> Lihat Bukti
                    </a>
                @else
                    <span class="text-muted">Tidak ada bukti</span>
                @endif
            </td>
            <td>
            <select class="form-select form-select-sm tindakan-select" 
        data-id="{{ $item['id'] }}" 
        data-tipe="{{ $item['tipe'] }}"
        {{ $item['status'] == 'selesai' ? 'disabled' : '' }}>

                    <option value="diajukan" {{ $item['status'] == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="diproses" {{ $item['status'] == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ $item['status'] == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button class="btn btn-sm btn-primary mt-2 btn-konfirmasi" style="display:none;">
                    <i class="fas fa-paper-plane me-1"></i> Konfirmasi
                </button>
            </td>
            <td>
                <span class="status-badge 
                    @if($item['status'] == 'diajukan') status-diajukan 
                    @elseif($item['status'] == 'diproses') status-diproses 
                    @else status-selesai @endif">
                    <i class="fas 
                        @if($item['status'] == 'diajukan') fa-clock 
                        @elseif($item['status'] == 'diproses') fa-spinner 
                        @else fa-check-circle @endif me-1"></i> 
                    {{ ucfirst($item['status']) }}
                </span> 
            </td>
        </tr>
    @endforeach
</tbody>


            </table>
        </div>
    </div>
</div>

<!-- Modal Preview Image -->
<div class="modal fade modal-override modal-preview-image" id="previewImageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="previewImage" src="" alt="Bukti Pengaduan" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Tindakan -->
<div class="modal fade modal-override modal-konfirmasi" id="konfirmasiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle me-2"></i>Konfirmasi Perubahan Status
                </h5>
            </div>
            <div class="modal-body text-center">
                <p>Anda akan mengubah status pengaduan menjadi:</p>
                <h4 id="statusKonfirmasi" class="fw-bold mb-4"></h4>
                <p>Status ini akan dikirim ke siswa dan muncul di transparansi.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSubmitKonfirmasi">
                    <i class="fas fa-paper-plane me-1"></i> Konfirmasi
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js"></script>
<script>
document.querySelectorAll('.tindakan-select').forEach(select => {
    select.addEventListener('change', function() {
        const btn = this.nextElementSibling;
        if (this.disabled) {
            btn.style.display = 'none';
        } else {
            btn.style.display = 'inline-block';
        }
    });
});


document.querySelectorAll('.btn-konfirmasi').forEach(btn => {
    btn.addEventListener('click', function() {
        const select = this.previousElementSibling;
        if (select.disabled) {
            alert('Status sudah selesai, tidak bisa diubah.');
            return; // batalkan proses
        }

        const id = select.dataset.id;
        const tipe = select.dataset.tipe;
        const status = select.value;

        // Tampilkan modal konfirmasi
        document.getElementById('statusKonfirmasi').innerText = status.toUpperCase();
        const konfirmasiModal = new bootstrap.Modal(document.getElementById('konfirmasiModal'), {
            backdrop: false
        });
        konfirmasiModal.show();

        document.getElementById('btnSubmitKonfirmasi').onclick = function () {
            let url = '';
            if (tipe === 'pengaduan') {
                url = `{{ url('admin/pengaduan') }}/${id}/status`;
            } else if (tipe === 'laporan') {
                url = `{{ url('admin/laporan') }}/${id}/status`;
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status })
            })
            .then(res => {
                if (!res.ok) throw new Error('Request gagal');
                return res.json();
            })
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan saat mengupdate status.');
            });
        };
    });
});

</script>
@endpush
