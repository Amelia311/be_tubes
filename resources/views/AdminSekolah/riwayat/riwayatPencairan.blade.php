@extends('AdminSekolah.layouts.admin')

@section('title', 'Riwayat Penarikan Dana')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

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
    
    /* Modal styles */
    .modal-override {
        z-index: 1060 !important; /* Pastikan di atas sidebar */
    }
    
    .modal-backdrop-override {
        z-index: 1050 !important;
    }
    
    .btn-konfirmasi {
        white-space: nowrap;
    }
    
    .dot {
        font-size: 1.5rem;
        color: #4e73df;
        animation: blink 1.2s infinite;
    }
    
    .dot:nth-child(2) { animation-delay: 0.2s; }
    .dot:nth-child(3) { animation-delay: 0.4s; }
    .dot:nth-child(4) { animation-delay: 0.6s; }
    .dot:nth-child(5) { animation-delay: 0.8s; }
    
    @keyframes blink {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 1; }
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
    /* Tambahan untuk memastikan modal berada di atas */
.modal-override {
    z-index: 1080 !important;
    position: relative;
}

.modal-backdrop.show {
    z-index: 1070 !important;
}
<style>
    /* Style khusus untuk modal konfirmasi */
    .modal-override .modal-content {
        max-width: 450px;
        margin: 0 auto;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
    
    .modal-override .modal-header {
        padding: 1.5rem 1.5rem 0;
    }
    
    .modal-override .modal-body {
        padding: 0 1.5rem 1.5rem;
    }
    
    .modal-override .modal-footer {
        padding: 0 1.5rem 1.5rem;
    }
    
    .modal-override .btn-close {
        top: 1.5rem;
        right: 1.5rem;
    }
    
    /* Animasi dots */
    .dot {
        font-size: 1.5rem;
        color: #4e73df;
        animation: blink 1.2s infinite;
        margin: 0 3px;
    }
    
    @keyframes blink {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 1; }
    }
    /* Pastikan modal di tengah dan di atas elemen lain */
    .modal-override {
        z-index: 1080 !important;
    }
    
    .modal-backdrop.show {
        z-index: 1070 !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-4">
    <div class="content-box animate__animated animate__fadeIn">
        <div class="header-table">
            <h3 class="animate__animated animate__fadeInDown">
                <i class="fas fa-history me-2"></i>Riwayat Penarikan
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
                        <th>NO REKENING</th>
                        <th>NOMINAL</th>
                        <th>STATUS</th>
                        <th>BUKTI</th>
                        <th>KONFIRMASI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="animate__animated animate__fadeIn">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->siswa->nama ?? '-' }}</td>
                            <td>{{ $item->siswa->no_rekening ?? '-' }}</td>
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
                                    <button 
                                        class="btn-konfirmasi btn btn-success"
                                        data-id="{{ $item->id }}"
                                        data-nama="{{ $item->siswa->nama }}"
                                        data-jumlah="{{ $item->jumlah }}"
                                        onclick="showConfirmationModal(this)">
                                        <i class="fas fa-link"></i> Konfirmasi ke Blockchain
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade modal-override" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4" style="border-radius: 15px;">
            <div class="modal-header border-0 d-flex flex-column">
                <h5 class="modal-title w-100 text-primary fw-bold mb-3" id="modalKonfirmasiLabel">
                    <i class="fas fa-link me-2"></i>Konfirmasi ke Blockchain
                </h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <p class="mb-4">Anda akan mencatat penarikan ini ke blockchain Sepolia:</p>
                
                <div class="d-flex flex-column align-items-center mb-4">
                    <div class="text-start w-100 mb-3">
                        <p class="mb-1"><strong>Nama Siswa:</strong></p>
                        <div class="bg-light p-3 rounded">
                            <span id="modalNama" class="fw-bold">Rahmatunnisa</span>
                        </div>
                    </div>
                    
                    <div class="text-start w-100">
                        <p class="mb-1"><strong>Jumlah:</strong></p>
                        <div class="bg-light p-3 rounded">
                            <span id="modalJumlah" class="fw-bold">Rp 200.000</span>
                        </div>
                    </div>
                </div>
                
                <div id="loadingDots" class="my-4" style="display: none;">
                    <span class="dot">●</span><span class="dot">●</span><span class="dot">●</span><span class="dot">●</span><span class="dot">●</span>
                </div>
                
                <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
                    <i class="fas fa-check-circle me-2"></i>
                    <span>Transaksi berhasil dicatat ke blockchain!</span>
                </div>
                
                <div id="errorMessage" class="alert alert-danger mt-3" style="display: none;">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <span id="errorText"></span>
                </div>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center gap-3">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal" id="cancelButton">Batal</button>
                <button type="button" class="btn btn-primary px-4" id="confirmButton" onclick="konfirmasiBlockchain()">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@1.10.0/dist/web3.min.js"></script>
<script>
    // Animasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
        });
    });
    
    let selectedId = null;
    let currentTransaction = null;
    const modalKonfirmasi = new bootstrap.Modal(document.getElementById('modalKonfirmasi'));

    function showConfirmationModal(button) {
        // Reset modal state
        document.getElementById('loadingDots').style.display = 'none';
        document.getElementById('successMessage').style.display = 'none';
        document.getElementById('errorMessage').style.display = 'none';
        document.getElementById('confirmButton').disabled = false;
        document.getElementById('cancelButton').disabled = false;
        
        // Set data transaksi
        currentTransaction = {
            id: button.getAttribute('data-id'),
            nama: button.getAttribute('data-nama'),
            jumlah: button.getAttribute('data-jumlah')
        };
        
        document.getElementById('modalNama').textContent = currentTransaction.nama;
        document.getElementById('modalJumlah').textContent = parseInt(currentTransaction.jumlah).toLocaleString('id-ID');
        
        modalKonfirmasi.show();
    }

    async function konfirmasiBlockchain() {
        if (!currentTransaction) return;
        
        const loadingDots = document.getElementById('loadingDots');
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        const confirmButton = document.getElementById('confirmButton');
        const cancelButton = document.getElementById('cancelButton');
        
        // Tampilkan loading dan nonaktifkan tombol
        loadingDots.style.display = 'block';
        successMessage.style.display = 'none';
        errorMessage.style.display = 'none';
        confirmButton.disabled = true;
        cancelButton.disabled = true;
        
        try {
            // 1. Cek apakah MetaMask terinstall
            if (typeof window.ethereum === 'undefined') {
                throw new Error("MetaMask tidak ditemukan! Silakan install MetaMask terlebih dahulu.");
            }
            
            // 2. Minta akses akun
            const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
            const from = accounts[0];
            
            // 3. Cek jaringan (Sepolia)
            const SEPOLIA_CHAIN_ID = '0xaa36a7';
            const currentChainId = await ethereum.request({ method: 'eth_chainId' });
            
            if (currentChainId !== SEPOLIA_CHAIN_ID) {
                try {
                    await ethereum.request({
                        method: 'wallet_switchEthereumChain',
                        params: [{ chainId: SEPOLIA_CHAIN_ID }]
                    });
                } catch (err) {
                    if (err.code === 4902) {
                        throw new Error("Jaringan Sepolia belum ditambahkan di MetaMask Anda.");
                    } else {
                        throw new Error("Gagal beralih ke jaringan Sepolia.");
                    }
                }
            }
            
            // 4. Siapkan kontrak
            const contractAddress = '0x254384728adfbbbf3134af4f3e792fc44cc295c8';
            const contractABI = [
                {
                    "anonymous": false,
                    "inputs": [
                        { "indexed": true, "internalType": "uint256", "name": "id", "type": "uint256" },
                        { "indexed": true, "internalType": "address", "name": "konfirmasiOleh", "type": "address" },
                        { "indexed": false, "internalType": "uint256", "name": "waktuKonfirmasi", "type": "uint256" }
                    ],
                    "name": "PencairanDicatat",
                    "type": "event"
                },
                {
                    "inputs": [{ "internalType": "uint256", "name": "_id", "type": "uint256" }],
                    "name": "catatPencairan",
                    "outputs": [],
                    "stateMutability": "nonpayable",
                    "type": "function"
                }
            ];
            
            const web3 = new Web3(window.ethereum);
            const contract = new web3.eth.Contract(contractABI, contractAddress);
            
            // 5. Kirim transaksi
            const tx = await contract.methods.catatPencairan(currentTransaction.id).send({ from });
            
            // 6. Simpan TX hash ke database
            const response = await fetch('/api/simpan-blockchain-tx', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    pencairan_id: currentTransaction.id,
                    blockchain_tx: tx.transactionHash
                })
            });
            
            if (!response.ok) {
                const result = await response.json();
                throw new Error(result.message || 'Gagal menyimpan ke database');
            }
            
            // Tampilkan pesan sukses
            loadingDots.style.display = 'none';
            successMessage.style.display = 'block';
            
            // Tutup modal setelah 2 detik dan reload halaman
            setTimeout(() => {
                modalKonfirmasi.hide();
                window.location.reload();
            }, 2000);
            
        } catch (error) {
            console.error('Error:', error);
            loadingDots.style.display = 'none';
            errorMessage.style.display = 'block';
            document.getElementById('errorText').textContent = error.message;
            
            // Aktifkan kembali tombol
            confirmButton.disabled = false;
            cancelButton.disabled = false;
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalKonfirmasi');
    document.body.appendChild(modal); // pastikan modal tidak dibungkus elemen terbatas
});

    
</script>
@endpush

@endsection