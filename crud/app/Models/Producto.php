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
        'unidad_medida',
        'stock_actual',
        'stock_minimo',
        'precio_compra',
        'precio_venta',
        'es_perecedero',
        'fecha_caducidad',
        'descripcion'
    ];

    protected $casts = [
        'es_perecedero' => 'boolean',
        'fecha_caducidad' => 'date',
        'stock_actual' => 'decimal:2',
        'stock_minimo' => 'decimal:2',
        'precio_compra' => 'decimal:2',
        'precio_venta' => 'decimal:2'
    ];
}