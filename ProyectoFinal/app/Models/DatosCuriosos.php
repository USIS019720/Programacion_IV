<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosCuriosos extends Model
{
    use HasFactory;

    protected $table = 'datos_curiosos';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];
}
