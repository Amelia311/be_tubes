@extends('AdminSekolah.layouts.admin')

@section('title', 'Konfirmasi Pencairan')

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

    .status.ditolak {
        background-color: rgba(231, 74, 59, 0.2);
        color: var(--danger-color);
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
            <h3 class="animate__animated animate__fadeInDown">
                <i class="fas fa-check-circle me-2"></i>Konfirmasi Pencairan
            </h3>
            <form method="GET" action="{{ route('konfirmasi.form') }}" class="search-box animate__animated animate__fadeIn">
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
                        <th>JUMLAH</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="animate__animated animate__fadeIn">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->siswa->nama ?? '-' }}</td>
                            <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td>
                                <span class="status 
                                    {{ strtolower($item->status) == 'sudah cair' ? 'sudah' : (strtolower($item->status) == 'ditolak' ? 'ditolak' : 'menunggu') }}">
                                    <i class="fas 
                                        {{ strtolower($item->status) == 'sudah cair' ? 'fa-check-circle' : (strtolower($item->status) == 'ditolak' ? 'fa-times-circle' : 'fa-clock') }} me-1"></i>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                @if(strtolower($item->status) == 'menunggu')
                                <form method="POST" action="{{ route('konfirmasi.index', $item->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm me-1" title="Setujui">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('konfirmasi.update', $item->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" title="Tolak">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-row">
                                <i class="fas fa-info-circle fa-2x mb-3" style="color: var(--info-color);"></i>
                                <p class="mb-0">Tidak ada data konfirmasi pencairan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<<<<<<< HEAD
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
        });
    });

=======
<div class="main-content animate_animated animate_fadeIn">
  <div class="content-box">
    <h3><i class="fas fa-check-circle"></i> Konfirmasi dan Catat Blockchain</h3>

    @if(session('success'))
      <div class="alert-box success animate_animated animate_slideInDown">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif

    <table class="table-konfirmasi mt-3">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Asal Sekolah</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr class="animate_animated animate_fadeInUp" style="animation-delay: {{ $index * 0.1 }}s">
                <td data-label="Nama Siswa">{{ $item->siswa->nama }}</td>
                <td data-label="Asal Sekolah">{{ $item->siswa->asal_sekolah }}</td>
                <td data-label="Tanggal">{{ optional($item->created_at)->format('Y-m-d') ?? '-' }}</td>
                <td data-label="Jumlah">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td data-label="Status">
                    @if($item->status == 'Sudah Cair')
                        <span class="status sudah"><i class="fas fa-check-circle"></i> Sudah Cair</span><br>
                        <small class="tx">
                          TX: <a href="https://sepolia.etherscan.io/tx/{{ $item->blockchain_tx }}" target="_blank" class="tx-link">{{ Str::limit($item->blockchain_tx, 10) }}</a>
                        </small>
                    @else
                        <span class="status belum"><i class="fas fa-clock"></i> Belum Cair</span>
                    @endif
                </td>
                <td data-label="Aksi">
                    @if($item->status == 'Menunggu')
                    <button 
                        class="btn-konfirmasi"
                        data-id="{{ $item->id }}"
                        data-nama="{{ $item->siswa->nama }}"
                        data-jumlah="{{ $item->jumlah }}"
                        onclick="showConfirmationModal(this)">
                        <i class="fas fa-link"></i> Konfirmasi ke Blockchain
                    </button>
                    @else
                    <button class="btn-terkonfirmasi" disabled><i class="fas fa-check"></i> Terkonfirmasi</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>

<!-- Confirmation Modal -->
<div class="modal-confirm" id="confirmationModal">
  <div class="modal-content animate_animated animate_slideInUp">
    <div class="modal-header">
      <h4 class="modal-title"><i class="fas fa-link"></i> Konfirmasi ke Blockchain</h4>
      <button class="modal-close" onclick="closeModal()">&times;</button>
    </div>
    <div class="modal-body">
      <p>Anda akan mencatat pencairan ini ke blockchain Sepolia:</p>
      <div class="confirmation-details">
        <p><strong>Nama Siswa:</strong> <span id="modalNama"></span></p>
        <p><strong>Jumlah:</strong> Rp <span id="modalJumlah"></span></p>
      </div>
      
      <div class="blockchain-animation" id="blockchainAnimation">
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
      </div>
      
      <div class="success-animation" id="successAnimation" style="display: none;">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
          <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
          <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
      </div>
      
      <p id="transactionMessage" style="text-align: center; margin-top: 15px; font-weight: 500;"></p>
    </div>
    <div class="modal-footer">
      <button class="btn-modal btn-cancel" onclick="closeModal()">Batal</button>
      <button class="btn-modal btn-confirm" id="confirmButton" onclick="confirmTransaction()">Konfirmasi</button>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/web3@1.10.0/dist/web3.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  createParticles();
});

// Buat partikel latar belakang
function createParticles() {
  const particlesContainer = document.getElementById('particles');
  const particleCount = 20;

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.classList.add('particle');

    const size = Math.random() * 10 + 5;
    particle.style.width = `${size}px`;
    particle.style.height = `${size}px`;
    
    // Random position
    particle.style.left = `${Math.random() * 100}%`;
    particle.style.top = `${Math.random() * 100}%`;
    
    // Random animation duration between 10s and 20s
    const duration = Math.random() * 10 + 10;
    particle.style.animationDuration = `${duration}s`;
    
    // Random delay
    particle.style.animationDelay = `${Math.random() * 5}s`;
    
    particlesContainer.appendChild(particle);
  }
}

// Modal konfirmasi
let currentTransaction = null;

function showConfirmationModal(button) {
  currentTransaction = {
    id: button.getAttribute('data-id'),
    nama: button.getAttribute('data-nama'),
    jumlah: button.getAttribute('data-jumlah')
  };

  document.getElementById('modalNama').textContent = currentTransaction.nama;
  document.getElementById('modalJumlah').textContent = parseInt(currentTransaction.jumlah).toLocaleString('id-ID');
  document.getElementById('confirmationModal').style.display = 'flex';
  document.getElementById('blockchainAnimation').style.display = 'flex';
  document.getElementById('successAnimation').style.display = 'none';
  document.getElementById('transactionMessage').textContent = '';
}

function closeModal() {
  document.getElementById('confirmationModal').style.display = 'none';
  currentTransaction = null;
}

async function confirmTransaction() {
  const confirmButton = document.getElementById('confirmButton');
  confirmButton.disabled = true;
  confirmButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
  document.getElementById('transactionMessage').textContent = 'Menghubungkan ke MetaMask...';

  try {
    if (typeof window.ethereum === 'undefined') {
      throw new Error("🦊 MetaMask tidak ditemukan!");
    }

    const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
    const from = accounts[0];

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
          throw new Error("Jaringan Sepolia belum ditambahkan di MetaMask kamu.");
        } else {
          throw new Error("Gagal beralih ke jaringan Sepolia.");
        }
      }
    }

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
      },
      {
        "inputs": [{ "internalType": "uint256", "name": "_id", "type": "uint256" }],
        "name": "getPencairan",
        "outputs": [
          {
            "components": [
              { "internalType": "uint256", "name": "id", "type": "uint256" },
              { "internalType": "address", "name": "konfirmasiOleh", "type": "address" },
              { "internalType": "uint256", "name": "waktuKonfirmasi", "type": "uint256" }
            ],
            "internalType": "struct DanaPIP.Pencairan",
            "name": "",
            "type": "tuple"
          }
        ],
        "stateMutability": "view",
        "type": "function"
      }
    ];

    const web3 = new Web3(window.ethereum);
    const contract = new web3.eth.Contract(contractABI, contractAddress);

    document.getElementById('transactionMessage').textContent = 'Mengirim transaksi ke blockchain...';

    const tx = await contract.methods.catatPencairan(currentTransaction.id).send({ from });

    document.getElementById('blockchainAnimation').style.display = 'none';
    document.getElementById('successAnimation').style.display = 'flex';
    document.getElementById('transactionMessage').textContent = 'Transaksi berhasil! Menyimpan ke database...';

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

    const result = await response.json();

    if (response.ok) {
      document.getElementById('transactionMessage').textContent = 
        `✅ Berhasil dicatat! TX: ${tx.transactionHash.substring(0, 10)}...`;
      
      // Close modal and reload after 2 seconds
      setTimeout(() => {
        closeModal();
        window.location.reload();
      }, 2000);
    } else {
      throw new Error(result.message || 'Gagal menyimpan ke database');
    }

  } catch (error) {
    console.error(error);
    document.getElementById('transactionMessage').textContent = ❌ Error: ${error.message};
    document.getElementById('blockchainAnimation').style.display = 'none';
    confirmButton.disabled = false;
    confirmButton.innerHTML = 'Coba Lagi';
  }
}
>>>>>>> 3b77e16901a171e76a7d8e7da52e82ded8d99696
</script>
@endsection