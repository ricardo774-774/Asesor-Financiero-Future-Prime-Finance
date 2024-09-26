@extends('layouts.app')

@section('css')
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="w-full bg-gray-100 p-4 flex justify-between items-center">
    <!-- Botón Ayuda a la izquierda -->
    <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Tutorial</a>  
</div>
    <div class="container mx-auto mt-10">
        <!-- Alerta de errores -->
        @if (isset($errores) && count($errores) > 0)
            <div id="error-message" class="bg-red-500 text-white text-center p-4 rounded mb-5">
                <p><strong>Error:</strong> Tienes {{ count($errores) }} error(es) en tu formulario:</p>
                <ul class="mt-2">
                    @foreach ($errores as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('errores') && is_array(session('errores')) > 0)
            <div id="error-message" class="bg-red-500 text-white text-center p-4 rounded mb-5">
                <p><strong>Error:</strong> Tienes {{ count(session('errores')) }} error(es) en tu formulario:</p>
                <ul class="mt-2">
                    @foreach (session('errores') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-4xl font-bold mb-5 text-center">ANÁLISIS FINANCIERO</h1>
        
        <form method="POST" action="{{ $condicion_previo ? route('previo.update', $previo->previo->id) : route('previo.store') }}">
            @csrf
            @if ($condicion_previo)
                @method('PUT')
            @else
                @method('POST')
            @endif
            <div>
                <label for="cantidad" class="block text-gray-700 text-sm font-bold mb-2">Ingresa tu meta en cantidad de dinero:</label>
                <input type="number" id="cantidad" name="cantidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese una cantidad" required>
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Ingresa la fecha objetivo de tu meta:</label>
                <input type="date" id="fecha" name="fecha" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Enviar
                </button>
            </div>
        </form>

        <!-- Contenedor para los botones y la tabla de "Mi Objetivo Financiero" -->
        <div class="flex space-x-4 mt-8 h-3/5">
            <div class="grid grid-cols-2 w-1/2 h-auto text-center">

                {{-- Generar registro diario CARD --}}
                <div class="relative group bg-white shadow-md rounded-xl h-auto w-11/12 flex flex-col justify-between">
                    <div class="block w-full">
                        <div class="p-6">
                            <h3 class="text-center text-xl font-bold mb-2 uppercase">Sobre registro diario</h3>
                            <p class="text-gray-600">Almacena tu historial financiero, registrando tanto el saldo disponible como la fecha exacta en el momento de la operación. Esta información será utilizada para proporcionarte una predicción basada en datos reales sobre tu situación financiera.</p>
                        </div>
                    </div>
                
                    <form method="POST" action="{{ route('historicos.store') }}" class="flex justify-center m-2 mb-4 mt-auto">
                        @csrf
                        @method('POST')
                        <button class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            <svg class="w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                            </svg>                              
                            <p>Generar Registro</p>
                        </button>
                    </form>
                </div>
                

                {{-- Generar prediccion CARD --}}
                <div class="relative group bg-white shadow-md rounded-xl h-auto w-11/12 flex flex-col justify-between">

                    <div class="block w-full">
                        <div class="p-6">
                            <h3 class="text-center text-xl font-bold mb-2 uppercase">Sobre predicción</h3>
                            <p class="text-gray-600">Realiza un analisis financiero a través de un objetivo económico seleccionado. Consulta cómo puedes ahorrar para lograr tu objetivo.</p>
                        </div>
                    </div>
                
                    <form method="POST" action="{{ route('calculoia') }}" class="flex justify-center m-2 mb-4 mt-auto">
                        @csrf
                        @method('POST')
                        <div class="flex justify-between">
                            <button class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                <svg class="w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                </svg>
                                <p>Generar predicción</p>
                            </button>
                        </div>                    
                    </form>
                </div>
            </div>

            <!-- Tabla "Mi Objetivo Financiero" -->
            <div class="w-1/2">
                <h2 class="text-xl font-bold mb-2">Mi Objetivo Financiero Actual</h2>
                <table class="w-full bg-white table-auto">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 bg-gray-200 text-left text-sm font-bold text-gray-700">Dinero Objetivo</th>
                            <th class="py-3 px-4 bg-gray-200 text-left text-sm font-bold text-gray-700">Fecha Objetivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-t py-3 px-4">{{ isset($previoapi) ? $previoapi->dinero_previo : 'Sin definir' }}</td>
                            <td class="border-t py-3 px-4">{{ isset($previoapi) ? $previoapi->fecha_meta : 'Sin definir' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Contenedor para las tablas de "Resultados" y "Mis Predicciones" -->
        <div class="flex space-x-4 mt-8">
            <!-- Tabla con "mi fecha" y "mi saldo" -->
            <div class="w-1/2">
                @if (isset($historicoapi) && $historicoapi->count() > 0)
                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-4">Resultados</h2>
                        <div>
                            <table class="w-full bg-white table-auto">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-4 bg-gray-200 text-left text-sm font-bold text-gray-700">Mi Fecha</th>
                                        <th class="py-3 px-4 bg-gray-200 text-left text-sm font-bold text-gray-700">Mi Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historicoapi as $item)
                                        <tr>
                                            <td class="border-t py-3 px-4">{{ $item->fecha_click }}</td>
                                            <td class="border-t py-3 px-4">{{ $item->saldo }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Tabla "Mis Predicciones" -->
            <div class="w-1/2">
                @if (isset($response))
                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-4">Mis Predicciones</h2>
                        <div>
                            <table class="w-full bg-white table-auto">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-4 bg-gray-200 text-left text-sm font-bold text-gray-700">Ahorro Diario Extra Necesario</th>
                                        <th class="py-3 px-4 bg-gray-200 text-left text-sm font-bold text-gray-700">Ahorro Mensual Extra Necesario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($response as $item)
                                            <td class="border-t py-3 px-4">{{ $item }}</td>
                                        @endforeach
                                    </tr>
                                    @if (isset($ahorro))
                                        
                                    <tr>
                                        <td class="border-t py-3 px-4">{{ $ahorro->ejemplo }}</td>   
                                        <td class="border-t py-3 px-4"><img src="{{ $ahorro->foto }}"></td>  
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
<!-- Modal -->
<div id="aboutModalAyuda" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-400">
        <h2 class="text-xl font-bold mb-4">Ayuda</h2>
        <p class="mb-4">Bienvenido a tus Análisis Financieros. Ingresa una cantidad de dinero y el plazo en el que quieres conseguirlo. Con ayuda de nuestra Inteligencia Artificial vas a tener una predicción sobre el ahorro extra que necesitas para poder lograr tu objetivo. Además, verás una recomendación sobre lo que representa tu ahorro de manera visual. ¡No olvides hacer tu registro diario!
            
            
            
            </p>
        <button id="closeModalBtnAyuda" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
    </div>
</div>

<script>
    // Obtener elementos del DOM
    const openModalBtnAyuda = document.getElementById('openModalBtnAyuda');
    const closeModalBtnAyuda = document.getElementById('closeModalBtnAyuda');
    const aboutModalAyuda = document.getElementById('aboutModalAyuda');

    // Mostrar el modal
    openModalBtnAyuda.addEventListener('click', function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace
        aboutModalAyuda.classList.remove('hidden');
    });

    // Ocultar el modal
    closeModalBtnAyuda.addEventListener('click', function() {
        aboutModalAyuda.classList.add('hidden');
    });

    // Cerrar el modal si se hace clic fuera de él
    window.addEventListener('click', function(event) {
        if (event.target === aboutModalAyuda) {
            aboutModalAyuda.classList.add('hidden');
        }
    });

    // Quitar de la vista el error
    if (document.getElementById('error-message')) {
        let errorDiv = document.getElementById('error-message');
        setTimeout(() => {
            errorDiv.remove();
        }, 5000 );
    }
</script>
@endsection

@section('js')
    <!-- Puedes agregar scripts aquí si es necesario -->
@endsection
