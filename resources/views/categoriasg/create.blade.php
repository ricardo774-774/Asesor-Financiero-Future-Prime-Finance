@extends('layouts.app')

@section('css')
    <!-- Agrega los estilos de Tailwind CSS si aún no están incluidos -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">
                Categoria
            </h1>
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('categoriasg.store') }}" method="POST">
                @csrf
        

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                        Nombre
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" name="Nombre" type="text" placeholder="Nombre">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fv">
                        FV
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fv" name="fv" type="text" placeholder="FV">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fv">
                        id
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fv" name="id" type="number" placeholder="id">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Crear Categoria
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <!-- Incluye JavaScript si es necesario -->
@endsection
