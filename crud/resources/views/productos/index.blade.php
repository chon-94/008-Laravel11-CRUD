
@extends('layouts/main')

<!-- Contenido principal -->
<main class="mt-20 mb-1">
    <div class="container mx-auto px-4">
        <!-- Título de la página -->
        <h1 class="text-2xl font-bold mb-6">Almacen</h1>

        <!-- Contenedor principal: tabla + botón crear -->
        <div class="flex flex-col lg:flex-row gap-6 items-start">
            
            <!-- Tabla de productos -->
            <div class="w-full lg:w-5/6 bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <!-- Encabezado de la tabla -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Lista de Productos</h2>
                </div>

                <!-- Contenedor scroll horizontal para tablas largas -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Encabezados de columnas -->
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">ID</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Origen</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Unidad</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Stock</th>
                                {{-- <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Compra</th> --}}
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Venta</th>
                                {{-- <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Perecedero</th> --}}
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Caducidad</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Descripción</th>
                                <th class="px-4 py-3 text-right text-sm font-medium text-gray-500 dark:text-gray-400">Acciones</th>
                            </tr>
                        </thead>

                        <!-- Cuerpo de la tabla -->
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            <!-- Si hay productos, los mostramos -->
                            @forelse ($productos as $producto)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-white">{{ $producto->id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-white">{{ $producto->nombre }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $producto->origen }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $producto->unidad }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $producto->stock }}</td>
                                {{-- <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">${{ number_format($producto->compra ?? 0, 2) }}</td> --}}
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">${{ number_format($producto->venta ?? 0, 2) }}</td>
                                {{-- <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $producto->es_perecedero ? 'Sí' : 'No' }}</td> --}}
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $producto->fecha_caducidad }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $producto->descripcion }}</td>
                                    <!-- Acciones: Ver, Editar, Eliminar -->
                                    <td class="px-4 py-3 text-sm text-right space-x-2">
                                        <!-- Botón Ver Detalle -->
                                        <a href="{{ route('productos.show', $producto->id) }}" 
                                           class="inline-flex items-center gap-1 px-2 py-1 text-green-600 rounded hover:bg-green-100 dark:text-green-400 dark:hover:bg-green-900/30 transition-colors duration-150"
                                           title="Ver detalle">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <!-- Botón Editar -->
                                        <a href="{{ route('productos.edit', $producto->id) }}" 
                                           class="inline-flex items-center gap-1 px-2 py-1 text-yellow-600 rounded hover:bg-yellow-100 dark:text-yellow-400 dark:hover:bg-yellow-900/30 transition-colors duration-150"
                                           title="Editar producto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1 px-2 py-1 text-red-600 rounded hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-900/30 transition-colors duration-150"
                                                    title="Eliminar producto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <!-- Si no hay productos -->
                            @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                        No hay productos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación (comentada por ahora) -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $productos->links() }}
                </div>
            </div>

            <!-- Botón Crear Producto -->
            <div class="w-full lg:w-1/6 flex justify-end">
                <a href="{{ route('productos.create') }}" 
                   class="w-full px-4 py-2 text-center text-white bg-blue-600 hover:bg-blue-700 rounded-md transition duration-200">
                    Crear
                </a>
            </div>
        </div>
    </div>
</main>