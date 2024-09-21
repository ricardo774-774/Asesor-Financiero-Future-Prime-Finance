@extends('layouts.app')

@section('css')
<style>
    .fecha-celda {
        width: 200px;
        white-space: nowrap;
    }

    .form-container {
        background: linear-gradient(135deg, #1f4037, #99f2c8); /* Contraste verde oscuro a verde claro */
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .form-input {
        background-color: rgba(255, 255, 255, 0.2); /* Mayor contraste en fondo de input */
        backdrop-filter: blur(10px);
        border: none;
        color: #f9f9f9; /* Texto más claro */
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

    .balance-input {
        background-color: #38a169; /* Verde para el valor del saldo */
        color: white;
        font-size: 1.5rem;
        text-align: center;
        border-radius: 8px;
        padding: 0.5rem;
        width: 50%; /* Más pequeño */
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn-submit {
        background-color: #ff416c;
        background-image: linear-gradient(135deg, #ff4b2b, #ff416c); /* Gradiente rojo a rosa oscuro */
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background-image: linear-gradient(135deg, #ff416c, #ff4b2b); /* Inversión del gradiente */
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .table-header {
        background-color: #333; /* Fondo oscuro para encabezado de tabla */
        color: #f9f9f9; /* Texto claro */
    }

    .table-row {
        background-color: #fff; /* Fondo blanco para filas */
        color: #333; /* Texto oscuro */
    }

    .table-row:nth-child(even) {
        background-color: #f2f2f2; /* Alternar colores de filas */
    }
</style>
@endsection

@section('content')
<div class="w-full bg-gray-100 p-4 flex justify-between items-center">
    <!-- Botón Ayuda a la izquierda -->
    <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Tutorial</a>  
</div>
<div class="grid grid-cols-2 gap-2 justify-center items-center ml-auto mr-auto mt-16 w-full max-w-6xl px-6">
    
    <div class="form-container">
        <form method="POST" action="{{ $condicion ? route('ingreso.update', $ingreso->ingreso->id) : route('ingreso.store') }}">
            @csrf
            @if ($condicion)
                @method('PUT')
            @else
                @method('POST')
            @endif
            <div class="mb-6">
                <label for="disabledInputLeft" class="block text-lg font-semibold">INGRESO FIJO ACTUAL</label>
                <input type="text" id="disabledInputLeft" class="form-input mt-2" value="{{ $ingreso->ingreso->ingreso_fijo ?? 0 }}" disabled name="ingreso_fijo">
            </div>
            <div class="mb-6">
                <label for="enabledInputLeft" class="block text-lg font-semibold">Ingresa tu ingreso fijo mensual</label>
                <input type="number" id="enabledInputLeft" class="form-input mt-2" name="ingreso_fijo" required>
                <input type="hidden" value="0" name="tipo_ingreso">
            </div>
            <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md shadow-lg">Enviar</button>
        </form>
    </div>
    <div class="form-container">
        <form method="POST" action="{{ $condicion ? route('ingreso.update', $ingreso->ingreso->id) : route('ingreso.store') }}">
            @csrf
            @if ($condicion)
                @method('PUT')
            @else
                @method('POST')
            @endif
            <div class="mb-6">
                <label for="disabledInputRight" class="block text-lg font-semibold">INGRESOS VARIABLES</label>
                <input type="text" id="disabledInputRight" class="form-input mt-2" disabled value="{{ $ingreso->ingreso->ingreso_variable ?? 0 }}" name="ingreso_variable">
                <input type="hidden" value="{{ $ingreso->ingreso->ingreso_fijo ?? 0 }}" name="ingreso_fijo">
                <input type="hidden" value="1" name="tipo_ingreso">
            </div>
            <div class="mb-6">
                <label for="enabledInputRight" class="block text-lg font-semibold">Ingresa tu ingreso variable</label>
                <input type="number" id="enabledInputRight" class="form-input mt-2" name="ingreso_variable" required>
            </div>
            <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md shadow-lg">Enviar</button>
        </form>
    </div>
</div>

<div class="mt-20 flex justify-center items-center flex-col w-full">
    <label for="disabledInputCenter" class="block text-xl font-semibold text-gray-800 mb-4">BALANCE DE INGRESOS</label>
    <input type="text" id="disabledInputCenter" class="balance-input" value="{{ isset($ingreso->ingreso) ? $ingreso->ingreso->ingreso_fijo + $ingreso->ingreso->ingreso_variable : 0 }}" disabled name="ingreso_fijo">
</div>

<div class="flex justify-between mt-16 w-full px-36">
    <div class="flex flex-col items-start">
        <button onclick="toggleTable('tabla1Div')" class="btn-submit text-white font-bold py-3 px-6 rounded-md shadow-lg mb-4 ml-16">Mostrar HISTORIAL</button>
        <div id="tabla1Div" class="w-full hidden">
            <table class="min-w-full bg-white text-center shadow-lg rounded-md">
                <thead class="table-header">
                    <tr>
                        <th class="py-3">CAMBIO</th>
                        <th class="py-3">CANTIDAD</th>
                        <th class="py-3">FECHA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historial_fijo as $row)
                    <tr class="table-row">
                        <td class="py-3">{{ $index_hif++ }}</td>
                        <td class="py-3">{{ $row['ingreso_fijo'] }}</td>
                        <td class="py-3 fecha-celda">{{ $row['updated_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="flex flex-col items-end">
        <button onclick="toggleTable('tabla2Div')" class="btn-submit text-white font-bold py-3 px-6 rounded-md shadow-lg mb-4 mr-16">Mostrar HISTORIAL</button>
        <div id="tabla2Div" class="w-full hidden">
            <table class="min-w-full bg-white text-center shadow-lg rounded-md">
                <thead class="table-header">
                    <tr>
                        <th class="py-3">CAMBIO</th>
                        <th class="py-3">CANTIDAD</th>
                        <th class="py-3">FECHA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historial_variable as $row)
                    <tr class="table-row">
                        <td class="py-3">{{ $index_hiv++ }}</td>
                        <td class="py-3">{{ $row['ingreso_variable'] }}</td>
                        <td class="py-3 fecha-celda">{{ $row['updated_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="aboutModalAyuda" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-400">
        <h2 class="text-xl font-bold mb-4">Ayuda</h2>
        <p class="mb-4">Bienvenido a la pantalla de Ingresos, en la presente sección, podrás fijar dos datos vitales de tu economía personal: tus ingresos fijos y tus ingresos variables.
            Tu ingreso fijo consiste en la cantidad de dinero que percibes de manera regular, mensualmente. Si llegas a hacer cambios, recuerda que solo se actualizan.
            Por otro lado, puedes ingresar tus ingresos variables de manera acumulativa. Cada vez que tengas una entrada de dinero que no sea fija, haz registro de ella.
            Al centro de la pantalla por debajo de ambos cuadros, podrás ver el balance de tus ingresos y debajo del mismo dos botones para consultar tu historial: la lista de cambios que ha habido.
            
            
            
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
<script>
    function toggleTable(tableId) {
        document.getElementById(tableId).classList.toggle('hidden');
    }
</script>
@endsection
