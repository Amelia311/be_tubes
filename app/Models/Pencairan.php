<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencairan extends Model
{
    use HasFactory;
    protected $table = 'pencairan';
<<<<<<< HEAD
    protected $fillable = [
    'siswa_id',
    'tanggal_cair',
    'jumlah',
    'keterangan',
    'status',
    'blockchain_tx',
    'status_konfirmasi'
];

=======
    protected $fillable = ['siswa_id', 'tanggal_cair', 'jumlah', 'keterangan', 'status', 'blockchain_tx'];
    
    
>>>>>>> edc8543ba48dbce8e64329a786aa3075a0c94481
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
<<<<<<< HEAD
   
=======
    
>>>>>>> edc8543ba48dbce8e64329a786aa3075a0c94481
}
