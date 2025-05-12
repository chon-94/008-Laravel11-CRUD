@extends('layouts/main')

    <main class="mt-20 mb-1">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold mb-6">Detalle del Producto</h1>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $producto->nombre }}</h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <strong class="text-gray-700 dark:text-gray-300">Nombre:</strong>
                            <p class="text-gray-600 dark:text-gray-400">{{ $producto->nombre }}</p>
                        </div>
                        <div>
                            <strong class="text-gray-700 dark:text-gray-300">Origen:</strong>
                            <p class="text-gray-600 dark:text-gray-400">{{ $producto->origen }}</p>
                        </div>
                        <div>
                            <strong class="text-gray-700 dark:text-gray-300">Unidad:</strong>
                            <p class="text-gray-600 dark:text-gray-400">{{ $producto->unidad }}</p>
                        </div>
                        <div>
                            <strong class="text-gray-700 dark:text-gray-300">Stock:</strong>
                            <p class="text-gray-600 dark:text-gray-400">{{ $producto->stock }}</p>
                        </div>
                        <div>
                            <strong class="text-gray-700 dark:text-gray-300">Precio Compra:</strong>
                            <p class="text-gray-600 dark:text-gray-400">{{ $producto->compra }}</p>
                        </div>
                        <div>
                            <strong class="text-gray-700 dark:text-gray-300">Precio Venta:</strong>
                            <p class="text-gray-600 dark:text-gray-400">{{ $producto->venta }}</p>
                        </div>
                        <div>
                            <strong class="text-gray-700 dark:text-gray-300">¿Es Perecedero?:</strong>
                            <p class="text-gray-600 dark:text-gray-400">{{ $producto->es_perecedero ? 'Sí' : 'No' }}</p>
                        </div>
                        @if ($producto->es_perecedero)
                            <div>
                                <strong class="text-gray-700 dark:text-gray-300">Fecha Caducidad:</strong>
                                <p class="text-gray-600 dark:text-gray-400">{{ $producto->fecha_caducidad ? $producto->fecha_caducidad->format('Y-m-d') : '-' }}</p>
                            </div>
                        @endif
                        <div class="md:col-span-2">
                            <strong class="text-gray-700 dark:text-gray-300">Descripción:</strong>
                            <p class="text-gray-600 dark:text-gray-400">{{ $producto->descripcion ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-start">
                        <a href="{{ route('productos.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Volver
                        </a>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
