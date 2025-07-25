<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkPip extends Model
{
    protected $table = 'sk_pip';

    protected $fillable = [
        'nama_sk',
        'tahun',
        'semester',
        'file_path'
    ];
}
