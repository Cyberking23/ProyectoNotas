<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-white">
    <div class="flex flex-col md:flex-row-reverse bg-white shadow-2xl rounded-2xl overflow-hidden w-full max-w-3xl transform transition duration-500 hover:scale-105 border border-gray-300">
        
        <div class="w-full md:w-1/2 hidden md:block bg-gray-100">
            <img class="w-full h-full object-cover" src="../../public/img/Escrito.jpeg" alt="Imagen representativa de notas">
        </div>

        <div class="w-full md:w-1/2 p-10 space-y-6">
            <h2 id="form-title" class="text-3xl font-extrabold text-center text-gray-800">Iniciar Sesión</h2>
            
            <form id="login-form" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Correo electrónico</label>
                    <input type="email" class="w-full px-4 py-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none shadow-md" placeholder="correo@gmail.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Contraseña</label>
                    <div class="relative">
                        <input id="password" type="password" class="w-full px-4 py-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none shadow-md pr-10" placeholder="••••••••">
                        <button type="button" id="ojito" class="absolute inset-y-0 right-2 flex items-center pr-2 text-gray-600 hover:text-gray-800">
                            👁️
                        </button>
                    </div>
                </div>
                <button type="submit" class="w-full px-4 py-3 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-lg transform transition duration-300 hover:scale-105">Ingresar</button>
            </form>
            
            <form id="register-form" class="space-y-4 hidden">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Nombre completo</label>
                    <input type="text" class="w-full px-4 py-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none shadow-md" placeholder="Tu nombre">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Correo electrónico</label>
                    <input type="email" class="w-full px-4 py-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none shadow-md" placeholder="correo@gmail.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Contraseña</label>
                    <input type="password" class="w-full px-4 py-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none shadow-md" placeholder="••••••••">
                </div>
                <button type="submit" class="w-full px-4 py-3 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-lg transform transition duration-300 hover:scale-105">Registrarse</button>
            </form>
            
            <p class="text-sm text-center text-gray-600">¿No tienes una cuenta? <a href="#" id="toggle-form" class="text-blue-600 hover:underline font-semibold">Regístrate</a></p>
        </div>
    </div>

    <script>
        document.getElementById('ojito').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        });

        document.getElementById('toggle-form').addEventListener('click', function (event) {
            event.preventDefault();
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const formTitle = document.getElementById('form-title');
            
            if (loginForm.classList.contains('hidden')) {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                formTitle.textContent = 'Iniciar Sesión';
                this.textContent = 'Regístrate';
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                formTitle.textContent = 'Registro';
                this.textContent = 'Iniciar Sesión';
            }
        });
    </script>
</body>
</html>