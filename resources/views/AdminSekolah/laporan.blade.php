<h2>Daftar Laporan Siswa</h2>

<table>
    <tr>
        <th>Nama Siswa</th>
        <th>NISN</th>
        <th>Jumlah</th>
        <th>Tanggal</th>
        <th>Pesan</th>
        <th>Status</th>
        <th>Bukti</th>
    </tr>
    @foreach($laporan as $lapor)
        <tr>
            <td>{{ $lapor->pencairan->siswa->nama }}</td>
            <td>{{ $lapor->pencairan->siswa->nisn }}</td>
            <td>Rp{{ number_format($lapor->pencairan->jumlah) }}</td>
            <td>{{ $lapor->pencairan->tanggal_cair }}</td>
            <td>{{ $lapor->pesan }}</td>
            <td>{{ $lapor->status }}</td>
            <td>
                @if($lapor->bukti)
                    <a href="{{ asset('storage/' . $lapor->bukti) }}" target="_blank">Lihat Bukti</a>
                @else
                    Tidak ada bukti
                @endif
            </td>

        </tr>
    @endforeach
</table>
