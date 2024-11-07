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

    .main-box {
        border: 1px solid rgba(225, 225, 225, 0.8);
        box-shadow: 0px 0px 10px #ccc;
    }
    
    #image {
        height: auto; /* Ajuste para que las imágenes se adapten */
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

    /* Estilos para el contenido del modal */
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


<div class="w-full bg-gray-100 p-4 flex justify-between items-center">
    <!-- Botón Ayuda a la izquierda -->
    <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Tutorial</a>  
</div>
    <div id="min" class="container  mx-auto mt-10 ">
        <!-- Nueva Sección para mostrar Categorías como un formulario -->
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
        <div class="mt-8">
            <h1 class="text-4xl font-bold mb-5 text-center uppercase">Generador de Categorías</h1>
                <div class="w-4/5 mx-auto">
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
                
    
                <div class="w-4/5 mx-auto mt-10 text-center justify-center text-sm">
                    <p class="mb-2">
                        Alcanzar metas materiales puede ser una fuente de satisfacción personal. Es una manera tangible de ver el fruto de tu esfuerzo y dedicación, lo cual puede aumentar tu autoestima y motivación para seguir alcanzando otros objetivos. Además, poseer bienes materiales te da una mayor independencia. No depender de terceros para tu vivienda o transporte te permite tomar decisiones más libres y vivir de acuerdo a tus propias reglas y necesidades.
                    </p>
                    <span class="font-bold">
                        Sigue adelante con confianza y determinación
                    </span>
                </div>
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
    <div class="modal-content bg-white p-6 rounded-lg shadow-lg m-8">
        <h2 class="text-xl font-bold mb-4">Generador</h2>
        <p class="mb-4 text-justify">
            Bienvenido al Generador de Ideas. 
        </p>
        <p class="mb-4 text-justify">
            Te sugerimos algunas metas populares para empezar a fomentar tu cultura de ahorro. 
            Selecciona una, y en base a tu información financiera, te daremos una sugerencia de una meta para perseguir. 
            Aunque no es obligatorio, creemos que te puede motivar a visualizar los resultados de tu ahorro. 
            Haz clic en el botón de enviar para consultar tu predicción.
        </p>
        <button id="closeModalBtnAyuda" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
    </div>
</div>


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

@section('js')
    <!-- Puedes agregar scripts aquí si es necesario -->
@endsection
