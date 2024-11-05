@extends('layouts.app')

@section('css')
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        #min {
            min-height: 65vh; 
        }
        #aboutModalAyuda {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none; /* Oculto por defecto */
            align-items: center;
            justify-content: center;
        }
    
        .modal-content {
            background-color: #fff;
            padding: 20px;
            max-width: 70%;
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
    </style>
@endsection

@section('content')
    <div class="w-full bg-gray-100 p-4 flex justify-between items-center">
        <!-- Botón Ayuda a la izquierda -->
        <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Tutorial</a>  
    </div>

    <div class="container mx-auto mt-10">
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
            <div class="m-4">
                <label for="cantidad" class="block text-gray-700 text-sm font-bold mb-2">Ingresa tu meta en cantidad de dinero:</label>
                <input type="number" id="cantidad" name="cantidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese una cantidad" required>
            </div>
    
            <div class="m-4">
                <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Ingresa la fecha objetivo de tu meta:</label>
                <input type="date" id="fecha" name="fecha" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
    
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Enviar
                </button>
            </div>
        </form>
    
        <!-- Sección de "Generar Registro" y "Generar Predicción" -->
        <div class="flex flex-col lg:flex-row lg:space-x-4 mt-8">
            <div class="flex flex-col lg:w-1/2 space-y-4">
                <!-- Generar registro diario CARD -->
                <div class="bg-white shadow-md rounded-xl p-6 flex flex-col justify-between">
                    <h3 class="text-center text-xl font-bold mb-2 uppercase">Sobre registro diario</h3>
                    <p class="text-gray-600">Almacena tu historial financiero, registrando tanto el saldo disponible como la fecha exacta en el momento de la operación.</p>
                    <form method="POST" action="{{ route('historicos.store') }}" class="flex justify-center mt-4">
                        @csrf
                        <button class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline whitespace-nowrap" type="submit">
                            <svg class="w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25" />
                            </svg>
                            Generar Registro
                        </button>
                    </form>
                </div>
    
                <!-- Generar prediccion CARD -->
                <div class="bg-white shadow-md rounded-xl p-6 flex flex-col justify-between">
                    <h3 class="text-center text-xl font-bold mb-2 uppercase">Sobre predicción</h3>
                    <p class="text-gray-600">Realiza un análisis financiero a través de un objetivo económico seleccionado.</p>
                    <form method="POST" action="{{ route('calculoia') }}" class="flex justify-center mt-4">
                        @csrf
                        <button class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline whitespace-nowrap" type="submit">
                            <svg class="w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                            </svg>
                            Generar Predicción
                        </button>
                    </form>
                </div>
            </div>
    
            <!-- Tabla "Mi Objetivo Financiero" -->
            <div class="bg-white shadow-md rounded-xl p-6 lg:w-1/2 mt-4 lg:mt-0 text-center">
                <h2 class="text-xl font-bold mb-4">Mi Objetivo Financiero Actual</h2>
                <table class="w-full bg-white table-auto">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 bg-gray-200 text-sm font-bold text-gray-700">Dinero Objetivo</th>
                            <th class="py-3 px-4 bg-gray-200 text-sm font-bold text-gray-700">Fecha Objetivo</th>
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
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 mt-8">

            <!-- Tabla "Resultados" -->
            <div class="md:w-1/2 text-center mb-4">
                @if (isset($historicoapi) && $historicoapi->count() > 0)
                    <h2 class="text-xl font-bold mb-2">Resultados</h2>
                    <table class="w-full bg-white table-auto">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 bg-gray-200 text-sm font-bold text-gray-700">Mi Fecha</th>
                                <th class="py-3 px-4 bg-gray-200 text-sm font-bold text-gray-700">Mi Saldo</th>
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
                @endif 
            </div>

            <!-- Tabla "Mis Predicciones" -->
            <div class="md:w-1/2 text-center">
                @if (isset($response))
                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-2 text-center">Mis Predicciones</h2>
                        <div class="">
                            <table class="w-full bg-white table-auto">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-4 bg-gray-200 text-sm font-bold text-gray-700">Ahorro Diario Extra Necesario</th>
                                        <th class="py-3 px-4 bg-gray-200 text-sm font-bold text-gray-700">Ahorro Mensual Extra Necesario</th>
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

    <!-- Modal -->
    <div id="aboutModalAyuda" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg m-8">
            <h2 class="text-xl font-bold mb-4">Ayuda</h2>
            <p class="mb-4 text-justify">
                Bienvenido a tus Análisis Financiero. 
            </p>
            <p class="mb-4 text-justify">
                Ingresa una cantidad de dinero y el plazo en el que quieres conseguirlo. 
                Con ayuda de nuestra Inteligencia Artificial vas a tener una predicción sobre el ahorro extra
                que necesitas para poder lograr tu objetivo. Además, verás una recomendación sobre lo que representa 
                tu ahorro de manera visual. ¡No olvides hacer tu registro diario!            
            </p>
            <button id="closeModalBtnAyuda" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Obtener elementos del DOM
        const openModalBtnAyuda = document.getElementById('openModalBtnAyuda');
        const closeModalBtnAyuda = document.getElementById('closeModalBtnAyuda');
        const aboutModalAyuda = document.getElementById('aboutModalAyuda');

        // Abrir el modal
        openModalBtnAyuda.addEventListener('click', function(event) {
            event.preventDefault();
            aboutModalAyuda.style.display = 'flex';
        });

        // Cerrar el modal al hacer clic en el botón de cierre
        closeModalBtnAyuda.addEventListener('click', function() {
            aboutModalAyuda.style.display = 'none';
        });

        // Cerrar el modal al hacer clic fuera del contenido
        window.addEventListener('click', function(event) {
            if (event.target === aboutModalAyuda) {
                aboutModalAyuda.style.display = 'none';
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
