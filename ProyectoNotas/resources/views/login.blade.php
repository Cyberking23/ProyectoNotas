<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-300">
    <div class="flex flex-col md:flex-row-reverse bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-3xl">
        
        <div class="w-full md:w-1/2 hidden md:block">
            <img class="w-full h-full object-cover" src="../../public/img/Escrito.jpeg" alt="Imagen representativa de notas">
        </div>

        <div class="w-full md:w-1/2 p-8 space-y-6">
            <h2 class="text-2xl font-bold text-center text-gray-800">Iniciar Sesión</h2>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input type="email" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" placeholder="correo@gmail.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <div class="relative">
                        <input id="password" type="password" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none pr-10" placeholder="••••••••">
                        <button type="button" id="ojito" class="absolute inset-y-0 right-2 flex items-center pr-2 text-gray-600 hover:text-gray-800">
                            👁️
                        </button>
                    </div>
                </div>
                <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">Ingresar</button>
            </form>
            <p class="text-sm text-center text-gray-600">¿No tienes una cuenta? <a href="#" class="text-blue-500 hover:underline">Regístrate</a></p>
        </div>
    </div>

    <script>
        document.getElementById('ojito').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        });
    </script>
</body>
</html>
