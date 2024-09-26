<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FUTURE PRIME FINANCE</title>
    {{-- <link rel="icon" href="{{ asset('logo_transparent.png') }}" type="image/x-icon"> --}}
    <link rel="icon" href="{{ asset('lofo-v2.png') }}" type="image/x-icon">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Estilos personalizados -->
    <style>
        .button-inicio {
            padding: 12px 24px;
            background-color: #cbcaca;
            font-size: 1.5rem;
            color: rgb(64, 64, 64);
            border-radius: 8px;
            transition: background-color 0.3s;
        }
    
        .button-inicio:hover {
            background-color: #aaaaaa;
        }
    
        .cajafondo {
            padding: 48px;
            background: rgba(2, 8, 18, 0.669);
            text-align: center;
            height:100%;
            width: auto;
        }
    </style>
    
    <body class="w-full h-screen grid grid-cols-2 font-sans antialiased dark:bg-black dark:text-white/50 min-h-screen items-center justify-center bg-cover bg-center" style="background-image: url('{{asset('money-fond.png')}}');">
    
        <!-- Primera columna - cajafondo -->
        <div class="w-full h-full flex items-center justify-center">
            <div class="w-max max-w-2xl px-6 lg:max-w-7xl cajafondo">
                <h1 class="text-left font-bold text-8xl mb-5 text-white">Bienvenidos a Future Prime Finance</h1>
                <p class="text-left text-3xl text-slate-200">
                    En Future Prime Finance, estamos dedicados a ayudarte a alcanzar tus metas financieras. Ya sea que estés buscando ahorrar para el futuro, invertir sabiamente o simplemente manejar mejor tu dinero, estamos aquí para ofrecerte las herramientas y el conocimiento que necesitas.
                </p>
            </div>
        </div>
    
        <!-- Segunda columna - contenido test -->
        <div class="w-full h-full flex items-center justify-center">
            <div class="font-bold text-center text-4xl border-2 border-gray-600 bg-black bg-opacity-40 rounded-xl shadow-lg p-8">
                <div class="grid mb-8">
                    <p class="text-white mb-3 text-2xl">¿Ya tienes una cuenta?</p>
                    <a href="{{ route('login') }}" class="button-inicio bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500 transition duration-300">Acceso</a>
                </div>
                <div class="grid">
                    <p class="text-white mb-3 text-2xl">¿Aún no te has registrado?</p>
                    <a href="{{ route('register') }}" class="button-inicio bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-500 transition duration-300">Registrarse</a>
                </div>
            </div>
        </div>
        
    
    </body>
</html>
