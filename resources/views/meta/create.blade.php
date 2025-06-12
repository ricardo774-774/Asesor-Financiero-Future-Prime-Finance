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
    
    /* Estilo del modal */
    #aboutModalAyuda {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
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
        max-width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .tutorial-btn {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(30, 64, 175, 0.3);
    }

    .tutorial-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(30, 64, 175, 0.4);
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    }
</style>

<!-- Header Section with Tutorial Button -->
<div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">METAS FINANCIERAS</h1>
                <p class="text-blue-100 mt-2">Define y alcanza tus objetivos económicos</p>
            </div>
            <a href="#" id="openModalBtnAyuda" class="tutorial-btn">Tutorial</a>
        </div>
    </div>
</div>

<div class="min-h-screen bg-slate-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Alerta de errores -->
        @if (isset($errores) && count($errores) > 0)
            <div id="error-message" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 shadow-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <strong>Error:</strong> Tienes {{ count($errores) }} error(es) en tu formulario:
                </div>
                <ul class="mt-2 ml-7">
                    @foreach ($errores as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('errores') && is_array(session('errores')) > 0)
            <div id="error-message" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 shadow-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <strong>Error:</strong> Tienes {{ count(session('errores')) }} error(es) en tu formulario:
                </div>
                <ul class="mt-2 ml-7">
                    @foreach (session('errores') as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Meta Form Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8 mb-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Establece tu Meta</h2>
                <p class="text-gray-600">Define la cantidad y fecha para alcanzar tu objetivo financiero</p>
            </div>
            
            <form method="POST" action="{{ $condicion_meta ? route('meta.update', $meta->meta->id) : route('meta.store') }}" class="space-y-6">
                @csrf
                @if ($condicion_meta)
                    @method('PUT')
                @else
                    @method('POST')
                @endif
                
                <div class="space-y-2">
                    <label for="cantidad" class="block text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 inline mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                        Cantidad objetivo (MXN)
                    </label>
                    <input type="number" 
                           id="cantidad" 
                           name="cantidad" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                           placeholder="Ej: 50000" 
                           required>
                </div>            

                <div class="space-y-2">
                    <label for="fecha" class="block text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        Fecha objetivo
                    </label>
                    <input type="date" 
                           id="fecha" 
                           name="fecha" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                           required>
                </div>

                <div class="flex justify-center pt-4">
                    <button class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-8 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg" type="submit">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Establecer Meta
                    </button>
                </div>
            </form>
        </div>

        <!-- Action Cards Section -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <!-- Generar Registro Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 group">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Registro Diario</h3>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">Almacena tu historial financiero, registrando tanto el saldo disponible como la fecha exacta en el momento de la operación. Esta información será utilizada para proporcionarte una predicción basada en datos reales sobre tu situación financiera.</p>
                    <form method="POST" action="{{ route('historicos.store') }}" onsubmit="return validarRegistroDiario()">
                        @csrf
                    
                        <div class="mb-4">
                            <label for="saldo_diario" class="block text-sm font-semibold text-gray-700 mb-1">Saldo Actual (MXN)</label>
                            <input type="number" 
                                   id="saldo_diario" 
                                   name="saldo_diario" 
                                   step="0.01"
                                   min="0"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                   placeholder="Ej: 1250.75">
                        </div>
                    
                        <div class="mb-4">
                            <label for="fecha_registro" class="block text-sm font-semibold text-gray-700 mb-1">Fecha del Registro</label>
                            <input type="date" 
                                   id="fecha_registro" 
                                   name="fecha_registro" 
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>
                    
                        <button class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-md" type="submit">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Generar Registro
                        </button>
                    </form>
                </div>
            </div>

            <!-- Generar Predicción Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 group">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-green-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Predicción IA</h3>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">Con base en la meta que has establecido y el análisis de tu historial financiero, haz clic para obtener una estimación detallada del ahorro adicional que podrías necesitar para alcanzar tu objetivo de manera efectiva.</p>
                    <form method="POST" action="{{ route('meta.calculoia') }}">
                        @csrf
                        <button class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-md" type="submit">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            Generar Predicción
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="grid lg:grid-cols-2 gap-6">
            <!-- Tabla Resultados -->
            @if (isset($historicoapi) && $historicoapi->count() > 0)
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-4 rounded-t-xl">
                    <h2 class="text-xl font-bold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Historial de Registros
                    </h2>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Fecha</th>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Saldo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($historicoapi->take(5) as $index => $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="py-3 px-4 text-sm text-gray-800">{{ $item->fecha_click }}</td>
                                        <td class="py-3 px-4 text-sm font-medium text-green-600">${{ number_format($item->saldo, 2) }}</td>
                                    </tr>
                                @endforeach
                            
                                @if ($historicoapi->count() > 5)
                                    @foreach ($historicoapi->slice(5) as $index => $item)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200 hidden row-extra">
                                            <td class="py-3 px-4 text-sm text-gray-800">{{ $item->fecha_click }}</td>
                                            <td class="py-3 px-4 text-sm font-medium text-green-600">${{ number_format($item->saldo, 2) }}</td>
                                        </tr>
                                    @endforeach
                            
                                    <!-- Fila con botón -->
                                    <tr>
                                        <td colspan="2" class="text-center py-4">
                                            <button id="toggleRowsBtn" class="text-blue-600 hover:underline font-medium">
                                                Ver más
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Tabla Predicciones -->
            @if (isset($response))
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-4 rounded-t-xl">
                    <h2 class="text-xl font-bold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v6.5a2.5 2.5 0 01-1.5 2.291A2.5 2.5 0 0116 18.5h-8A2.5 2.5 0 017 16a.5.5 0 01.5-.5h.75V14h-2a2 2 0 01-2-2V8a2 2 0 012-2h1zm2.5 0h3V5a1.5 1.5 0 00-3 0v1z" clip-rule="evenodd"/>
                        </svg>
                        Predicciones IA
                    </h2>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Ahorro Diario</th>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Ahorro Mensual</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    @foreach ($response as $item)
                                        <td class="py-3 px-4 text-sm font-medium text-blue-600">${{ $item }}</td>
                                    @endforeach
                                </tr>
                                @if (isset($ahorro))
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="py-3 px-4 text-sm text-gray-800">{{ $ahorro->ejemplo }}</td>
                                        <td class="py-3 px-4"><img src="{{ asset($ahorro->foto) }}" class="h-16 w-auto rounded-lg"></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div id="aboutModalAyuda" class="hidden flex items-center justify-center">
    <div class="modal-content bg-white rounded-xl shadow-2xl max-w-md mx-4">
        <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-6 rounded-t-xl">
            <h2 class="text-2xl font-bold flex items-center">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                </svg>
                Tutorial - Metas
            </h2>
        </div>
        <div class="p-6">
            <div class="space-y-4 text-gray-700">
                <p class="leading-relaxed">
                    Bienvenido a la pantalla de Metas Financieras.
                </p>
                <p class="leading-relaxed"> 
                    Te sugerimos utilizar el generador de ideas para apoyarte en seleccionar un objetivo. O bien, elige tu meta por tu cuenta. Después de seleccionarla, consulta nuestra Inteligencia Artificial para obtener una predicción sobre el ahorro que necesitas considerar para lograr tu meta.
                </p>
                <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                    <p class="text-blue-800 font-medium">💡 ¡No olvides hacer tu registro diario!</p>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button id="closeModalBtnAyuda" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                    Cerrar
                </button>
            </div>
        </div>
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
<script>
    function validarRegistroDiario() {
        const saldoInput = document.getElementById('saldo_diario');
        const fechaInput = document.getElementById('fecha_registro');

        const saldo = parseFloat(saldoInput.value);
        const fecha = fechaInput.value;

        if (isNaN(saldo) || saldo < 0) {
            alert("Por favor, introduce un saldo válido y no negativo.");
            saldoInput.focus();
            return false;
        }

        if (!fecha) {
            alert("Por favor, selecciona una fecha para el registro.");
            fechaInput.focus();
            return false;
        }

        return true;
    }
</script>
<script>
    // Mostrar/Ocultar registros extra
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('toggleRowsBtn');
        if (toggleBtn) {
            let expanded = false;
            toggleBtn.addEventListener('click', () => {
                document.querySelectorAll('.row-extra').forEach(row => {
                    row.classList.toggle('hidden');
                });

                expanded = !expanded;
                toggleBtn.textContent = expanded ? 'Ver menos' : 'Ver más';
            });
        }
    });
</script>
@endsection
