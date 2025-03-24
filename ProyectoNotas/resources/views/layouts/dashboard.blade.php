<!DOCTYPE html>
   <html lang="es">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>ADS Notas - Panel</title>
       @vite(['resources/css/app.css'])
   </head>

   <body class="bg-zinc-50">
       <!-- Contenedor Principal -->
       <div class="min-h-screen flex">
           <!-- Barra Lateral -->
           <aside class="w-[280px] bg-white border-r border-zinc-100 p-6 fixed h-full">
               <div class="flex items-center gap-3 mb-12">
                   <div class="w-8 h-8 bg-indigo-500 rounded-lg"></div>
                   <h1 class="font-semibold text-xl">DSS Notas</h1>
               </div>

               <nav class="space-y-1">
                   <!-- Botón Crear Nota -->
                   <a href="#"
                       class="flex items-center gap-3 p-3 mb-4 rounded-xl bg-indigo-500 text-white hover:bg-indigo-600 transition-colors">
                       <i class='bx bx-plus text-xl'></i>
                       Crear Nota
                   </a>

                   <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-indigo-50 text-indigo-600">
                       <i class='bx bx-file text-xl'></i>
                       Todas las Notas
                   </a>
                   <a href="#" class="flex items-center gap-3 p-3 rounded-xl text-zinc-600 hover:bg-zinc-50">
                       <i class='bx bx-star text-xl'></i>
                       Favoritos
                   </a>
               </nav>
           </aside>

           <!-- Contenido Principal -->
           <main class="ml-[280px] flex-1 p-8">
               @yield('content')
           </main>
       </div>
   </body>

   </html>