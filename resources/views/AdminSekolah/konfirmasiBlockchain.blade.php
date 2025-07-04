@extends('AdminSekolah.layouts.admin')

@section('title', 'konfirmasi pencairan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_konfirmasi.css') }}">
@endpush

@section('content')
  <section class="content-box">
    <h3>Konfirmasi dan Catat Blockchain</h3>
    <table class="table-konfirmasi">
      <thead>
        <tr>
          <th>NAMA SISWA</th>
          <th>ASAL SEKOLAH</th>
          <th>TANGGAL</th>
          <th>JUMLAH</th>
          <th>STATUS</th>
          <th>AKSI</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td>{{ $item->siswa->nama }}</td>
          <td>{{ $item->siswa->asal_sekolah }}</td>
          <td>{{ $item->tanggal_cair ?? $item->created_at->format('Y-m-d') }}</td>
          <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
          <td>
            @if($item->status == 'Sudah Cair')
              <span class="status sudah">Sudah Cair</span><br>
              <small class="tx-hash">TX: {{ $item->blockchain_tx }}</small>
            @else
              <span class="status belum">Belum Cair</span>
            @endif
          </td>
          <td>
            @if($item->status == 'Sudah Cair')
              <button class="btn-terkonfirmasi" disabled><i class="fas fa-check"></i> Terkonfirmasi</button>
            @else
              <button class="btn-konfirmasi" onclick="konfirmasiKeBlockchain({{ $item->id }})">Konfirmasi</button>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </section>

  {{-- Blockchain JS --}}
  <script src="https://cdn.jsdelivr.net/npm/web3@1.10.0/dist/web3.min.js"></script>
  <script>
    const konfirmasiKeBlockchain = async (pencairanId) => {
      const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
      const from = accounts[0];

      const contractAddress = '0xYourContractAddressHere'; // ← Ganti dengan address kontrak
      const contractABI = [ /* ← Ganti dengan ABI kontrak */ ];

      const web3 = new Web3(window.ethereum);
      const contract = new web3.eth.Contract(contractABI, contractAddress);

      try {
        const tx = await contract.methods.catatPencairan(pencairanId).send({ from });

        await fetch('/api/simpan-blockchain-tx', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({
            pencairan_id: pencairanId,
            blockchain_tx: tx.transactionHash
          })
        });

        alert('Berhasil dicatat ke blockchain & database!');
        window.location.reload();

      } catch (error) {
        console.error(error);
        alert('Gagal mencatat ke blockchain.');
      }
    };
  </script>
@endsection
