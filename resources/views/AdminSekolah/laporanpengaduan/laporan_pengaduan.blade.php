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
    .modal-konfirmasi .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .modal-konfirmasi .modal-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--info-color) 100%);
        color: white;
        border-bottom: none;
    }
    
    .modal-konfirmasi .modal-footer {
        border-top: none;
        justify-content: center;
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
                    <!-- Contoh data 1 - Status Diajukan -->
                    <tr class="animate__animated animate__fadeIn">
                        <td>1</td>
                        <td>Siti Nur Aisah</td>
                        <td>XII</td>
                        <td>Belum menerima dana PIP</td>
                        <td>
                            <a href="#" class="link view-bukti" data-image="https://example.com/bukti1.jpg">
                                <i class="fas fa-file-image"></i> Lihat Bukti
                            </a>
                        </td>
                        <td>
                            <select class="form-select form-select-sm tindakan-select" data-pengaduan-id="1">
                                <option value="diajukan" selected>Diajukan</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            <button class="btn btn-sm btn-primary mt-2 btn-konfirmasi" style="display: none;">
                                <i class="fas fa-paper-plane me-1"></i> Konfirmasi
                            </button>
                        </td>
                        <td>
                            <span class="status-badge status-diajukan">
                                <i class="fas fa-clock me-1"></i> Diajukan
                            </span>
                        </td>
                    </tr>
                    
                    <!-- Contoh data 2 - Status Diproses -->
                    <tr class="animate__animated animate__fadeIn">
                        <td>2</td>
                        <td>Ahmad Rizki</td>
                        <td>XI</td>
                        <td>Nominal tidak sesuai</td>
                        <td>
                            <a href="#" class="link view-bukti" data-image="https://example.com/bukti2.jpg">
                                <i class="fas fa-file-image"></i> Lihat Bukti
                            </a>
                        </td>
                        <td>
                            <select class="form-select form-select-sm tindakan-select" data-pengaduan-id="2">
                                <option value="diajukan">Diajukan</option>
                                <option value="diproses" selected>Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            <button class="btn btn-sm btn-primary mt-2 btn-konfirmasi" style="display: none;">
                                <i class="fas fa-paper-plane me-1"></i> Konfirmasi
                            </button>
                        </td>
                        <td>
                            <span class="status-badge status-diproses">
                                <i class="fas fa-spinner me-1"></i> Diproses
                            </span>
                        </td>
                    </tr>
                    
                    <!-- Contoh data 3 - Status Selesai -->
                    <tr class="animate__animated animate__fadeIn">
                        <td>3</td>
                        <td>Budi Santoso</td>
                        <td>X</td>
                        <td>Kartu PIP hilang</td>
                        <td>
                            <a href="#" class="link view-bukti" data-image="https://example.com/bukti3.jpg">
                                <i class="fas fa-file-image"></i> Lihat Bukti
                            </a>
                        </td>
                        <td>
                            <select class="form-select form-select-sm tindakan-select" data-pengaduan-id="3">
                                <option value="diajukan">Diajukan</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai" selected>Selesai</option>
                            </select>
                            <button class="btn btn-sm btn-primary mt-2 btn-konfirmasi" style="display: none;">
                                <i class="fas fa-paper-plane me-1"></i> Konfirmasi
                            </button>
                        </td>
                        <td>
                            <span class="status-badge status-selesai">
                                <i class="fas fa-check-circle me-1"></i> Selesai
                            </span>
                        </td>
                    </tr>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js"></script>
<script>
    // Data untuk simulasi
    let currentPengaduan = null;
    let newStatus = null;
    
    // Fungsi pencarian
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#pengaduanTable tbody tr');
        
        rows.forEach(row => {
            const nama = row.cells[1].textContent.toLowerCase();
            const kelas = row.cells[2].textContent.toLowerCase();
            const masalah = row.cells[3].textContent.toLowerCase();
            
            if (nama.includes(searchValue) || kelas.includes(searchValue) || masalah.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Fungsi preview bukti
    document.querySelectorAll('.view-bukti').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const imageUrl = this.getAttribute('data-image');
            const previewModal = new bootstrap.Modal(document.getElementById('previewImageModal'));
            
            document.getElementById('previewImage').src = imageUrl;
            previewModal.show();
        });
    });

    // Inisialisasi image viewer
    const imageViewer = new Viewer(document.getElementById('previewImage'), {
        inline: false,
        toolbar: {
            zoomIn: 1,
            zoomOut: 1,
            oneToOne: 1,
            reset: 1,
            rotateLeft: 1,
            rotateRight: 1,
            flipHorizontal: 1,
            flipVertical: 1,
        },
    });

    // Fungsi ketika select tindakan diubah
    document.querySelectorAll('.tindakan-select').forEach(select => {
        select.addEventListener('change', function() {
            const row = this.closest('tr');
            const btnKonfirmasi = row.querySelector('.btn-konfirmasi');
            
            // Tampilkan tombol konfirmasi
            btnKonfirmasi.style.display = 'block';
            
            // Simpan data pengaduan yang dipilih
            btnKonfirmasi.setAttribute('data-pengaduan-id', this.getAttribute('data-pengaduan-id'));
            btnKonfirmasi.setAttribute('data-new-status', this.value);
        });
    });

    // Fungsi ketika tombol konfirmasi diklik
    document.querySelectorAll('.btn-konfirmasi').forEach(btn => {
        btn.addEventListener('click', function() {
            const pengaduanId = this.getAttribute('data-pengaduan-id');
            newStatus = this.getAttribute('data-new-status');
            
            // Tampilkan modal konfirmasi
            const konfirmasiModal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
            
            // Set teks status di modal
            const statusText = document.getElementById('statusKonfirmasi');
            if (newStatus === 'diajukan') {
                statusText.innerHTML = '<span class="status-badge status-diajukan"><i class="fas fa-clock me-1"></i> Diajukan</span>';
            } else if (newStatus === 'diproses') {
                statusText.innerHTML = '<span class="status-badge status-diproses"><i class="fas fa-spinner me-1"></i> Diproses</span>';
            } else {
                statusText.innerHTML = '<span class="status-badge status-selesai"><i class="fas fa-check-circle me-1"></i> Selesai</span>';
            }
            
            // Simpan data pengaduan yang dipilih
            currentPengaduan = {
                id: pengaduanId,
                newStatus: newStatus
            };
            
            konfirmasiModal.show();
        });
    });

    // Fungsi ketika tombol submit di modal konfirmasi diklik
    document.getElementById('btnSubmitKonfirmasi').addEventListener('click', function() {
        if (!currentPengaduan) return;
        
        const konfirmasiModal = bootstrap.Modal.getInstance(document.getElementById('konfirmasiModal'));
        
        // Temukan baris yang sesuai
        const row = document.querySelector(`tr [data-pengaduan-id="${currentPengaduan.id}"]`).closest('tr');
        const statusBadge = row.querySelector('.status-badge');
        const btnKonfirmasi = row.querySelector('.btn-konfirmasi');
        
        // Update tampilan status
        statusBadge.className = `status-badge status-${currentPengaduan.newStatus}`;
        
        if (currentPengaduan.newStatus === 'diajukan') {
            statusBadge.innerHTML = '<i class="fas fa-clock me-1"></i> Diajukan';
        } else if (currentPengaduan.newStatus === 'diproses') {
            statusBadge.innerHTML = '<i class="fas fa-spinner me-1"></i> Diproses';
        } else {
            statusBadge.innerHTML = '<i class="fas fa-check-circle me-1"></i> Selesai';
        }
        
        // Sembunyikan tombol konfirmasi
        btnKonfirmasi.style.display = 'none';
        
        // Tutup modal
        konfirmasiModal.hide();
        
        // Tampilkan notifikasi sukses
        alert(`Status pengaduan #${currentPengaduan.id} berhasil diubah menjadi "${currentPengaduan.newStatus}" dan telah dikirim ke siswa.`);
        
        // Di implementasi nyata, di sini akan ada AJAX request ke backend
        console.log(`Mengupdate status pengaduan ${currentPengaduan.id} menjadi ${currentPengaduan.newStatus}`);
    });
    
</script>
@endpush

@endsection