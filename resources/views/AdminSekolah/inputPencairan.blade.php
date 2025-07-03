@extends('AdminSekolah.layouts.admin')

@section('title', 'input pencairan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/AdminSekolah/style_input.css') }}">
@endpush

@section('content')
      <section class="content-box">
        <div class="form-container">
          <h3>Input Pencairan</h3>
          <form>
            <label for="siswa">Pilih Siswa</label>
            <select id="siswa">
              <option>-- Pilih Siswa --</option>
              <option>Ani Rahmawati</option>
              <option>Budi Santoso</option>
            </select>

            <label for="tanggal">Tanggal Cair</label>
            <input type="date" id="tanggal" placeholder="hh/bb/tttt" />

            <label for="jumlah">Jumlah yang Diterima</label>
            <input type="text" id="jumlah" placeholder="Contoh: 500000" />

            <label for="keterangan">Keterangan</label>
            <input type="text" id="keterangan" placeholder="Contoh: Tahap 1" />

            <button type="submit">Simpan</button>
          </form>
        </div>
      </section>
    </main>
  </div>
@endsection


