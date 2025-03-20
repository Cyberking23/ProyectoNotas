<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registro</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen flex items-center justify-center bg-white">
    <div class="flex flex-col md:flex-row-reverse bg-white shadow-2xl rounded-2xl overflow-hidden w-full max-w-3xl transform transition duration-500 hover:scale-105 border border-gray-300">
        
        <div class="w-full md:w-1/2 hidden md:block bg-gray-100">
            <img class="w-full h-full object-cover" src="{{ asset('img/Escrito.jpeg') }}" alt="Imagen representativa de notas">
        </div>

        <div class="w-full md:w-1/2 p-10 space-y-6">
            <h2 id="form-title" class="text-3xl font-extrabold text-center text-gray-800">Iniciar Sesión</h2>

            <!-- Mensajes de error -->
            <div id="error-message" class="text-red-600 text-center hidden"></div>

            <!-- Formulario de Login -->
            <form id="login-form" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none shadow-md" placeholder="correo@gmail.com" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Contraseña</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" class="w-full px-4 py-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none shadow-md pr-10" placeholder="••••••••" required>
                    </div>
                </div>
                <button type="submit" class="w-full px-4 py-3 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-lg transform transition duration-300 hover:scale-105">Ingresar</button>
            </form>
        </div>
    </div>

    @vite('resources/js/app.js')

    <script>
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault();

        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let errorMessage = document.getElementById('error-message');

        fetch("{{ route('login.post') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ email: email, password: password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                localStorage.setItem("jwt_token", data.token);
                alert("Inicio de sesión exitoso");
                window.location.href = "/dashboard";
            } else {
                errorMessage.textContent = data.error || "Credenciales incorrectas";
                errorMessage.classList.remove('hidden');
            }
        })
        .catch(error => console.error("Error:", error));
    });
    </script>
</body>
</html>
