@extends('Siswa.layouts.siswa')

@section('title', 'Laporan Ketidaksesuaian - PIPGuard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Siswa/style_dashboard_siswa.css') }}">
@endpush

@section('content')
<main class="container">
  <section id="laporan-ketidaksesuaian" class="content-section active">
    <h2>Laporkan Ketidaksesuaian Dana</h2>

    @if(session('success'))
      <div style="background-color: #22c55e; color: white; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div style="background-color: #ef4444; color: white; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
        <ul style="margin: 0; padding: 0 1rem;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form id="form-laporan" action="{{ route('siswa.laporStore') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <label for="pesan" style="display:block; font-weight:bold;">Tuliskan Laporan</label>
  <textarea id="pesan" name="pesan" placeholder="Tuliskan perbedaan dana yang Anda terima..." required style="width: 100%; min-height: 120px;"></textarea>

  <label for="bukti" style="display:block; margin-top: 1rem; font-weight:bold;">Upload Bukti</label>
  <input type="file" id="bukti" name="bukti" accept="image/*,application/pdf" />

  <input type="hidden" name="pencairan_id" value="{{ $pencairan_id }}">

  {{-- Tombol ini sekarang type="button" biar tidak langsung submit --}}
  <button type="button" id="btn-lapor" style="margin-top: 1rem;" class="btn-tambah">Kirim Laporan</button>
</form>

  </section>
</main>
@endsection

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