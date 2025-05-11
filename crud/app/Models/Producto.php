<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'origen',
        'unidad',
        'stock',
        'compra',
        'venta',
        'es_perecedero',
        'fecha_caducidad',
        'descripcion',
    ];

    protected $casts = [
        'stock' => 'decimal:2',
        'compra' => 'decimal:2',
        'venta' => 'decimal:2',
        'es_perecedero' => 'boolean',
        'fecha_caducidad' => 'date',
    ];
}