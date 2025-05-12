<?php

// Espacio de nombres (namespace) del controlador
namespace App\Http\Controllers;

// Importamos las clases necesarias
use App\Models\Producto; // Modelo Producto
use Illuminate\Http\Request; // Clase Request para recibir datos del formulario

// Definición de la clase controladora
class ProductoController extends Controller
{
    /**
     * Muestra una lista de todos los productos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todos los registros de la tabla 'productos'
        $productos = Producto::paginate(2);

        // Retorna la vista 'productos.index' pasando los datos como variable
        return view('productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna la vista 'productos.create' para mostrar el formulario de registro
        return view('productos.create');
    }

    /**
     * Guarda un nuevo producto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validación de los campos del formulario
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
            // Mensajes personalizados de error de validación
            'nombre.required' => 'El nombre del producto es obligatorio',
            'unidad.required' => 'La unidad de medida es obligatoria',
            'unidad.in' => 'La unidad debe ser kg, g, l, ml o unidad',
            'stock.required' => 'El stock es obligatorio',
            'compra.required' => 'El precio de compra es obligatorio',
            'venta.required' => 'El precio de venta es obligatorio',
            'fecha_caducidad.required_if' => 'La fecha de caducidad es obligatoria para productos perecederos',
            'fecha_caducidad.after_or_equal' => 'La fecha de caducidad no puede ser en el pasado'
        ]);

        // Si el campo "es_perecedero" está presente, se convierte a booleano
        $validated['es_perecedero'] = $request->has('es_perecedero');

        // Si el producto NO es perecedero, eliminamos la fecha de caducidad
        if (!$validated['es_perecedero']) {
            $validated['fecha_caducidad'] = null;
        }

        // Creamos el producto con los datos validados
        Producto::create($validated);

        // Redirige al listado de productos con mensaje de éxito
        return redirect()->route('productos.index')
                        ->with('success', 'Producto creado exitosamente');
    }

    /**
     * Muestra los detalles de un producto específico.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Busca el producto por ID o devuelve un error 404 si no existe
        $producto = Producto::findOrFail($id);

        // Retorna la vista 'productos.show' con los datos del producto
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
        // Busca el producto por ID o lanza un error si no se encuentra
        $producto = Producto::findOrFail($id);

        // Opciones disponibles para los selectores en el formulario
        $origenes = ['Fabricado' => 'Fabricado', 'Adquirido' => 'Adquirido'];
        $unidades = ['kg' => 'kg', 'g' => 'g', 'l' => 'l', 'ml' => 'ml', 'unidad' => 'unidad'];

        // Retorna la vista 'productos.edit' con el producto y opciones
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
        // Validación de los campos del formulario de edición
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

        // Busca el producto por ID o falla si no existe
        $producto = Producto::findOrFail($id);

        // Actualiza el producto con los datos validados
        $producto->update($validated);

        // Redirige al listado con mensaje de éxito
        return redirect()->route('productos.index')
                        ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param  \App\Models\Producto  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Producto $id)
    {
        try {
            // Elimina el producto usando el modelo inyectado
            $id->delete();

            // Redirige con mensaje de éxito
            return redirect()->route('productos.index')
                           ->with('success', 'Producto eliminado exitosamente');
        } catch (\Exception $e) {
            // Si hay un error, redirige y muestra el mensaje
            return redirect()->back()
                           ->with('error', 'No se pudo eliminar el producto: ' . $e->getMessage());
        }
    }
}