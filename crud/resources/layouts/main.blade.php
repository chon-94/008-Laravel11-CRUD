<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-2x6VZ1YF4M+EZ7V4V1JZ4f6qHeJkK1W7UW2XZ2K1wD2QgMZyqZg0kHQbV7l8W5DjO2zKyojQAk6VFlfYzW0N1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Styles / Scripts -->
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
      <style>
        {!! file_get_contents(public_path('css/tailwind.css')) !!}
      </style>
  @endif
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
  
  <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen">

    <!-- Imagen de fondo -->
    <img
    id="background"
    class="fixed -left-20 top-0 max-w-[877px] opacity-50 z-0 pointer-events-none"
    src="https://laravel.com/assets/img/welcome/background.svg"
    alt="Laravel background" />
  
 <!-- Contenedor fijo para los dos botones -->
<div class="fixed top-4 right-4 z-50 flex gap-2">
  <!-- Botón para ir a la página welcome -->
  <a href="/" 
     class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
    Welcome
  </a>

  <!-- Botón para alternar modo claro/oscuro -->
  <button id="darkModeToggle" 
          class="px-4 py-2 rounded-md bg-gray-800 text-white dark:bg-gray-200 dark:text-gray-800 transition flex items-center gap-2">
    <i class="fa-solid fa-circle-half-stroke"></i>
    Claro/Oscuro
  </button>
</div>

    

    <!-- Contenido principal centrado -->
    <div class="relative flex flex-col items-center justify-center min-h-screen mt-8 selection:bg-[#FF2D20] selection:text-white">
      @yield('contenido')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </div>
</body>
</html>
