<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class animalesPeligro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'informacion', 'habitad', 'imagen',
    ];
}
