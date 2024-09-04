@extends('layouts.app')

@section('css')
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container mx-auto mt-10">
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
@endsection

@section('js')
    <!-- Puedes agregar scripts aquí si es necesario -->
@endsection
