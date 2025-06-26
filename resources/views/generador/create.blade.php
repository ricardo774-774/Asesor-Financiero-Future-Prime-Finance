@extends('layouts.app')

@section('css')
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
<style>
    #min {
        min-height: 65vh;
    }

    .main-box {
        border: 1px solid rgba(225, 225, 225, 0.8);
        box-shadow: 0px 0px 10px #ccc;
    }
    
    #image {
        height: auto;
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

<!-- Header Section with Tutorial Button -->
<div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">GENERADOR DE IDEAS</h1>
                <p class="text-blue-100 mt-2">Descubre metas financieras personalizadas para ti</p>
            </div>
            <a href="#" id="openModalBtnAyuda" class="tutorial-btn">Tutorial</a>
        </div>
    </div>
</div>

<div class="min-h-screen bg-slate-50">
    <div id="min" class="container mx-auto px-4 py-8">
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

        <!-- Main Generator Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8 mb-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Generador de Categorías</h2>
                <p class="text-gray-600">Selecciona una categoría para recibir una recomendación personalizada</p>
            </div>

            <div class="max-w-md mx-auto">
                <form method="POST" action="{{ route('generador.sugerencia') }}" class="space-y-6" id="generadorForm">
                    @csrf
                    <div class="space-y-2">
                        <label for="categoria" class="block text-sm font-semibold text-gray-700">
                            <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                            Selecciona una categoría
                        </label>
                        <select id="categoria" 
                                name="categoria" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 bg-white">
                            <option value="" selected disabled>Selecciona una categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex justify-center pt-4">
                        <button class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-8 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg" type="submit">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Generar Sugerencia
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Motivational Section -->
        <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-xl p-8 mb-8 border border-gray-200">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">¿Por qué establecer metas materiales?</h3>
                <p class="text-gray-700 leading-relaxed max-w-4xl mx-auto mb-4">
                    Alcanzar metas materiales puede ser una fuente de satisfacción personal. Es una manera tangible de ver el fruto de tu esfuerzo y dedicación, lo cual puede aumentar tu autoestima y motivación para seguir alcanzando otros objetivos. Además, poseer bienes materiales te da una mayor independencia. No depender de terceros para tu vivienda o transporte te permite tomar decisiones más libres y vivir de acuerdo a tus propias reglas y necesidades.
                </p>
                <div class="inline-flex items-center bg-green-100 text-green-800 px-4 py-2 rounded-full font-medium">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Sigue adelante con confianza y determinación
                </div>
            </div>
        </div>

        <!-- Suggestion Result Section -->
        @if(isset($sugerencia))
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Sugerencia Personalizada</h2>
                    <p class="text-gray-600">Hemos seleccionado esta meta especialmente para ti</p>
                </div>

                <!-- Suggestion Display -->
                <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-6 mb-8 border border-green-200">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <div class="flex items-center mb-3">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">Meta Sugerida</span>
                            </div>
                            <p class="text-xl font-bold text-green-700 mb-4">{{ $sugerencia->titulo }}</p>
                        </div>
                        <div>
                            <div class="flex items-center mb-3">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">Monto Sugerido</span>
                            </div>
                            <p class="text-xl font-bold text-blue-700">${{ number_format($sugerencia->monto, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Goal Setting Form -->
                <form method="POST" action="{{ $meta ? route('meta.update', $meta->id) : route('meta.store') }}" class="space-y-6">
                    @csrf
                    @if ($meta)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="cantidad" class="block text-sm font-semibold text-gray-700">
                                <svg class="w-4 h-4 inline mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                </svg>
                                Ajusta la cantidad (MXN)
                            </label>
                            <input type="number" 
                                   value="{{$sugerencia->monto}}" 
                                   id="cantidad" 
                                   name="cantidad" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   placeholder="Ingrese una cantidad" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="fecha" class="block text-sm font-semibold text-gray-700">
                                <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                Ajusta la fecha objetivo
                            </label>
                            <input type="date" 
                                   value="{{$sugerencia->fecha}}" 
                                   id="fecha" 
                                   name="fecha" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   required>
                        </div>
                    </div>

                    <div class="flex justify-center pt-4">
                        <input type="hidden" value="{{$sugerencia->foto}}" name="foto">
                        <button class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-8 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg" type="submit">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Establecer como Mi Meta
                        </button>
                    </div>
                </form>
            </div>
        @endif
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
                Tutorial - Generador
            </h2>
        </div>
        <div class="p-6">
            <div class="space-y-4 text-gray-700">
                <p class="leading-relaxed">
                    Bienvenido al Generador de Ideas.
                </p>
                <p class="leading-relaxed">
                    Te sugerimos algunas metas populares para empezar a fomentar tu cultura de ahorro. Selecciona una, y en base a tu información financiera, te daremos una sugerencia de una meta para perseguir. Aunque no es obligatorio, creemos que te puede motivar a visualizar los resultados de tu ahorro.
                </p>
                <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                    <p class="text-blue-800 font-medium">💡 Haz clic en el botón de enviar para consultar tu predicción.</p>
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

    // Validación del formulario
    document.getElementById('generadorForm').addEventListener('submit', function(event) {
        const categoriaSelect = document.getElementById('categoria');
        
        // Verificar si no se ha seleccionado una categoría válida
        if (!categoriaSelect.value || categoriaSelect.value === '') {
            event.preventDefault(); // Prevenir el envío del formulario
            return false;
        }
    });
</script>
@endsection

@section('js')
    <!-- Puedes agregar scripts aquí si es necesario -->
@endsection
