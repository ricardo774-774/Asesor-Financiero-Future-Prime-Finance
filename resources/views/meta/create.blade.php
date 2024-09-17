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
            <div class="bg-red-500 text-white text-center p-4 rounded mb-5">
                <p><strong>Error:</strong> Tienes {{ count($errores) }} error(es) en tu formulario:</p>
                <ul class="mt-2">
                    @foreach ($errores as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('errores') && is_array(session('errores')) > 0)
            <div class="bg-red-500 text-white text-center p-4 rounded mb-5">
                <p><strong>Error:</strong> Tienes {{ count(session('errores')) }} error(es) en tu formulario:</p>
                <ul class="mt-2">
                    @foreach (session('errores') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-5">Usuario</h1>
        
        <form method="POST" action="{{ $condicion_meta ? route('meta.update', $meta->meta->id) : route('meta.store') }}">
            @csrf
            @if ($condicion_meta)
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
        <div class="flex space-x-4 mt-8">
            <div class="w-1/2">
                <!-- Segundo formulario con más separación -->
                <form method="POST" action="{{ route('historicos.store') }}" class="mb-4">
                    @csrf
                    @method('POST')
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Generar registro diario
                        </button>
                    </div>
                </form>
                <form method="POST" action="{{ route('meta.calculoia') }}" class="mb-4">
                    @csrf
                    @method('POST')
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Llamada a la API
                        </button>
                    </div>
                </form>
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
                            <td class="border-t py-3 px-4">{{ isset($metaapi) ? $metaapi->meta_dinero: 'Sin definir' }}</td>
                            <td class="border-t py-3 px-4">{{ isset($metaapi) ? $metaapi->fecha_meta : 'Sin definir' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border-t py-3 px-4">{!! isset($metaapi) ?"<img src=".asset ($metaapi->foto?$metaapi->foto:'metadefault.jpg').">": 'Sin definir' !!}</td>
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
                                        <td class="border-t py-3 px-4"><img src="{{ asset($ahorro->foto) }}"></td>
   
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
        <p class="mb-4">Bienvenido a la pantalla de Metas. Te sugerimos utilizar el generador de ideas para apoyarte en seleccionar un objetivo. O bien, elige tu meta por tu cuenta. Después de seleccionarla, consulta nuestra Inteligencia Artificial para obtener una predicción sobre el ahorro que necesitas considerar para lograr tu meta. ¡No olvides hacer tu registro diario! 
            
            
            
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
</script>
@endsection

@section('js')
    <!-- Puedes agregar scripts aquí si es necesario -->
@endsection
