<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';
    protected $fillable =[
        'judul', 'slug', 'gambar_artikel','is_active','views', 'body'
    ];
    protected $hidden = [];

    public function karakter()
    {
        return $this->belongsTo(Karakter::class, 'karakter_id', 'id');
    }
}
