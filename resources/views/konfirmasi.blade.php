@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Konfirmasi dan Catat Blockchain</h4>
    <table class="table table-bordered mt-3">
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
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>
                    @if($item->status == 'Sudah Cair')
                        <span class="badge bg-success">Sudah Cair</span>
                    @else
                        <span class="badge bg-warning text-dark">Belum Cair</span>
                    @endif
                </td>
                <td>
                    @if($item->status == 'Sudah Cair')
                        <span class="badge bg-success">Sudah Cair</span>
                        <br><small class="text-white">TX: {{ $item->blockchain_tx }}</small>
                    @else
                        <span class="badge bg-warning text-dark">Belum Cair</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
const konfirmasiKeBlockchain = async (pencairanId) => {
  const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
  const from = accounts[0];

  const contractAddress = '0xYourContractAddressHere'; // ← ganti nanti
  const contractABI = [ /* ... ABI kontrak kamu nanti */ ];

  const web3 = new Web3(window.ethereum);
  const contract = new web3.eth.Contract(contractABI, contractAddress);

  const tx = await contract.methods.catatPencairan(pencairanId).send({ from });

  fetch('/api/simpan-blockchain-tx', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
      pencairan_id: pencairanId,
      blockchain_tx: tx.transactionHash
    })
  }).then(() => {
    alert('Berhasil dicatat ke blockchain & database!');
    window.location.reload();
  });
};
</script>

@endsection
