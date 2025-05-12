@extends('layouts/main')
<!-- Extiende un layout principal común (por ejemplo, layouts/main.blade.php) -->
<!-- Esto permite reutilizar estructuras como header, footer, menú lateral, etc. -->

<main class="mt-20 mb-1">
    <!-- Contenedor principal con margen superior e inferior -->

    <div class="container mx-auto px-4">
        <!-- Contenedor centralizado con padding horizontal -->

        <h1 class="text-2xl font-bold mb-6">Nuevo Producto</h1>
        <!-- Título de la página -->

        <!-- Tarjeta contenedora del formulario -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">

            <!-- Encabezado de la tarjeta -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Formulario de Producto</h2>
            </div>

            <!-- Cuerpo del formulario -->
            <div class="p-6">
                <!-- Formulario para crear un producto -->
                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf
                    @method('POST') <!-- Indicamos explícitamente que es POST -->

                    <!-- Diseño en grid: 1 columna en móvil, 2 en pantallas medianas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Campo Nombre -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre*</label>
                            <input type="text" id="nombre" name="nombre" required
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Campo Origen -->
                        <div>
                            <label for="origen" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Origen*</label>
                            <select id="origen" name="origen" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Seleccione el origen...</option>
                                <option value="Fabricado">Fabricado</option>
                                <option value="Adquirido">Adquirido</option>
                            </select>
                        </div>

                        <!-- Campo Unidad -->
                        <div>
                            <label for="unidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unidad*</label>
                            <select id="unidad" name="unidad" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Seleccione...</option>
                                <option value="kg">Kilogramos</option>
                                <option value="g">Gramos</option>
                                <option value="l">Litros</option>
                                <option value="ml">Mililitros</option>
                                <option value="unidad">Unidad</option>
                            </select>
                        </div>

                        <!-- Campo Stock -->
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stock*</label>
                            <input type="number" id="stock" name="stock" required min="0" step="0.01"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Precio Compra -->
                        <div>
                            <label for="compra" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio Compra*</label>
                            <input type="number" id="compra" name="compra" required min="0" step="0.01"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Precio Venta -->
                        <div>
                            <label for="venta" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio Venta*</label>
                            <input type="number" id="venta" name="venta" required min="0" step="0.01"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Es Perecedero -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Es Perecedero</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="es_perecedero" value="1"
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Sí</span>
                                </label>
                            </div>
                        </div>

                        <!-- Fecha Caducidad (solo visible si es perecedero) -->
                        <div id="fecha-caducidad-container" style="display: none;">
                            <label for="fecha_caducidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha Caducidad</label>
                            <input type="date" id="fecha_caducidad" name="fecha_caducidad"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Descripción (ocupa las dos columnas en pantallas medianas y más grandes) -->
                        <div class="md:col-span-2">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <!-- Botón Cancelar -->
                        <a href="{{ route('productos.index') }}" 
                           class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancelar
                        </a>

                        <!-- Botón Guardar -->
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Script para mostrar/ocultar el campo de fecha de caducidad -->
<script>
    // Detectamos cambios en el checkbox "es_perecedero"
    document.querySelector('input[name="es_perecedero"]').addEventListener('change', function() {
        const fechaContainer = document.getElementById('fecha-caducidad-container');
        // Mostramos u ocultamos el campo según si el checkbox está marcado
        fechaContainer.style.display = this.checked ? 'block' : 'none';
    });
</script>