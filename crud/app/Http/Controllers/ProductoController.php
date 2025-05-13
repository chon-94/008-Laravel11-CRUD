<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Modelo del producto
use Illuminate\Http\Request; // Para recibir datos desde formularios

class ProductoController extends Controller
{
    /**
     * Muestra una lista paginada de productos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene los productos con paginación (2 registros por página)
        $productos = Producto::paginate(5);

        // Retorna la vista 'productos.index' pasando los productos como variable
        return view('productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna la vista del formulario de creación
        return view('productos.create');
    }

    /**
     * Almacena un nuevo producto en la base de datos tras validar los datos del formulario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(  ProductoRequest $request)
    {
        // Validamos los campos del formulario con reglas claras
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'origen' => 'required|string|in:Fabricado,Adquirido',
            'unidad' => 'required|string|in:kg,g,litros,ml,unidad',
            'stock' => 'required|numeric|min:0',
            'compra' => 'required|numeric|min:0',
            'venta' => 'required|numeric|min:0',
            'es_perecedero' => 'sometimes|boolean',
            'fecha_caducidad' => 'nullable|date|after_or_equal:today|required_if:es_perecedero,1',
            'descripcion' => 'nullable|string|max:1000'
        ], [
            // Mensajes personalizados para mejorar la experiencia del usuario
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'unidad.required' => 'La unidad de medida es obligatoria.',
            'unidad.in' => 'La unidad debe ser kg, g, l, ml o unidad.',
            'stock.required' => 'El campo stock es obligatorio.',
            'compra.required' => 'El precio de compra es obligatorio.',
            'venta.required' => 'El precio de venta es obligatorio.',
            'fecha_caducidad.required_if' => 'La fecha de caducidad es obligatoria para productos perecederos.',
            'fecha_caducidad.after_or_equal' => 'La fecha de caducidad no puede ser anterior a hoy.'
        ]);

        // Convertimos el valor del checkbox 'es_perecedero' a booleano
        $validated['es_perecedero'] = $request->has('es_perecedero');

        // Si NO es perecedero, eliminamos cualquier valor de fecha_caducidad
        if (!$validated['es_perecedero']) {
            $validated['fecha_caducidad'] = null;
        }

        // Creamos el producto en la base de datos
        Producto::create($validated);

        // Redirigimos al listado de productos con mensaje de éxito
        return redirect()->route('productos.index') ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Muestra los detalles de un producto específico.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Buscamos el producto por ID, si no existe se devuelve error 404
        $producto = Producto::findOrFail($id);

        // Mostramos la vista con los datos del producto
        return view('productos.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Buscamos el producto por ID, si no existe se devuelve error 404
        $producto = Producto::findOrFail($id);

        // Opciones para los selects de origen y unidad en el formulario
        $origenes = ['Fabricado' => 'Fabricado', 'Adquirido' => 'Adquirido'];
        $unidades = ['kg' => 'kg', 'g' => 'g', 'l' => 'l', 'ml' => 'ml', 'litros' => 'litros', 'unidad' => 'unidad'];

        // Retornamos la vista de edición con los datos del producto y las opciones
        return view('productos.edit', compact('producto', 'origenes', 'unidades'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validamos los datos del formulario de edición
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'origen' => 'required|in:Fabricado,Adquirido',
            'unidad' => 'required|in:kg,g,l,ml,litros,unidad',
            'stock' => 'required|numeric|min:0',
            'compra' => 'nullable|numeric|min:0',
            'venta' => 'nullable|numeric|min:0',
            'es_perecedero' => 'boolean',
            'fecha_caducidad' => 'nullable|date|required_if:es_perecedero,true',
            'descripcion' => 'nullable|string'
        ]);

        // Buscamos el producto por ID
        $producto = Producto::findOrFail($id);

        // Actualizamos los datos del producto
        $producto->update($validated);

        // Redirigimos al listado con mensaje de éxito
        return redirect()->route('productos.index')
                         ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Producto $id)
    {
        try {
            // Eliminamos el producto
            $id->delete();

            // Redirigimos con mensaje de éxito
            return redirect()->route('productos.index')
                             ->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, mostramos mensaje detallado
            return redirect()->back()
                             ->with('error', 'No se pudo eliminar el producto: ' . $e->getMessage());
        }
    }
}