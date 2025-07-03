<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Ani Rahmawati',
                'nisn' => '1234567890',
                'asal_sekolah' => 'SMPN 1 Bandung',
                'alamat' => 'Jl. Mawar No.1'
            ],
            [
                'nama' => 'Budi Santoso',
                'nisn' => '1234567891',
                'asal_sekolah' => 'SMPN 2 Bandung',
                'alamat' => 'Jl. Melati No.2'
            ],
            [
                'nama' => 'Citra Lestari',
                'nisn' => '1234567892',
                'asal_sekolah' => 'SMPN 3 Bandung',
                'alamat' => 'Jl. Kenanga No.3'
            ],
            [
                'nama' => 'Dedi Saputra',
                'nisn' => '1234567893',
                'asal_sekolah' => 'SMPN 4 Bandung',
                'alamat' => 'Jl. Dahlia No.4'
            ],
            [
                'nama' => 'Eka Putri',
                'nisn' => '1234567894',
                'asal_sekolah' => 'SMPN 5 Bandung',
                'alamat' => 'Jl. Cempaka No.5'
            ],
            [
                'nama' => 'Fahmi Maulana',
                'nisn' => '1234567895',
                'asal_sekolah' => 'SMPN 6 Bandung',
                'alamat' => 'Jl. Flamboyan No.6'
            ],
            [
                'nama' => 'Gita Anggraini',
                'nisn' => '1234567896',
                'asal_sekolah' => 'SMPN 7 Bandung',
                'alamat' => 'Jl. Kamboja No.7'
            ],
            [
                'nama' => 'Hendra Wijaya',
                'nisn' => '1234567897',
                'asal_sekolah' => 'SMPN 8 Bandung',
                'alamat' => 'Jl. Teratai No.8'
            ],
            [
                'nama' => 'Indah Pratiwi',
                'nisn' => '1234567898',
                'asal_sekolah' => 'SMPN 9 Bandung',
                'alamat' => 'Jl. Bougenville No.9'
            ],
            [
                'nama' => 'Joko Priyono',
                'nisn' => '1234567899',
                'asal_sekolah' => 'SMPN 10 Bandung',
                'alamat' => 'Jl. Anggrek No.10'
            ],
        ];

        foreach ($data as $item) {
            Siswa::create($item);
        }
    }
}
