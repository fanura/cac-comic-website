<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karakter extends Model
{
    use HasFactory;

    protected $table = 'karakter';

    protected $fillable = [
        'jenis_karakter', 'slug'
    ];


    protected $hidden = [];
}
