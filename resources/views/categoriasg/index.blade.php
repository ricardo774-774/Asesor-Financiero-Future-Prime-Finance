@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <div class="flex flex-col justify-center items-center min-h-screen">
        <a href="{{route('categoriasg.create')}}"class="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Añadir Datos</a>
        <div class="overflow-x-auto">
            <table class="table-auto border-collapse border border-gray-400">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-400 px-4 py-2">ID</th>
                        <th class="border border-gray-400 px-4 py-2">CATEGORIA</th>
                        <th class="border border-gray-400 px-4 py-2">FV</th>
                        <th class="border border-gray-400 px-4 py-2">Administrar</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $item)
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">{{$item->id}}</td>
                        <td class="border border-gray-400 px-4 py-2">{{$item->Nombre}}</td>
                        <td class="border border-gray-400 px-4 py-2">{{$item->fv}}</td>
                        <td class="border border-gray-400 px-4 py-2">
                            <form action="{{ route('categoriasg.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <!-- Incluye JavaScript si es necesario -->
@endsection
