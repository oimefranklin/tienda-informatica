<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'categoria',
        'precio',
        'descripcion',
        'imagenes'
    ];

    protected $casts = [
        'imagenes' => 'array',
    ];
}


