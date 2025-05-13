@extends('layouts/main')
<!-- Extiende un layout principal (por ejemplo: layouts/main.blade.php) -->
<!-- Esto permite reutilizar estructuras comunes como header, footer, menú, etc. -->

<main class="mt-20 mb-1">
    <!-- Contenedor principal con margen superior e inferior -->

    <div class="container mx-auto px-4">
        <!-- Contenedor centralizado con padding horizontal -->

        <h1 class="text-2xl font-bold mb-6">Detalle del Producto</h1>
        <!-- Título de la página -->

        <!-- Tarjeta contenedora del detalle del producto -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">

            <!-- Encabezado de la tarjeta -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                    {{ $producto->nombre }}
                </h2>
            </div>

            <!-- Cuerpo del contenido -->
            <div class="p-6">
                
                <!-- Diseño en grid responsivo -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Nombre -->
                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Nombre:</strong>
                        <p class="text-gray-600 dark:text-gray-400">{{ $producto->nombre }}</p>
                    </div>

                    <!-- Origen -->
                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Origen:</strong>
                        <p class="text-gray-600 dark:text-gray-400">{{ $producto->origen }}</p>
                    </div>

                    <!-- Unidad -->
                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Unidad:</strong>
                        <p class="text-gray-600 dark:text-gray-400">{{ $producto->unidad }}</p>
                    </div>

                    <!-- Stock -->
                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Stock:</strong>
                        <p class="text-gray-600 dark:text-gray-400">{{ $producto->stock }}</p>
                    </div>

                    <!-- Precio Compra -->
                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Precio Compra:</strong>
                        <p class="text-gray-600 dark:text-gray-400">{{ $producto->compra }}</p>
                    </div>

                    <!-- Precio Venta -->
                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Precio Venta:</strong>
                        <p class="text-gray-600 dark:text-gray-400">{{ $producto->venta }}</p>
                    </div>

                    <!-- Es Perecedero -->
                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">¿Es Perecedero?:</strong>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ $producto->es_perecedero ? 'Sí' : 'No' }}
                        </p>
                    </div>

                    <!-- Fecha de Caducidad (solo si es perecedero) -->
                    @if ($producto->es_perecedero)
                        <div>
                            <strong class="text-gray-700 dark:text-gray-300">Fecha Caducidad:</strong>
                            <p class="text-gray-600 dark:text-gray-400">
                                {{ $producto->fecha_caducidad ? $producto->fecha_caducidad->format('Y-m-d') : '-' }}
                            </p>
                        </div>
                    @endif

                    <!-- Descripción (ocupa 2 columnas en pantallas medianas y más grandes) -->
                    <div class="md:col-span-2">
                        <strong class="text-gray-700 dark:text-gray-300">Descripción:</strong>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ $producto->descripcion ?? '-' }}
                        </p>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end gap-3 mt-6">
                    <!-- Botón VOLVER -->
                    <a href="{{ route('productos.index') }}" 
                       class="flex items-center justify-center w-32 h-10 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver
                    </a>

                    <!-- Botón EDITAR -->
                    <a href="{{ route('productos.edit', $producto->id) }}" 
                       class="flex items-center justify-center w-32 h-10 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>

                    <!-- Botón ELIMINAR -->
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('¿Eliminar este producto permanentemente?')"
                                class="flex items-center justify-center w-32 h-10 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Eliminar
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</main>