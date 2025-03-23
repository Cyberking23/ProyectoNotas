<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Mensaje de bienvenida -->
        <div class="bg-blue-100 text-blue-700 p-4 rounded-lg mb-6">
            <p class="text-lg font-semibold">¡Bienvenido, {{ Auth::user()->first_name }}!</p>
        </div>

        <!-- Barra superior -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Notes</h1>
            
            <div class="flex items-center space-x-4">
                <a href="#" class="text-blue-500">Logout</a>
            </div>
        </div>

        <!-- Lista de Notas -->
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-start">
                    <h2 class="font-semibold">Organize Home Office</h2>
                    <span>📌</span>
                </div>
                <p class="text-gray-500 text-sm">6th Apr 2024</p>
                <p class="text-gray-700 mt-2">My home office has become a cluttered mess...</p>
                <p class="text-blue-500 text-sm mt-2">#Organization #Productivity</p>
                <div class="flex justify-end space-x-2 mt-3">
                    <button>✏️</button>
                    <button>🗑️</button>
                </div>
            </div>
        </div>

        <!-- Botón flotante para agregar notas -->
        <a href="{{ route('notes.form') }}">
            <button class="fixed bottom-6 right-6 bg-blue-500 text-white rounded-full w-12 h-12 text-2xl flex items-center justify-center shadow-lg">+</button>
        </a>
    </div>
</body>
</html>
