<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan'; 

    protected $fillable = [
        'pencairan_id',
        'pesan',
        'bukti',
        'status',
    ];

    public function pencairan()
    {
        return $this->belongsTo(Pencairan::class);
    }

}
