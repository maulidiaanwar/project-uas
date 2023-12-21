<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruang extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama_ruang',
        'nomor_ruang',
    ];

    // method untuk relasional tabel
    public function siswa(){
        return $this->hasMany(siswa::class); // jenis relasi one to many
    }
}

