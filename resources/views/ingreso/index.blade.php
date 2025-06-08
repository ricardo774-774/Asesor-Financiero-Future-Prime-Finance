@extends('layouts.app')

@section('css')
<style>
    .fecha-celda {
        width: 200px;
        white-space: nowrap;
    }

    .form-container {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(30, 64, 175, 0.2);
        border: 1px solid rgba(59, 130, 246, 0.3);
        color: white;
    }

    .form-input {
        background-color: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        font-size: 1.25rem;
        text-align: center;
        border-radius: 8px;
        padding: 1rem;
        width: 100%;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-input:disabled {
        cursor: not-allowed;
    }

    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .balance-input {
        background-color: #059669;
        color: white;
        font-size: 1.5rem;
        text-align: center;
        border-radius: 8px;
        padding: 0.75rem;
        width: 50%;
        box-shadow: 0 4px 8px rgba(5, 150, 105, 0.2);
        border: 1px solid #10b981;
    }

    .btn-submit {
        background: linear-gradient(135deg, #1e40af 0%, #059669 100%);
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 64, 175, 0.3);
    }

    .table-header {
        background-color: #1e40af;
        color: #ffffff;
    }

    .table-row {
        background-color: #ffffff;
        color: #374151;
    }

    .table-row:nth-child(even) {
        background-color: #f8fafc;
    }

    .table-row:hover {
        background-color: #eff6ff;
        transition: background-color 0.2s ease;
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

    /* Responsividad */
    @media (max-width: 768px) {
        .grid-cols-2 {
            grid-template-columns: 1fr;
        }
        .balance-input {
            width: 100%;
        }
        .px-36 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }

    #aboutModalAyuda {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: #ffffff;
        padding: 20px;
        max-width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        border: 1px solid #e2e8f0;
    }
</style>
@endsection

@section('content')
    <!-- Header Section with Tutorial Button -->
    <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">MIS INGRESOS</h1>
                    <p class="text-blue-100 mt-2">Administra tus ingresos fijos y variables</p>
                </div>
                <a href="#" id="openModalBtnAyuda" class="tutorial-btn">Tutorial</a>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-slate-50">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Gestión de Ingresos</h2>
                <p class="text-gray-600">Registra y actualiza tus fuentes de ingresos</p>
            </div>

            <!-- Income Forms Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                
                <!-- Fixed Income Form -->
                <div class="form-container">
                    <div class="mb-6 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white bg-opacity-20 rounded-full mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Ingresos Fijos</h3>
                        <p class="text-blue-100 text-sm">Ingresos regulares mensuales</p>
                    </div>
                    
                    <form method="POST" action="{{ $condicion ? route('ingreso.update', $ingreso->ingreso->id) : route('ingreso.store') }}">
                        @csrf
                        @if ($condicion)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        <div class="mb-6">
                            <label for="disabledInputLeft" class="block text-lg font-semibold">INGRESO FIJO ACTUAL</label>
                            <input type="text" id="disabledInputLeft" class="form-input mt-2" value="${{ number_format($ingreso->ingreso->ingreso_fijo ?? 0, 2) }}" disabled name="ingreso_fijo">
                        </div>
                        <div class="mb-6">
                            <label for="enabledInputLeft" class="block text-lg font-semibold">Nuevo ingreso fijo mensual</label>
                            <input type="number" id="enabledInputLeft" class="form-input mt-2" name="ingreso_fijo" placeholder="Ej: 15000" required>
                            <input type="hidden" value="0" name="tipo_ingreso">
                        </div>
                        <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md shadow-lg w-full">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Actualizar Ingreso Fijo
                        </button>
                    </form>
                </div>

                <!-- Variable Income Form -->
                <div class="form-container">
                    <div class="mb-6 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white bg-opacity-20 rounded-full mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Ingresos Variables</h3>
                        <p class="text-blue-100 text-sm">Ingresos adicionales acumulativos</p>
                    </div>
                    
                    <form method="POST" action="{{ $condicion ? route('ingreso.update', $ingreso->ingreso->id) : route('ingreso.store') }}">
                        @csrf
                        @if ($condicion)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        <div class="mb-6">
                            <label for="disabledInputRight" class="block text-lg font-semibold">INGRESOS VARIABLES ACUMULADOS</label>
                            <input type="text" id="disabledInputRight" class="form-input mt-2" disabled value="${{ number_format($ingreso->ingreso->ingreso_variable ?? 0, 2) }}" name="ingreso_variable">
                            <input type="hidden" value="{{ $ingreso->ingreso->ingreso_fijo ?? 0 }}" name="ingreso_fijo">
                            <input type="hidden" value="1" name="tipo_ingreso">
                        </div>
                        <div class="mb-6">
                            <label for="enabledInputRight" class="block text-lg font-semibold">Agregar ingreso variable</label>
                            <input type="number" id="enabledInputRight" class="form-input mt-2" name="ingreso_variable" placeholder="Ej: 3000" required>
                        </div>
                        <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md shadow-lg w-full">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Agregar Ingreso Variable
                        </button>
                    </form>
                </div>
            </div>

            <!-- Balance Section -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8 mb-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">BALANCE TOTAL DE INGRESOS</h3>
                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg p-6 max-w-md mx-auto">
                        <p class="text-lg font-medium mb-2">Total Disponible</p>
                        <p class="text-3xl font-bold">${{ number_format((isset($ingreso->ingreso) ? $ingreso->ingreso->ingreso_fijo + $ingreso->ingreso->ingreso_variable : 0), 2) }}</p>
                        <p class="text-green-100 text-sm mt-2">Ingresos fijos + variables</p>
                    </div>
                </div>
            </div>

            <!-- History Tables Section -->
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Fixed Income History -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                    <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-4 rounded-t-xl">
                        <h3 class="text-xl font-bold flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Historial Ingresos Fijos
                        </h3>
                    </div>
                    <div class="p-4">
                        <button onclick="toggleTable('tabla1Div')" class="btn-submit text-white font-bold py-2 px-4 rounded-md shadow-lg mb-4 w-full">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Mostrar/Ocultar Historial
                        </button>
                        <div id="tabla1Div" class="w-full hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Cambio</th>
                                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Cantidad</th>
                                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($historial_fijo as $row)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="py-3 px-4 text-sm text-gray-800">{{ $index_hif++ }}</td>
                                            <td class="py-3 px-4 text-sm font-medium text-green-600">${{ number_format($row['ingreso_fijo'], 2) }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-600">{{ $row['updated_at'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Variable Income History -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-4 rounded-t-xl">
                        <h3 class="text-xl font-bold flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Historial Ingresos Variables
                        </h3>
                    </div>
                    <div class="p-4">
                        <button onclick="toggleTable('tabla2Div')" class="btn-submit text-white font-bold py-2 px-4 rounded-md shadow-lg mb-4 w-full">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Mostrar/Ocultar Historial
                        </button>
                        <div id="tabla2Div" class="w-full hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Cambio</th>
                                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Cantidad</th>
                                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($historial_variable as $row)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="py-3 px-4 text-sm text-gray-800">{{ $index_hiv++ }}</td>
                                            <td class="py-3 px-4 text-sm font-medium text-green-600">${{ number_format($row['ingreso_variable'], 2) }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-600">{{ $row['updated_at'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                    Tutorial - Ingresos
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4 text-gray-700">
                    <p class="leading-relaxed">
                        Bienvenido a la pantalla de Ingresos.
                    </p>
                    <p class="leading-relaxed"> 
                        En la presente sección, podrás fijar dos datos vitales de tu economía personal: tus ingresos fijos y tus ingresos variables. Tu ingreso fijo consiste en la cantidad de dinero que percibes de manera regular, mensualmente. Si llegas a hacer cambios, recuerda que solo se actualizan. Por otro lado, puedes ingresar tus ingresos variables de manera acumulativa. Cada vez que tengas una entrada de dinero que no sea fija, haz registro de ella.
                    </p>
                    <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                        <p class="text-blue-800 font-medium">💡 Al centro de la pantalla podrás ver el balance de tus ingresos y los historiales de cambios.</p>
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

<script>
    function toggleTable(tableId) {
        document.getElementById(tableId).classList.toggle('hidden');
    }
</script>
@endsection
