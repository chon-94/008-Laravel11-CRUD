<?php

// Espacio de nombres del modelo (debe coincidir con la carpeta Models)
namespace App\Models;

// Importamos las clases necesarias
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Eloquent para la tabla 'productos'
 *
 * Representa un producto en el sistema. Cada instancia contiene:
 * - ID único
 * - Nombre
 * - Origen (Fabricado o Adquirido)
 * - Unidad de medida (kg, g, l, ml, unidad)
 * - Stock disponible
 * - Precio de compra
 * - Precio de venta
 * - ¿Es perecedero?
 * - Fecha de caducidad (si aplica)
 * - Descripción opcional
 */
class Producto extends Model
{
    // Usamos HasFactory para generar datos falsos durante pruebas
    use HasFactory;

    /**
     * Atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',             // Nombre del producto
        'origen',             // Fabricado o Adquirido
        'unidad',             // kg, g, l, ml, unidad
        'stock',              // Número decimal, ej: 10.50
        'compra',             // Precio de compra
        'venta',              // Precio de venta
        'es_perecedero',     // Booleano: si tiene fecha de caducidad o no
        'fecha_caducidad',   // Fecha de vencimiento (opcional)
        'descripcion',       // Información adicional sobre el producto
    ];

    /**
     * Tipos en los que se deben convertir los atributos al accederlos.
     *
     * Esto ayuda a manejar tipos correctamente desde la base de datos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'stock' => 'decimal:2',           // Se muestra como 10.00 en lugar de 10
        'compra' => 'decimal:2',         // Precisión de 2 decimales
        'venta' => 'decimal:2',          // Ej: 19.99 en lugar de 19.990001
        'es_perecedero' => 'boolean',    // true/false en lugar de 1/0
        'fecha_caducidad' => 'date',     // Formateado como objeto Carbon
    ];
}