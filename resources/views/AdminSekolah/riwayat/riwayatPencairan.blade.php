@extends('AdminSekolah.layouts.admin')

@section('title', 'riwayat pencairan')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_riwayat.css') }}">
@endpush

@section('content')
<section class="content-box">
        <div class="header-table">
            <h3>Riwayat Pencairan</h3>
            <form method="GET" action="{{ route('riwayat.sekolah') }}" class="filter-form">
                <input type="text" name="search" placeholder="Search..." class="search-input" value="{{ request('search') }}"/>
            </form>
        </div>


        <table class="table-riwayat">
          <thead>
            <tr>
              <th>NO</th>
              <th>NAMA</th>
              <th>JUMLAH</th>
              <th>STATUS</th>
              <th>BUKTI</th>
              <th>BLOCKCHAIN TX</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->siswa->nama ?? '-' }}</td>
                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>
                  <span class="status {{ strtolower($item->status) == 'sudah cair' ? 'sudah' : 'menunggu' }}">
                    {{ ucfirst($item->status) }}
                  </span>
                </td>
                <td>
                  @if ($item->bukti)
                    <a href="{{ asset('storage/bukti/' . $item->bukti) }}" target="_blank" class="link">Lihat</a>
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if ($item->blockchain_tx)
                    <a href="https://sepolia.etherscan.io/tx/{{ $item->blockchain_tx }}" target="_blank" class="link">Link</a>
                  @else
                    -
                  @endif
                </td>
              </tr>
            @empty
              <tr><td colspan="6">Tidak ada riwayat pencairan</td></tr>
            @endforelse
          </tbody>
        </table>
      </section>
    </main>
  </div>
  @endsection

