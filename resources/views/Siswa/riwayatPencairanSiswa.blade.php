<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pencairan Saya</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            padding: 10px 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        .lapor-btn {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .lapor-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    

    <h2>Riwayat Pencairan Dana PIP Saya</h2>

    @if(session('success'))
        <div style="padding: 10px; background-color: #d4edda; color: #155724; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Admin Sekolah</th>
                <th>TX Blockchain</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($riwayat as $item)
                <tr>
                    <td>{{ $item->tanggal_cair }}</td>
                    <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->admin_sekolah ?? 'Tidak tersedia' }}</td>
                    <td>
                        @if ($item->blockchain_tx)
                            <a href="#" style="color: green;">{{ $item->blockchain_tx }}</a>
                        @else
                            <span style="color: gray;">Belum Tersedia</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('siswa.lapor', $item->id) }}">
                            @csrf
                            <button type="submit" class="lapor-btn">Laporkan</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada pencairan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
