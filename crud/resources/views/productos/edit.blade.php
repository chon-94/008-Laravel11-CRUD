@extends('layouts/main')
<!-- Extiende un layout principal (por ejemplo: layouts/main.blade.php) -->
<!-- Esto permite reutilizar estructuras comunes como header, footer, menú lateral, etc. -->

<main class="mt-20 mb-1">
    <!-- Contenedor principal con margen superior e inferior -->

    <div class="container mx-auto px-4">
        <!-- Contenedor centralizado con padding horizontal -->

        <h1 class="text-2xl font-bold mb-6">ACTUALIZAR</h1>
        <!-- Título de la página -->

        <!-- Tarjeta contenedora del formulario -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">

            <!-- Encabezado de la tarjeta -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Formulario de Producto</h2>
            </div>

            <!-- Cuerpo del formulario -->
            <div class="p-6">
                <!-- Formulario para actualizar un producto -->
                <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Indicamos explícitamente que es una actualización -->

                    <!-- Diseño en grid: 1 columna en móvil, 2 en pantallas medianas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Campo Nombre -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre*</label>
                            <input type="text" id="nombre" name="nombre" required
                                   value="{{ $producto->nombre }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Campo Origen -->
                        <div>
                            <label for="origen" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Origen*</label>
                            <select id="origen" name="origen" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Seleccione el origen...</option>
                                <option value="Fabricado" {{ $producto->origen == 'Fabricado' ? 'selected' : '' }}>Fabricado</option>
                                <option value="Adquirido" {{ $producto->origen == 'Adquirido' ? 'selected' : '' }}>Adquirido</option>
                            </select>
                        </div>

                        <!-- Campo Unidad -->
                        <div>
                            <label for="unidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unidad*</label>
                            <select id="unidad" name="unidad" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Seleccione...</option>
                                <option value="kg" {{ $producto->unidad == 'kg' ? 'selected' : '' }}>Kilogramos</option>
                                <option value="g" {{ $producto->unidad == 'g' ? 'selected' : '' }}>Gramos</option>
                                <option value="l" {{ $producto->unidad == 'l' ? 'selected' : '' }}>Litros</option>
                                <option value="ml" {{ $producto->unidad == 'ml' ? 'selected' : '' }}>Mililitros</option>
                                <option value="unidad" {{ $producto->unidad == 'unidad' ? 'selected' : '' }}>Unidad</option>
                            </select>
                        </div>

                        <!-- Campo Stock -->
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stock*</label>
                            <input type="number" id="stock" name="stock" required min="0" step="0.01"
                                   value="{{ $producto->stock }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Precio Compra -->
                        <div>
                            <label for="compra" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio Compra*</label>
                            <input type="number" id="compra" name="compra" required min="0" step="0.01"
                                   value="{{ $producto->compra }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Precio Venta -->
                        <div>
                            <label for="venta" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio Venta*</label>
                            <input type="number" id="venta" name="venta" required min="0" step="0.01"
                                   value="{{ $producto->venta }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Es Perecedero -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Es Perecedero</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="es_perecedero" value="1"
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600"
                                           {{ $producto->es_perecedero ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Sí</span>
                                </label>
                            </div>
                        </div>

                        <!-- Fecha Caducidad (solo visible si es perecedero) -->
                        <div id="fecha-caducidad-container" style="display: {{ $producto->es_perecedero ? 'block' : 'none' }};">
                            <label for="fecha_caducidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha Caducidad</label>
                            <input type="date" id="fecha_caducidad" name="fecha_caducidad"
                                   value="{{ $producto->fecha_caducidad ? $producto->fecha_caducidad->format('Y-m-d') : '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Descripción (ocupa las dos columnas en pantallas medianas y más grandes) -->
                        <div class="md:col-span-2">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ $producto->descripcion }}</textarea>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-wrap justify-end gap-3 mt-6">
                        <!-- Botón VOLVER -->
                        <a href="{{ route('productos.index') }}" 
                           class="flex items-center justify-center w-32 h-10 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                        </a>

                        <!-- Botón ACTUALIZAR -->
                        <button type="submit"
                                class="flex items-center justify-center w-32 h-10 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Actualizar
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