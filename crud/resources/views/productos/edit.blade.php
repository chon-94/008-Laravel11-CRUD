@extends('layouts/main')


    <main class="mt-20 mb-1">
        <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6">ACTUALIZAR</h1>
    
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Formulario de Producto</h2>
            </div>
    
            <div class="p-6">
            <form action="{{route('productos.update', $producto->id)}}" method="Post">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Campo Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre*</label>
                    <input type="text" id="nombre" name="nombre" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required value="{{ $producto->nombre }}">
                </div>
    
<!-- Campo Origen -->
<div>
    <label for="origen" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Origen*</label>
    <select id="origen" name="origen" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
        <option value="">Seleccione el origen...</option>
        <option value="Fabricado" {{ $producto->origen == 'Fabricado' ? 'selected' : '' }}>Fabricado</option>
        <option value="Adquirido" {{ $producto->origen == 'Adquirido' ? 'selected' : '' }}>Adquirido</option>
    </select>
</div>

<!-- Campo Unidad -->
<div>
    <label for="unidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unidad*</label>
    <select id="unidad" name="unidad" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
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
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required value="{{ $producto->stock }}">
                </div>
    
                <!-- Campos de Precios -->
                <div>
                    <label for="compra" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio Compra*</label>
                    <input type="number" id="compra" name="compra" required min="0" step="0.01"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required value="{{ $producto->compra }}">
                </div>
    
                <div>
                    <label for="venta" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio Venta*</label>
                    <input type="number" id="venta" name="venta" required min="0" step="0.01"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required value="{{ $producto->venta }}">
                </div>
    
<!-- Campo Perecedero -->
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
    
                <!-- Campo Fecha Caducidad (se muestra solo si es perecedero) -->
<!-- Campo Fecha Caducidad -->
<div id="fecha-caducidad-container" style="display: {{ $producto->es_perecedero ? 'block' : 'none' }};">
    <label for="fecha_caducidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha Caducidad</label>
    <input type="date" id="fecha_caducidad" name="fecha_caducidad" 
           value="{{ $producto->fecha_caducidad ? $producto->fecha_caducidad->format('Y-m-d') : '' }}"
           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
</div>
    
<!-- Campo Descripción -->
<div class="md:col-span-2">
    <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
    <textarea id="descripcion" name="descripcion" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ $producto->descripcion }}</textarea>
</div>
                </div>
    
                <!-- Botones -->
                <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('productos.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-secondary-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    ACTUALIZAR
                </button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </main>
        
        <!-- Script para mostrar/ocultar fecha caducidad -->
        <script>
            document.querySelector('input[name="es_perecedero"]').addEventListener('change', function() {
                const fechaContainer = document.getElementById('fecha-caducidad-container');
                fechaContainer.style.display = this.checked ? 'block' : 'none';
            });
        </script>