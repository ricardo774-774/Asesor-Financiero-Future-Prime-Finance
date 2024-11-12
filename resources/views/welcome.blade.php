<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FUTURE PRIME FINANCE</title>
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
            font-size: 1.2rem;
            color: #f7f7f7;
            border-radius: 8px;
            transition: background-color 0.3s;
        }600
    </style>
</head>

<body class="flex flex-col lg:flex-row items-center justify-center min-h-screen bg-cover bg-center text-gray-100" style="background-image: url('{{asset('money-fond.png')}}');">
    
    <!-- Primera columna - Presentación -->
    <div class="flex flex-col items-center text-center lg:text-left p-8 bg-opacity-60 bg-black rounded-lg max-w-md mx-4 lg:mx-0 lg:min-w-3/5">
        <h1 class="text-4xl lg:text-6xl font-bold leading-tight mb-4">Bienvenidos a Future Prime Finance</h1>
        <p class="text-lg lg:text-xl leading-relaxed text-justify">En Future Prime Finance, estamos dedicados a ayudarte a alcanzar tus metas financieras. Ya sea que estés buscando ahorrar para el futuro, invertir sabiamente o simplemente manejar mejor tu dinero, estamos aquí para ofrecerte las herramientas y el conocimiento que necesitas.</p>
    </div>
    
    <!-- Segunda columna - Acceso/Registro -->
    <div class="flex flex-col items-center bg-black bg-opacity-60 rounded-lg shadow-lg p-8 mt-8 lg:mt-0 lg:ml-8 max-w-sm w-full mx-4 lg:w-2/5">
        <div class="flex flex-col items-center mb-6">
            <p class="text-lg lg:text-2xl mb-4">¿Ya tienes una cuenta?</p>
            <a href="{{ route('login') }}" class="button-inicio bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700">Acceso</a>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-lg lg:text-2xl mb-4">¿Aún no te has registrado?</p>
            <a href="{{ route('register') }}" class="button-inicio bg-green-600 text-white py-3 px-6 rounded-md hover:bg-green-700">Registrarse</a>
        </div>
    </div>

</body>
</html>