<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profil';
    protected $fillable =[
        'nama_karakter', 'slug', 'nama_asli','karakter_id','asal', 'tinggi', 'berat',
        'kemampuan', 'latar_belakang', 'gambar_karakter'
    ];
    protected $hidden = [];

    public function karakter()
    {
        return $this->belongsTo(Karakter::class, 'karakter_id', 'id');
    }
}
