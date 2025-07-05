@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Konfirmasi dan Catat Blockchain</h4>
    <table class="table table-bordered mt-3">
        @foreach ($riwayat as $pencairan)
    <div class="riwayat-item">
        <p>Tanggal: {{ $pencairan->tanggal_cair }}</p>
        <p>Jumlah: Rp{{ number_format($pencairan->jumlah) }}</p>
        <p>Status: {{ $pencairan->status ?? 'Belum dikonfirmasi admin' }}</p>
        <p>Konfirmasi Siswa: {{ ucfirst($pencairan->status_konfirmasi) }}</p>

        @if($pencairan->status_konfirmasi == 'belum')
        <form action="{{ route('siswa.konfirmasiPencairan', $pencairan->id) }}" method="POST">
            @csrf
            <select name="status_konfirmasi" required>
                <option value="">-- Pilih Konfirmasi --</option>
                <option value="diterima">Saya Sudah Menerima</option>
                <option value="tidak_sesuai">Belum/Tidak Sesuai</option>
            </select>
            <button type="submit">Kirim</button>
        </form>
        @endif
    </div>
@endforeach

        </tbody>
    </table>
</div>
@endsection
