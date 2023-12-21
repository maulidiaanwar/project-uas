<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_siswa',
        'tanggal_lahir',
        'alamat',
        'guru_id',
        'ruang_id',
        'kelas',
        'siswa',
    ];

    // method untuk relasional tabel
    public function guru(){
        return $this->belongsTo(guru::class); // jenis relasi many to one
    }

    public function ruang(){
        return $this->belongsTo(ruang::class); // jenis relasi many to one (ruang)
    }
}
