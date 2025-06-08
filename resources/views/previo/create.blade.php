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
            display: none;
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
@endsection

@section('content')
<!-- Header Section with Tutorial Button -->
<div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">ANÁLISIS FINANCIERO</h1>
                <p class="text-blue-100 mt-2">Analiza tu situación económica con inteligencia artificial</p>
            </div>
            <a href="#" id="openModalBtnAyuda" class="tutorial-btn">Tutorial</a>
        </div>
    </div>
</div>

<div class="min-h-screen bg-slate-50">
    <div class="container mx-auto px-4 py-8">
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
    
        <!-- Analysis Form Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8 mb-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Define tu Objetivo</h2>
                <p class="text-gray-600">Establece tu meta financiera para obtener un análisis personalizado</p>
            </div>
    
            <form method="POST" action="{{ $condicion_previo ? route('previo.update', $previo->previo->id) : route('previo.store') }}" class="space-y-6">
                @csrf
                @if ($condicion_previo)
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
                           placeholder="Ej: 75000" 
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
                        Establecer Objetivo
                    </button>
                </div>
            </form>
        </div>
    
        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-6 mb-8">
            <!-- Action Cards Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Registro Diario Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors duration-300">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Registro Diario</h3>
                        </div>
                        <p class="text-gray-600 mb-6 leading-relaxed">Almacena tu historial financiero, registrando tanto el saldo disponible como la fecha exacta en el momento de la operación.</p>
                        <form method="POST" action="{{ route('historicos.store') }}">
                            @csrf
                            <button class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-md" type="submit">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Generar Registro
                            </button>
                        </form>
                    </div>
                </div>
    
                <!-- Predicción Card -->
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
                        <p class="text-gray-600 mb-6 leading-relaxed">Realiza un análisis financiero a través de un objetivo económico seleccionado.</p>
                        <form method="POST" action="{{ route('calculoia') }}">
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
    
            <!-- Current Objective Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-4 rounded-t-xl">
                    <h2 class="text-xl font-bold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Mi Objetivo Actual
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Dinero Objetivo</span>
                            </div>
                            <p class="text-lg font-bold text-green-600">
                                ${{ isset($previoapi) && $previoapi->dinero_previo ? number_format($previoapi->dinero_previo, 2) : 'Sin definir' }}
                            </p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Fecha Objetivo</span>
                            </div>
                            <p class="text-lg font-bold text-blue-600">
                                {{ isset($previoapi) && $previoapi->fecha_meta ? $previoapi->fecha_meta : 'Sin definir' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="grid md:grid-cols-2 gap-6">
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
                                @foreach ($historicoapi as $item) 
                                    <tr class="hover:bg-gray-50 transition-colors duration-200"> 
                                        <td class="py-3 px-4 text-sm text-gray-800">{{ $item->fecha_click }}</td>
                                        <td class="py-3 px-4 text-sm font-medium text-green-600">${{ number_format($item->saldo, 2) }}</td>
                                    </tr> 
                                @endforeach 
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
                                        <td class="py-3 px-4"><img src="{{ $ahorro->foto }}" class="h-16 w-auto rounded-lg"></td>  
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
<div id="aboutModalAyuda" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
    <div class="modal-content bg-white rounded-xl shadow-2xl max-w-md mx-4">
        <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-6 rounded-t-xl">
            <h2 class="text-2xl font-bold flex items-center">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                </svg>
                Tutorial - Análisis Financiero
            </h2>
        </div>
        <div class="p-6">
            <div class="space-y-4 text-gray-700">
                <p class="leading-relaxed">
                    Bienvenido al analizador financiero.
                </p>
                <p class="leading-relaxed">
                    Ingresa una cantidad de dinero y el plazo en el que quieres conseguirlo. Con ayuda de nuestra inteligencia artificial vas a tener una predicción sobre el ahorro extra que necesitas para poder lograr tu objetivo. Además, verás una recomendación sobre lo que representa tu ahorro de manera visual.
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
