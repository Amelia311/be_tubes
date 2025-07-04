<!-- resources/views/AdminSekolah/siswa/create.blade.php -->

@extends('AdminSekolah.layouts.admin')

@section('title', 'Tambah Akun Siswa')

@section('content')
<div class="container">
    <h3>Tambah Akun Siswa</h3>
    
    <form method="POST" action="{{ route('siswa.store') }}">
        @csrf

        <label>Nama:</label>
        <input type="text" name="nama" required>

        <label>NISN:</label>
        <input type="text" name="nisn" required>

        <label>Asal Sekolah:</label>
        <input type="text" name="asal_sekolah" required>

        <label>Alamat:</label>
        <input type="text" name="alamat" required>

        <label>Kelas:</label>
        <select name="kelas" required>
            <option value="">-- Pilih Kelas --</option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
        </select>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
