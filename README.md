# 008-Laravel11-CRUD
 laravel-breeze-tailwind

 composer create-project --prefer-dist laravel/laravel crud "11.*"

en .env

     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=dbcrud07
     DB_USERNAME=root
     DB_PASSWORD=123456

Consola (migracion)

     php artisan migrate

Instalando Breeze en caso requiera en este es innecesario

     php artisan help breeze:install

     php artisan breeze:install --help

     php artisan breeze:install --stack=blade --dark

     php artisan breeze:install blade --dark

deberiamos de hacer unas configuraciones

Consola (tailwind)

     npm install -D tailwindcss postcss autoprefixer

     npx tailwindcss init -p

     npm install && npm run dev

     php artisan serve

     php artisan migrate


     php artisan make:model Producto -mcr     


