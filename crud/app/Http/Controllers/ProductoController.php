<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'origen' => 'required|string|in:Fabricado,Adquirido',
            'unidad' => 'required|string|in:kg,g,l,ml,unidad',
            'stock' => 'required|numeric|min:0',
            'compra' => 'required|numeric|min:0',
            'venta' => 'required|numeric|min:0',
            'es_perecedero' => 'sometimes|boolean',
            'fecha_caducidad' => 'nullable|date|after_or_equal:today|required_if:es_perecedero,1',
            'descripcion' => 'nullable|string|max:1000'
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'unidad.required' => 'La unidad de medida es obligatoria',
            'unidad.in' => 'La unidad debe ser kg, g, l, ml o unidad',
            'stock.required' => 'El stock es obligatorio',
            'compra.required' => 'El precio de compra es obligatorio',
            'venta.required' => 'El precio de venta es obligatorio',
            'fecha_caducidad.required_if' => 'La fecha de caducidad es obligatoria para productos perecederos',
            'fecha_caducidad.after_or_equal' => 'La fecha de caducidad no puede ser en el pasado'
        ]);
    
        // Convertir el checkbox a booleano
        $validated['es_perecedero'] = $request->has('es_perecedero');
    
        // Si no es perecedero, establecer fecha_caducidad como null
        if (!$validated['es_perecedero']) {
            $validated['fecha_caducidad'] = null;
        }
    
        Producto::create($validated);
    
        return redirect()->route('productos.index')
                        ->with('success', 'Producto creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $id)
    {
        //
    }
}
