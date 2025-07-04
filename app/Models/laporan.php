<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans'; // karena default-nya Laravel pakai 'laporans'

    protected $fillable = [
        'pencairan_id',
        'pesan',
        'status',
        'bukti',
    ];

    public function pencairan()
    {
        return $this->belongsTo(Pencairan::class);
    }

}
