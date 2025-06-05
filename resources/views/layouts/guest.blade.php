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
        <link rel="icon" href="{{asset('lofo-v2.png')}}" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Sticky Footer CSS */
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            
            .main-content-wrapper {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding-top: 1.5rem;
                padding-bottom: 0;
            }
            
            footer {
                margin-top: auto;
            }
        </style>
    </head>
    <body class="font-sans text-gray-800 antialiased">
        <div class="main-content-wrapper bg-gradient-to-br from-slate-50 to-blue-50">
            <div class="flex flex-col items-center">
                <div class="mb-6">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-blue-800" />
                    </a>
                </div>

                <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-lg overflow-hidden sm:rounded-lg border border-slate-200">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Footer siempre al final -->
        <footer class="w-full p-4 flex justify-center items-center bg-white border-t border-slate-200 shadow-sm">
            <p class="text-sm text-gray-600">
                © {{ date('Y') }} <span class="font-semibold text-blue-800">Finanzas Pro</span> - Asesor Financiero Personal
            </p>
        </footer>
    </body>
</html>
