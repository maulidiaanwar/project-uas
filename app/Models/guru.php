<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// import 
use Illuminate\Database\Eloquent\Casts\Attribute;

class guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_guru',
        'no_hp',
        'alamat'
    ];

    //method untuk tambah fitur Accessor
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/gurus/' .$value),
        );
    }

    // method untuk relasional tabel
    public function siswa(){
        return $this->hasMany(siswa::class); // jenis relasi one to many
    }
}
