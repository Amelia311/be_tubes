@extends('AdminSekolah.layouts.admin')

@section('title', 'Konfirmasi Pencairan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_konfirmasi.css') }}">
@endpush

@section('content')
<div class="main-content">
  <div class="content-box">
    <h3>Konfirmasi dan Catat Blockchain</h3>

    @if(session('success'))
      <div class="alert-box success">
        {{ session('success') }}
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
            @foreach($data as $item)
            <tr>
                <td>{{ $item->siswa->nama }}</td>
                <td>{{ $item->siswa->asal_sekolah }}</td>
                <td>{{ optional($item->created_at)->format('Y-m-d') ?? '-' }}</td>
                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>
                    @if($item->status == 'Sudah Cair')
                        <span class="status sudah">Sudah Cair</span><br>
                        <small class="tx">TX: {{ $item->blockchain_tx }}</small>
                    @else
                        <span class="status belum">Belum Cair</span>
                    @endif
                </td>
                <td>
                    @if($item->status == 'Belum Cair')
                    <button 
                        class="btn-konfirmasi"
                        data-id="{{ $item->id }}"
                        data-nama="{{ $item->siswa->nama }}"
                        data-jumlah="{{ $item->jumlah }}"
                        onclick="handleClick(this)">
                        Konfirmasi
                    </button>
                    @else
                    <button class="btn-terkonfirmasi" disabled>Terkonfirmasi</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
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

@endsection
