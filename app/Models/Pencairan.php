<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencairan extends Model
{
    use HasFactory;
    protected $table = 'pencairan';
    protected $fillable = ['siswa_id', 'tanggal_cair', 'jumlah', 'keterangan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

}
