<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    @vite('resources/css/app.css') <!-- Asegúrate de incluir Tailwind CSS -->
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold mb-6">Registro</h1>
            @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="FirstName" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="FirstName" name="FirstName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
        
            <div class="mb-4">
                <label for="LastName" class="block text-sm font-medium text-gray-700">Apellidos</label>
                <input type="text" id="LastName" name="LastName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
        
            <div class="mb-4">
                <label for="PhoneNumber" class="block text-sm font-medium text-gray-700">Número de Teléfono</label>
                <input type="text" id="PhoneNumber" name="PhoneNumber" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
        
            <div class="mb-4">
                <label for="Email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" id="Email" name="Email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
        
            <div class="mb-4">
                <label for="Password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" id="Password" name="Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>

        
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                Registrarse
            </button>
        </form>
        
        <p class="mt-4 text-center">
            ¿Ya tienes una cuenta? <a href="/login" class="text-indigo-600 hover:underline">Inicia Sesión</a>
        </p>
    </div>
</body>
</html>