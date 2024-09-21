@extends('layouts.app')

@section('css')
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
<style>
    #min {
        min-height: 65vh; /* Altura mínima del 80% de la altura de la ventana */
    }
</style>


<div class="w-full bg-gray-100 p-4 flex justify-between items-center">
    <!-- Botón Ayuda a la izquierda -->
    <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Tutorial</a>  
</div>
    <div id="min" class="container  mx-auto mt-10 ">
        <!-- Nueva Sección para mostrar Categorías como un formulario -->
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
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Generador de Categorías</h2>
            <form method="POST" action="{{ route('generador.sugerencia') }}">
                @csrf
                <div class="mb-4">
                    <label for="categoria" class="block text-gray-700 text-sm font-bold mb-2">Selecciona una Categoría:</label>
                    <select id="categoria" name="categoria" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Enviar
                    </button>
                </div>
            </form>
        </div>

        <!-- Sección para mostrar la sugerencia si existe -->
        @if(isset($sugerencia))
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Sugerencia Seleccionada</h2>
                <div class="bg-gray-100 p-4 rounded shadow">
                    <p class="text-lg"><strong>Título:</strong> {{ $sugerencia->titulo }}</p>
                    <p class="text-lg"><strong>Monto:</strong> {{ $sugerencia->monto }}</p>
                </div>
                <form method="POST" action="{{ $meta ? route('meta.update', $meta->id) : route('meta.store') }}">
                    @csrf
                    @if ($meta)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div>
                        <label for="cantidad" class="block text-gray-700 text-sm font-bold mb-2">Ingresa tu meta en cantidad de dinero:</label>
                        <input type="number" value="{{$sugerencia->monto}}" id="cantidad" name="cantidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese una cantidad" required>
                    </div>
        
                    <div class="mb-4">
                        <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Ingresa la fecha objetivo de tu meta:</label>
                        <input type="date" value="{{$sugerencia->fecha}}" id="fecha" name="fecha" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
        
                    <div class="flex items-center justify-between">
                        <input type="hidden" value="{{$sugerencia->foto}}" name="foto">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Enviar
                        </button>
                    </div>
                </form>
        
            </div>
        @endif
    </div>

<!-- Modal -->
<div id="aboutModalAyuda" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-400">
        <h2 class="text-xl font-bold mb-4">Ayuda</h2>
        <p class="mb-4">Bienvenido al Generador de Ideas para Metas. Te sugerimos algunas metas populares para empezar a fomentar tu cultura de ahorro. Selecciona una, y en base a tu información financiera, te daremos una sugerencia de una meta para perseguir. Aunque no es obligatorio, creemos que te puede motivar a visualizar los resultados de tu ahorro. Haz clic en el botón de enviar para consultar tu predicción.
            
            
            
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
