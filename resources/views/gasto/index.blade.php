@extends('layouts.app')

@section('css')
    <style>
        .input-container {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(30, 64, 175, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        .input-field {
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
            appearance: none;
        }
        .input-field:disabled {
            cursor: not-allowed;
        }
        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .select-field {
            background-color: rgba(255, 255, 255, 0.25);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 1.25rem;
            text-align: center;
            border-radius: 8px;
            padding: 1rem;
            width: 100%;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
            appearance: none;
        }
        .select-field option {
            background-color: #1e40af;
            color: white;
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
        .balance-input {
            background-color: #059669;
            color: white;
            font-size: 1.5rem;
            text-align: center;
            border-radius: 8px;
            padding: 0.75rem;
            width: 100%;
            box-shadow: 0 4px 8px rgba(5, 150, 105, 0.2);
            border: 1px solid #10b981;
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
                    <h1 class="text-3xl font-bold">MIS GASTOS</h1>
                    <p class="text-blue-100 mt-2">Controla y categoriza tus gastos financieros</p>
                </div>
                <a href="#" id="openModalBtnAyuda" class="tutorial-btn">Tutorial</a>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-slate-50">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Gestión de Gastos</h2>
                <p class="text-gray-600">Registra y categoriza todos tus gastos por tipo</p>
            </div>

            <!-- Expense Forms Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                
                <!-- Fixed Expenses by Category -->
                <div class="input-container">
                    <div class="mb-6 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white bg-opacity-20 rounded-full mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Gastos Fijos</h3>
                        <p class="text-blue-100 text-sm">Por categoría mensual</p>
                    </div>
                    
                    <form method="POST" action="{{route('gasto.store') }}">
                        @csrf
                        <div class="mb-6">
                            <input type="hidden" id="disabledInputRight1" class="input-field" name="indicador" value="0" disabled>
                        </div>
                        <div class="mb-6">
                            <label for="categoria" class="block text-lg font-semibold text-white mb-2">Selecciona categoría</label>
                            <select id="categoria" class="select-field" name="categoriasID" required>
                                <option value="" disabled {{ old('categoriasID') === null ? 'selected' : '' }}>Seleccione la categoría</option>
                                @foreach ($categorias as $item)
                                    <option value="{{ $item->id }}" {{ old('categoriasID') == $item->id ? 'selected' : '' }}>{{ $item->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="enabledInputLeft" class="block text-lg font-semibold text-white">Nuevo gasto fijo por categoría</label>
                            <input type="number" id="enabledInputLeft" class="input-field mt-2" name="monto_fijo" placeholder="Ej: 2500" required>
                        </div>
                        <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md w-full">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Actualizar Gasto Fijo
                        </button>
                    </form>
                </div>

                <!-- Necessary Variable Expenses -->
                <div class="input-container">
                    <div class="mb-6 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white bg-opacity-20 rounded-full mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Gastos Variables</h3>
                        <p class="text-blue-100 text-sm">Necesarios (acumulativo)</p>
                    </div>
                    
                    <form method="POST" action="{{route('gasto.store') }}">
                        @csrf
                        <div class="mb-6">
                            <label for="disabledInputRight1" class="block text-lg font-semibold text-white">GASTO VARIABLE NECESARIO ACTUAL</label>
                            <input type="text" id="disabledInputRight1" class="input-field mt-2" name="gvn" value="${{ number_format($final ?? 0, 2) }}" disabled>
                            <input type="hidden" name="gvn" value="{{ $final ?? 0 }}">
                            <input type="hidden" name="indicador" value="1">
                        </div>
                        <div class="mb-6">
                            <label for="enabledInputRight1" class="block text-lg font-semibold text-white">Agregar gasto variable necesario</label>
                            <input type="number" id="enabledInputRight1" class="input-field mt-2" name="gvn2" placeholder="Ej: 500" required>
                        </div>
                        <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md w-full">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Agregar Gasto Necesario
                        </button>
                    </form>
                </div>

                <!-- Non-necessary Variable Expenses -->
                <div class="input-container">
                    <div class="mb-6 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white bg-opacity-20 rounded-full mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Gastos Variables</h3>
                        <p class="text-blue-100 text-sm">No necesarios (acumulativo)</p>
                    </div>
                    
                    <form method="POST" action="{{ route('gasto.store') }}">
                        @csrf
                        <div class="mb-6">
                            <label for="disabledInputRight2" class="block text-lg font-semibold text-white">GASTO VARIABLE NO NECESARIO ACTUAL</label>
                            <input type="text" id="disabledInputRight2" class="input-field mt-2" name="gvnn" value="${{ number_format($final2 ?? 0, 2) }}" disabled>
                            <input type="hidden" name="gvnn" value="{{ $final2 ?? 0 }}">
                            <input type="hidden" name="indicador" value="2">
                        </div>
                        <div class="mb-6">
                            <label for="enabledInputRight2" class="block text-lg font-semibold text-white">Agregar gasto variable NO necesario</label>
                            <input type="number" id="enabledInputRight2" class="input-field mt-2" name="gvnn2" placeholder="Ej: 200" required>
                        </div>
                        <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md w-full">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Agregar Gasto No Necesario
                        </button>
                    </form>
                </div>
            </div>

            <!-- Categories Table Section -->
            <div class="grid lg:grid-cols-2 gap-8 mb-8">
                <!-- Categories Values Table -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                    <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-4 rounded-t-xl">
                        <h3 class="text-xl font-bold flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Valores por Categoría
                        </h3>
                    </div>
                    <div class="p-4">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Categoría</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Monto</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($historial as $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="py-3 px-4 text-sm text-gray-800">{{ $item->categoria->Nombre }}</td>
                                        <td class="py-3 px-4 text-sm font-medium text-red-600">${{ number_format($item->monto ?? 0, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Balance Section -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">BALANCE TOTAL DE GASTOS</h3>
                        <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg p-6">
                            <p class="text-lg font-medium mb-2">Total de Gastos</p>
                            <p class="text-3xl font-bold">${{ number_format($totalSales ?? 0, 2) }}</p>
                            <p class="text-red-100 text-sm mt-2">Todos los gastos combinados</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Section -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-4 rounded-t-xl">
                    <h3 class="text-xl font-bold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Historial de Gastos Variables
                    </h3>
                </div>
                <div class="p-4">
                    <button id="" onclick="document.getElementById('tabla2Div').classList.toggle('hidden')" class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 px-6 rounded-md shadow-lg transition duration-300 mb-4 w-full md:w-auto">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Mostrar/Ocultar Historial
                    </button>
                    <div id="tabla2Div" class="w-full hidden overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Cambio</th>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Cantidad</th>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Tipo</th>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($historial_variableg as $row)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="py-3 px-4 text-sm text-gray-800">{{ $index_hgv++ }}</td>
                                        <td class="py-3 px-4 text-sm font-medium text-red-600">${{ number_format($row['monto'], 2) }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-600">
                                            @switch($row['categoriasID'])
                                                @case(7)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Necesario</span>
                                                    @break
                                                @case(8)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">No Necesario</span>
                                                    @break
                                                @default
                                            @endswitch
                                        </td>
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

    <!-- Modal -->
    <div id="aboutModalAyuda" class="hidden flex items-center justify-center">
        <div class="modal-content bg-white rounded-xl shadow-2xl max-w-md mx-4">
            <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-6 rounded-t-xl">
                <h2 class="text-2xl font-bold flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                    Tutorial - Gastos
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4 text-gray-700">
                    <p class="leading-relaxed">
                        Bienvenido a la pantalla de Gastos.
                    </p>
                    <p class="leading-relaxed">
                        Como podrás ver, existen tres secciones para dividir tus gastos. Por un lado, en el cuadro izquierdo, registra tus gastos mensuales seleccionando en la barra desplegable la categoría, y procede a ingresar el número correspondiente. Recuerda que en esta sección si modificas un gasto, solo se va a actualizar. Al centro y a la derecha, tienes dos cuadros para ingresar tus gastos variables. Separa tus gastos en necesario y no necesario, y recuerda que estos dos gastos son cantidades que se van acumulando, no actualizando.
                    </p>
                    <div class="bg-red-50 p-4 rounded-lg border-l-4 border-red-400">
                        <p class="text-red-800 font-medium">💡 Utiliza las categorías para organizar mejor tus gastos fijos mensuales.</p>
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
    const openModalBtnAyuda = document.getElementById('openModalBtnAyuda');
    const closeModalBtnAyuda = document.getElementById('closeModalBtnAyuda');
    const aboutModalAyuda = document.getElementById('aboutModalAyuda');

    openModalBtnAyuda.addEventListener('click', function(event) {
        event.preventDefault();
        aboutModalAyuda.style.display = 'flex';
    });

    closeModalBtnAyuda.addEventListener('click', function() {
        aboutModalAyuda.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === aboutModalAyuda) {
            aboutModalAyuda.style.display = 'none';
        }
    });

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
        document.addEventListener('DOMContentLoaded', function () {
            var selectCategoria = document.getElementById('categoria');

            selectCategoria.addEventListener('change', function () {
                var categoriaID = this.value;

                // Obtener el token CSRF
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Realizar la petición AJAX
                fetch('/ruta-ajax', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ categoriasID: categoriaID })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    // Aquí puedes manejar la respuesta del servidor
                    if (data.gastoFijo !== undefined) {
                        document.getElementById('disabledInputLeft').value = data.gastoFijo;
                    }
                    // Actualizar el balance de gastos en la vista
                    document.getElementById('disabledInputCenter').value = `Gasto fijo para categoría ${data.categoriasID}: ${data.gastoFijo}`;
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            });
        });
    </script>
@endsection