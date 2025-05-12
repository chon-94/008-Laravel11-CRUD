<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;


Route::get('/', function () { return view('welcome'); });

// ┌────────────────────────────┐
// │   Rutas para Productos     │
// └────────────────────────────┘

// Mostrar todos los productos (Listado)
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
// Formulario para crear un nuevo producto
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
// Guardar un nuevo producto (POST)
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
// Ver detalle de un producto específico
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
// Formulario para editar un producto existente
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
// Actualizar datos de un producto (PUT)
Route::put('/productos/{id}/update', [ProductoController::class, 'update'])->name('productos.update');
// Eliminar un producto (DELETE)
Route::delete('/productos/{id}/destroy', [ProductoController::class, 'destroy'])->name('productos.destroy');
