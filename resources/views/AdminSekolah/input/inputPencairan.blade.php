
@extends('AdminSekolah.layouts.admin')


@section('title', 'input pencairan')


@section('content')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_input.css') }}">
      <section class="content-box">
        <div class="form-container">
          <h3>Input Pencairan</h3>

          @if (session('success'))
            <div style="background: #22c55e; padding: 10px; border-radius: 6px; margin-bottom: 10px; color: white;">
              {{ session('success') }}
            </div>
          @endif

          <form method="POST" action="{{ route('pencairan.store') }}" class="actions">
            @csrf

            <label for="siswa_id">Pilih Siswa</label>
            <select id="siswa_id" name="siswa_id" required>
              <option value="">-- Pilih Siswa --</option>
              @foreach ($siswa as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
              @endforeach
            </select>

            <label for="tanggal_cair">Tanggal Cair</label>
            <input type="date" id="tanggal_cair" name="tanggal_cair" required />

            <label for="jumlah">Jumlah yang Diterima</label>
            <input type="text" id="jumlah" name="jumlah" placeholder="Contoh: 500000" required />

            <label for="keterangan">Keterangan</label>
            <input type="text" id="keterangan" name="keterangan" placeholder="Contoh: Tahap 1" required />

            <button type="submit">Simpan</button>
          </form>
        </div>
      </section>
    </main>
  </div>
@endsection


