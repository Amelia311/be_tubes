<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Siswa;

class SiswaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['nama']) || empty($row['nisn'])) {
                continue; // skip jika data penting kosong
            }

            Siswa::updateOrCreate(
                ['nisn' => $row['nisn']], // cari berdasarkan NISN
                [
                    'nama' => $row['nama'],
                    'bank' => $row['bank'],
                    'no_rekening' => $row['no_rekening'],
                    'kelas' => $row['kelas'],
                ]
            );
        }
    }
}
