<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FINANZAS PRO') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="{{ asset('lofo-v2.png') }}" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        <style>
            /* Estilo consistente para el botón ACERCA DE NOSOTROS */
            .about-us-btn {
                font-family: 'Figtree', sans-serif !important;
                font-size: 14px !important;
                font-weight: 800 !important;
                text-transform: uppercase !important;
                letter-spacing: 0.5px !important;
                color: #1e40af !important;
                text-decoration: none !important;
                padding: 8px 16px !important;
                border-radius: 6px !important;
                transition: all 0.3s ease !important;
                display: inline-block !important;
                line-height: 1.2 !important;
                white-space: nowrap !important;
            }
            
            .about-us-btn:hover {
                color: #1d4ed8 !important;
                background-color: rgba(30, 64, 175, 0.1) !important;
                transform: translateY(-1px) !important;
            }
            
            .about-us-btn:active {
                transform: translateY(0) !important;
            }

            /* Estilo consistente para el botón TUTORIAL */
            .tutorial-btn {
                font-family: 'Figtree', sans-serif !important;
                font-size: 14px !important;
                font-weight: 600 !important;
                color: #ffffff !important;
                background-color: #1e40af !important;
                text-decoration: none !important;
                padding: 8px 16px !important;
                border-radius: 6px !important;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
                transition: all 0.3s ease !important;
                display: inline-block !important;
                line-height: 1.2 !important;
                white-space: nowrap !important;
                border: none !important;
                cursor: pointer !important;
            }
            
            .tutorial-btn:hover {
                background-color: #1d4ed8 !important;
                box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15) !important;
                transform: translateY(-1px) !important;
            }
            
            .tutorial-btn:active {
                transform: translateY(0) !important;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            }
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-50">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header>
                    <div class="max-w-7xl mx-auto py-10 pb-1 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @isset($slot)
                    {{ $slot }}
                    
                @endisset
                @yield('css')
                @yield('content')
                @yield('js')
                <footer id="footer" class="w-full p-6 flex justify-center items-center bg-white border-t border-slate-200">
                    <!-- Botón Acerca de Nosotros -->
                    <a href="#" id="openModalBtn" class="about-us-btn">ACERCA DE NOSOTROS</a>
                </footer>
                
                <!-- Modal -->
                <div id="aboutModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-2xl mx-auto max-h-screen overflow-y-auto border border-slate-200">
                        <h2 class="text-xl font-bold mb-4 text-gray-800">Acerca de Nosotros</h2>
                        <p class="mb-4 text-justify text-gray-700">Somos tres estudiantes de Ingeniería en Computación apasionados por la tecnología y comprometidos con la creación de soluciones innovadoras que marquen la diferencia en la vida de las personas. Nuestro proyecto es un asesor financiero diseñado para ser intuitivo, accesible y, sobre todo, efectivo en ayudar a las personas a gestionar sus finanzas personales de manera inteligente.</p>
                        <p class="mb-4 text-justify text-gray-700">Creemos que el futuro financiero comienza con decisiones bien informadas, y nuestro asesor está aquí para guiarte en cada paso del camino, haciendo que la planificación financiera sea más fácil, eficiente y a tu alcance.</p>
                        <button id="closeModalBtn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition duration-300">Cerrar</button>
                    </div>
                </div>
                
                <script>
                    // Obtener elementos del DOM
                    const openModalBtn = document.getElementById('openModalBtn');
                    const closeModalBtn = document.getElementById('closeModalBtn');
                    const aboutModal = document.getElementById('aboutModal');
                
                    // Mostrar el modal
                    openModalBtn.addEventListener('click', function(event) {
                        event.preventDefault(); // Evita el comportamiento predeterminado del enlace
                        aboutModal.classList.remove('hidden');
                    });
                
                    // Ocultar el modal
                    closeModalBtn.addEventListener('click', function() {
                        aboutModal.classList.add('hidden');
                    });
                
                    // Cerrar el modal si se hace clic fuera de él
                    window.addEventListener('click', function(event) {
                        if (event.target === aboutModal) {
                            aboutModal.classList.add('hidden');
                        }
                    });
                </script>
                
            </main>
        </div>
    </body>
</html>
