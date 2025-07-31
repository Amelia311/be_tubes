@extends('Siswa.layouts.siswa')

@section('title', 'Laporan Ketidaksesuaian - PIPGuard')

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
    
    .report-card {
        background: var(--card-color);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 2.5rem;
        margin: 2rem auto;
        max-width: 800px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }
    
    .report-header {
        border-bottom: 2px solid rgba(67, 97, 238, 0.1);
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .report-header h2 {
        color: var(--primary-color);
        font-weight: 700;
        display: flex;
        align-items: center;
    }
    
    .report-header h2 i {
        margin-right: 0.8rem;
        font-size: 1.8rem;
    }
    
    /* Alert Styles */
    .alert-success {
        background-color: rgba(76, 201, 240, 0.1);
        border-left: 4px solid var(--success-color);
        color: var(--text-color);
        border-radius: 8px;
    }
    
    .alert-danger {
        background-color: rgba(247, 37, 133, 0.1);
        border-left: 4px solid var(--danger-color);
        color: var(--text-color);
        border-radius: 8px;
    }
    
    /* Form Styles */
    .form-label {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
    }
    
    .form-label i {
        margin-right: 0.6rem;
        font-size: 1.1rem;
    }
    
    .form-control, .form-select, .form-textarea {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.8rem 1.2rem;
        transition: all 0.3s;
    }
    
    .form-textarea {
        min-height: 150px;
        width: 100%;
    }
    
    .form-control:focus, .form-select:focus, .form-textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    /* File Upload */
    .file-upload {
        position: relative;
        overflow: hidden;
        border: 2px dashed #e9ecef;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s;
        background-color: #f8f9fa;
        margin-top: 1rem;
    }
    
    .file-upload:hover {
        border-color: var(--primary-color);
        background-color: rgba(67, 97, 238, 0.05);
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
        color: var(--text-light);
    }
    
    .file-upload-label i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--primary-color);
    }
    
    .file-name {
        margin-top: 1rem;
        font-size: 0.9rem;
        color: var(--text-color);
        font-weight: 500;
    }
    
    /* Button Styles */
    .btn-submit {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 0.9rem 2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 10px;
        transition: all 0.3s;
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-top: 1.5rem;
        width: 100%;
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 20px rgba(67, 97, 238, 0.4);
        color: white;
    }
    
    .btn-submit i {
        margin-right: 0.7rem;
    }
    
    /* Animations */
    .animate-delay-1 { animation-delay: 0.2s; }
    .animate-delay-2 { animation-delay: 0.4s; }
</style>
@endpush

@section('content')
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="report-card animate__animated animate__fadeIn">
                <div class="report-header">
                    <h2 class="animate__animated animate__fadeInDown">
                        <i class="fas fa-exclamation-triangle"></i> Form Laporan Masalah
                    </h2>
                    <p class="text-muted animate__animated animate__fadeIn animate-delay-1">
                        Silakan isi formulir ini untuk melaporkan masalah atau kendala terkait Program Indonesia Pintar (PIP). Laporan Anda akan membantu kami untuk menindaklanjuti agar lebih baik ke depannya
                    </p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn animate-delay-1 mb-4">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger animate__animated animate__fadeIn animate-delay-1 mb-4">
                        <h5 class="mb-2"><i class="fas fa-exclamation-circle me-2"></i> Terjadi Kesalahan</h5>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="form-laporan" action="{{ route('siswa.laporStore') }}" method="POST" enctype="multipart/form-data" class="animate__animated animate__fadeIn animate-delay-2">
                    @csrf

                    <div class="mb-4">
                        <label for="pesan" class="form-label">
                            <i class="fas fa-edit"></i> Tuliskan Laporan
                        </label>
                        <textarea id="pesan" name="pesan" class="form-control form-textarea" placeholder="Jelaskan Masalah Anda..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-file-upload"></i> Upload Bukti
                        </label>
                        <div class="file-upload">
                            <input type="file" id="bukti" name="bukti" accept="image/*,application/pdf">
                            <label for="bukti" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Klik atau seret file untuk mengunggah</span>
                                <small class="text-muted">(Format: JPG, PNG, PDF - Maksimal 5MB)</small>
                            </label>
                        </div>
                        <div id="fileName" class="file-name d-none"></div>
                    </div>

                    <input type="hidden" name="pencairan_id" value="{{ $pencairan_id }}">

                    <button type="button" id="btn-lapor" class="btn btn-submit">
                        <i class="fas fa-paper-plane me-2"></i> Kirim Laporan
                    </button>
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
        // Menampilkan nama file yang diunggah
        const fileInput = document.getElementById('bukti');
        const fileName = document.getElementById('fileName');
        
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileName.textContent = this.files[0].name;
                fileName.classList.remove('d-none');
            }
        });
        
        // Konfirmasi sebelum submit
        const btnLapor = document.getElementById('btn-lapor');
        const formLaporan = document.getElementById('form-laporan');
        
        btnLapor.addEventListener('click', function() {
            Swal.fire({
                title: 'Konfirmasi Laporan',
                text: "Apakah Anda yakin ingin mengirim laporan ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Kirim Laporan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    formLaporan.submit();
                }
            });
        });
        
        // Animasi saat elemen muncul di viewport
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/web3@1.10.0/dist/web3.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('#form-laporan');
  const button = document.querySelector('#btn-lapor');

  button.addEventListener('click', async function () {
    const pencairanId = form.querySelector('input[name="pencairan_id"]').value;
    const pesan = form.querySelector('textarea[name="pesan"]').value;

    if (!pesan.trim()) {
      alert("Pesan tidak boleh kosong.");
      return;
    }
    
    if (typeof window.ethereum === 'undefined') {
      alert('🦊 MetaMask tidak ditemukan!');
      return;
    }

    const SEPOLIA_CHAIN_ID = '0xaa36a7';
    const currentChainId = await ethereum.request({ method: 'eth_chainId' });

    if (currentChainId !== SEPOLIA_CHAIN_ID) {
      try {
        await ethereum.request({
          method: 'wallet_switchEthereumChain',
          params: [{ chainId: SEPOLIA_CHAIN_ID }]
        });
      } catch (err) {
        alert("Gagal beralih ke jaringan Sepolia.");
        return;
      }
    }
    
    const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
    const from = accounts[0];

    const contractAddress = '0xd74b45a10862add4deb6a954ddd0f79c87580578';
    const contractABI = [
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "uint256",
				"name": "laporanId",
				"type": "uint256"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "pencairanId",
				"type": "uint256"
			},
			{
				"indexed": true,
				"internalType": "address",
				"name": "pelapor",
				"type": "address"
			}
		],
		"name": "LaporanTersimpan",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_pencairanId",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "_pesanHash",
				"type": "string"
			}
		],
		"name": "simpanLaporan",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_index",
				"type": "uint256"
			}
		],
		"name": "getLaporan",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			},
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "jumlahLaporan",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "laporanList",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "pencairanId",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "pesanHash",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "timestamp",
				"type": "uint256"
			},
			{
				"internalType": "address",
				"name": "pelapor",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
];

    const web3 = new Web3(window.ethereum);
    const contract = new web3.eth.Contract(contractABI, contractAddress);

    try {
      const pesanHash = web3.utils.sha3(pesan);
      const tx = await contract.methods.simpanLaporan(pencairanId, pesanHash).send({ from });

      const formData = new FormData(form);
      formData.append('blockchain_tx', tx.transactionHash);

      const response = await fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });

      if (response.ok) {
        alert('✅ Laporan berhasil dikirim & dicatat ke blockchain!');
        window.location.reload();
      } else {
        alert('❌ Gagal menyimpan ke server.');
      }
    } catch (err) {
      console.error(err);
      alert('❌ Gagal mencatat ke blockchain.');
    }
  });
});
</script>
@endpush