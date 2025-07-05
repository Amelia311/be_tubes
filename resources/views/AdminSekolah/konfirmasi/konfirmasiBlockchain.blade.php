@extends('AdminSekolah.layouts.admin')

@section('title', 'Konfirmasi Pencairan')

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root {
  --primary-color: #4361ee;
  --secondary-color: #3f37c9;
  --accent-color: #4cc9f0;
  --success-color: #4ad66d;
  --warning-color: #f8961e;
  --danger-color: #f94144;
  --light-color: #f8f9fa;
  --dark-color: #212529;
}

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
  min-height: 100vh;
}

.main-content {
  padding: 2rem;
  animation: fadeIn 0.8s ease-in-out;
}

.content-box {
  background: white;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  padding: 2rem;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  overflow: hidden;
  position: relative;
}

.content-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}

.content-box::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 5px;
  background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
}

h3 {
  color: var(--primary-color);
  font-weight: 700;
  margin-bottom: 1.5rem;
  position: relative;
  display: inline-block;
}

h3::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 0;
  width: 50px;
  height: 4px;
  background: var(--accent-color);
  border-radius: 2px;
}

/* Table Styles */
.table-konfirmasi {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0 12px;
  margin-top: 1.5rem;
}

.table-konfirmasi thead th {
  background-color: var(--primary-color);
  color: white;
  padding: 15px;
  text-align: left;
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.85rem;
  letter-spacing: 0.5px;
  border: none;
}

.table-konfirmasi thead th:first-child {
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}

.table-konfirmasi thead th:last-child {
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
}

.table-konfirmasi tbody tr {
  background-color: white;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  border-radius: 10px;
  transition: all 0.3s ease;
  animation: fadeInUp 0.5s ease-out;
  animation-fill-mode: both;
}

.table-konfirmasi tbody tr:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.table-konfirmasi tbody td {
  padding: 15px;
  vertical-align: middle;
  border: none;
  position: relative;
}

.table-konfirmasi tbody td:first-child {
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}

.table-konfirmasi tbody td:last-child {
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
}

/* Status Badges */
.status {
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 600;
  display: inline-block;
}

.status.sudah {
  background-color: rgba(74, 214, 109, 0.15);
  color: var(--success-color);
}

.status.belum {
  background-color: rgba(248, 150, 30, 0.15);
  color: var(--warning-color);
}

.tx {
  color: #6c757d;
  font-size: 0.75rem;
  display: block;
  margin-top: 4px;
  word-break: break-all;
}

/* Button Styles */
.btn-konfirmasi {
  background:  #4ad66d;
  border: none;
  padding: 8px 16px;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.85rem;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
  position: relative;
  overflow: hidden;
}

.btn-konfirmasi:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
}

.btn-konfirmasi::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 5px;
  height: 5px;
  background: rgba(255, 255, 255, 0.5);
  opacity: 0;
  border-radius: 100%;
  transform: scale(1, 1) translate(-50%);
  transform-origin: 50% 50%;
}

.btn-konfirmasi:focus:not(:active)::after {
  animation: ripple 1s ease-out;
}

.btn-terkonfirmasi {
  background-color: #e9ecef;
  color: #6c757d;
  border: none;
  padding: 8px 16px;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.85rem;
  cursor: not-allowed;
}

/* Alert Box */
.alert-box {
  padding: 15px;
  border-radius: 10px;
  margin-bottom: 1.5rem;
  font-weight: 500;
  display: flex;
  align-items: center;
  animation: slideInDown 0.5s ease-out;
}

.alert-box.success {
  background-color: rgba(74, 214, 109, 0.15);
  color: var(--success-color);
  border-left: 4px solid var(--success-color);
}

.alert-box i {
  margin-right: 10px;
  font-size: 1.2rem;
}

/* Animations */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideInDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes ripple {
  0% {
    transform: scale(0, 0);
    opacity: 1;
  }
  20% {
    transform: scale(25, 25);
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: scale(40, 40);
  }
}

/* Responsive */
@media (max-width: 768px) {
  .content-box {
    padding: 1.5rem;
  }
  
  .table-konfirmasi thead {
    display: none;
  }
  
  .table-konfirmasi tbody tr {
    display: block;
    margin-bottom: 20px;
    animation: none;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  }
  
  .table-konfirmasi tbody td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    text-align: right;
  }
  
  .table-konfirmasi tbody td::before {
    content: attr(data-label);
    font-weight: 600;
    color: var(--primary-color);
    margin-right: auto;
    padding-right: 10px;
    text-align: left;
  }
  
  .table-konfirmasi tbody td:first-child {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  
  .table-konfirmasi tbody td:last-child {
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
  }
  
  .status {
    margin-left: auto;
  }
}

/* Floating Particles Background */
.particles {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
  overflow: hidden;
}

.particle {
  position: absolute;
  background: rgba(67, 97, 238, 0.1);
  border-radius: 50%;
  animation: float 15s infinite linear;
}

@keyframes float {
  0% {
    transform: translateY(0) rotate(0deg);
    opacity: 1;
  }
  100% {
    transform: translateY(-1000px) rotate(720deg);
    opacity: 0;
  }
}

/* Loading Animation */
.loading-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  display: none;
}

.loading-spinner {
  width: 50px;
  height: 50px;
  border: 5px solid rgba(67, 97, 238, 0.2);
  border-radius: 50%;
  border-top-color: var(--primary-color);
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Blockchain TX Link */
.tx-link {
  color: var(--primary-color);
  text-decoration: none;
  transition: all 0.3s ease;
}

.tx-link:hover {
  color: var(--secondary-color);
  text-decoration: underline;
}

/* Confirmation Modal */
.modal-confirm {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1000;
  justify-content: center;
  align-items: center;
  animation: fadeIn 0.3s ease-out;
}

.modal-content {
  background: white;
  border-radius: 15px;
  padding: 2rem;
  max-width: 500px;
  width: 90%;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  transform: translateY(0);
  animation: slideInUp 0.3s ease-out;
}

@keyframes slideInUp {
  from {
    transform: translateY(50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.modal-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--primary-color);
}

.modal-close {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  color: #6c757d;
  transition: all 0.3s ease;
}

.modal-close:hover {
  color: var(--danger-color);
  transform: rotate(90deg);
}

.modal-body {
  margin-bottom: 1.5rem;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

.btn-modal {
  padding: 8px 16px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-cancel {
  background: #e9ecef;
  color: #6c757d;
  border: none;
}

.btn-cancel:hover {
  background: #dee2e6;
}

.btn-confirm {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  color: white;
  border: none;
  box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
}

.btn-confirm:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
}

/* Blockchain Animation */
.blockchain-animation {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 20px 0;
  height: 60px;
}

.block {
  width: 12px;
  height: 12px;
  background: var(--primary-color);
  border-radius: 3px;
  margin: 0 5px;
  animation: pulse 1.5s infinite ease-in-out;
}

.block:nth-child(1) { animation-delay: 0s; }
.block:nth-child(2) { animation-delay: 0.2s; }
.block:nth-child(3) { animation-delay: 0.4s; }
.block:nth-child(4) { animation-delay: 0.6s; }
.block:nth-child(5) { animation-delay: 0.8s; }

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.3);
    opacity: 0.7;
  }
}

/* Success Animation */
.success-animation {
  display: flex;
  justify-content: center;
  margin: 20px 0;
}

.checkmark {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  display: block;
  stroke-width: 5;
  stroke: var(--success-color);
  stroke-miterlimit: 10;
  box-shadow: 0 0 0 rgba(74, 214, 109, 0.4);
  animation: checkmark-fill 0.4s ease-in-out 0.4s forwards, checkmark-scale 0.3s ease-in-out 0.9s both;
}

.checkmark-circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 5;
  stroke-miterlimit: 10;
  stroke: var(--success-color);
  fill: none;
  animation: checkmark-stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark-check {
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  animation: checkmark-stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes checkmark-stroke {
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes checkmark-scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}

@keyframes checkmark-fill {
  100% {
    box-shadow: inset 0 0 0 100px rgba(74, 214, 109, 0.1);
  }
}
</style>
@endpush

@section('content')
<div class="particles" id="particles"></div>

<div class="loading-overlay" id="loadingOverlay">
  <div class="loading-spinner"></div>
</div>

<div class="main-content animate__animated animate__fadeIn">
  <div class="content-box">
    <h3><i class="fas fa-check-circle"></i> Konfirmasi dan Catat Blockchain</h3>

    @if(session('success'))
      <div class="alert-box success animate__animated animate__slideInDown">
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
            <tr class="animate__animated animate__fadeInUp" style="animation-delay: {{ $index * 0.1 }}s">
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
  <div class="modal-content animate__animated animate__slideInUp">
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
// Create floating particles
function createParticles() {
  const particlesContainer = document.getElementById('particles');
  const particleCount = 20;
  
  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.classList.add('particle');
    
    // Random size between 5px and 15px
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

// Show loading overlay
function showLoading() {
  document.getElementById('loadingOverlay').style.display = 'flex';
}

// Hide loading overlay
function hideLoading() {
  document.getElementById('loadingOverlay').style.display = 'none';
}

// Current selected transaction data
let currentTransaction = null;

// Show confirmation modal
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

// Close modal
function closeModal() {
  document.getElementById('confirmationModal').style.display = 'none';
  currentTransaction = null;
}

// Confirm transaction
async function confirmTransaction() {
  const confirmButton = document.getElementById('confirmButton');
  confirmButton.disabled = true;
  confirmButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
  
  document.getElementById('transactionMessage').textContent = 'Menghubungkan ke MetaMask...';
  
  try {
    // Check if MetaMask is installed
    if (typeof window.ethereum === 'undefined') {
      throw new Error("🦊 MetaMask tidak ditemukan!");
    }
    
    document.getElementById('transactionMessage').textContent = 'Meminta koneksi ke MetaMask...';
    
    // Request account access
    const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
    const from = accounts[0];
    
    document.getElementById('transactionMessage').textContent = 'Mengonfirmasi jaringan...';
    
    // Check network (Sepolia Testnet)
    const SEPOLIA_CHAIN_ID = '0xaa36a7';
    const currentChainId = await ethereum.request({ method: 'eth_chainId' });
    
    if (currentChainId !== SEPOLIA_CHAIN_ID) {
      document.getElementById('transactionMessage').textContent = 'Beralih ke jaringan Sepolia...';
      
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
    
    document.getElementById('transactionMessage').textContent = 'Menyiapkan transaksi...';
    
    // Contract details
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
    
    // Send transaction
    const tx = await contract.methods.catatPencairan(currentTransaction.id).send({ from });
    
    document.getElementById('blockchainAnimation').style.display = 'none';
    document.getElementById('successAnimation').style.display = 'flex';
    document.getElementById('transactionMessage').textContent = 'Transaksi berhasil! Menyimpan ke database...';
    
    // Save to Laravel backend
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
    document.getElementById('transactionMessage').textContent = `❌ Error: ${error.message}`;
    document.getElementById('blockchainAnimation').style.display = 'none';
    confirmButton.disabled = false;
    confirmButton.innerHTML = 'Coba Lagi';
  }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
  createParticles();
});

</script>
<script src="https://cdn.jsdelivr.net/npm/web3@1.10.0/dist/web3.min.js"></script>
<script>
  function handleClick(button) {
    const id = button.getAttribute('data-id');
    const nama = button.getAttribute('data-nama');
    const jumlah = button.getAttribute('data-jumlah');
    konfirmasiKeBlockchain(id, nama, jumlah);
  }

  const konfirmasiKeBlockchain = async (id, nama, jumlah) => {
    if (typeof window.ethereum === 'undefined') {
      alert("🦊 MetaMask tidak ditemukan!");
      return;
    }

    const SEPOLIA_CHAIN_ID = '0xaa36a7'; // = 11155111 (Sepolia Testnet)
    const currentChainId = await ethereum.request({ method: 'eth_chainId' });

    // Cek apakah user di jaringan Sepolia
    if (currentChainId !== SEPOLIA_CHAIN_ID) {
      try {
        await ethereum.request({
          method: 'wallet_switchEthereumChain',
          params: [{ chainId: SEPOLIA_CHAIN_ID }]
        });
      } catch (err) {
        // Kalau jaringan belum ditambahkan ke MetaMask
        if (err.code === 4902) {
          alert("Jaringan Sepolia belum ditambahkan di MetaMask kamu.");
        } else {
          alert("Gagal beralih ke jaringan Sepolia.");
        }
        return;
      }
    }

    // Request akses akun
    const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
    const from = accounts[0];

    // Kontrak yang sudah kamu deploy ke Sepolia
    const contractAddress = '0x254384728adfbbbf3134af4f3e792fc44cc295c8'; // HARUS dari Sepolia
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

    try {
      const tx = await contract.methods.catatPencairan(id).send({ from });

      // Simpan ke backend Laravel
      await fetch('/api/simpan-blockchain-tx', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
          pencairan_id: id,
          blockchain_tx: tx.transactionHash
        })
      });

      alert('✅ Berhasil dicatat ke blockchain Sepolia & database!');
      window.location.reload();

    } catch (error) {
      console.error(error);
      alert('❌ Gagal mencatat ke blockchain.');
    }
  };
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
@endsection
