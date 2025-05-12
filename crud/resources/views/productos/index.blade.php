

@extends('layouts/main')

<main class="mt-20 mb-1">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6">Almacen</h1>

        <!-- Contenedor principal modificado -->
        <div class="flex flex-col lg:flex-row gap-6 items-start">
            <!-- Tabla - ahora ocupa más espacio -->
            <div class="w-full lg:w-5/6 bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Lista de Productos</h2>
                </div>
            
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
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
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
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
                                    <td class="px-4 py-3 text-sm text-right space-x-2">
                                        <a href="{{ route('productos.show', $producto->id) }}" class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">
                                            Ver Detalle
                                        </a>
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300">
                                            Editar
                                        </a>


                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>


                                    </td>
                                </tr>
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
            
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    {{-- {{ $productos->links() }} --}}
                </div>
            </div>
            
            <!-- Botón movido más a la derecha -->
            <div class="w-full lg:w-1/6 flex justify-end">
                <a href="{{route('productos.create')}}" class="w-full px-4 py-2 text-center text-white bg-blue-600 hover:bg-blue-700 rounded-md transition duration-200">
                    Crear
                </a>
            </div>
        </div>
    </div>
</main>