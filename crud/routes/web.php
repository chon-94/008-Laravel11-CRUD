<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;


Route::get('/', function () { return view('welcome'); });

Route::get('/productos',    [ProductoController::class, 'index'])->name('productos.index');

Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('productos', [ProductoController::class, 'store'])->name('productos.store');

Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}/update', [ProductoController::class, 'update'])->name('productos.update');

Route::delete('/productos/{id}/destroy', [ProductoController::class, 'destroy'])->name('productos.destroy');



