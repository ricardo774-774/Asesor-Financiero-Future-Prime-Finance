@extends('layouts.app')

@section('css')
    <style>
        .input-container {
            background-image: linear-gradient(135deg, #1e3c72, #2a5298); /* Gradiente azul oscuro a azul claro */
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: none;
            color: white;
            font-size: 1.25rem;
            text-align: center;
            border-radius: 8px;
            padding: 1rem;
            width: 100%;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .input-field:disabled {
            cursor: not-allowed;
        }

        .select-field {
            background-color: rgba(255, 255, 255, 0.25); /* Fondo más claro para el menú desplegable */
            color: white; /* Texto en blanco */
            border: none;
            font-size: 1.25rem;
            text-align: center;
            border-radius: 8px;
            padding: 1rem;
            width: 100%;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .select-field option {
            background-color: #333; /* Fondo oscuro para opciones */
            color: white; /* Texto en blanco */
        }

        .btn-submit {
            background-color: #6a11cb;
            background-image: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-image: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .balance-input {
            background-color: #38a169; /* Fondo verde */
            color: white;
            font-size: 1.5rem;
            text-align: center;
            border-radius: 8px;
            padding: 0.5rem;
            width: 100%;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background-color: #333;
            color: #f9f9f9;
        }

        .table-row {
            background-color: #fff;
            color: #333;
        }

        .table-row:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
@endsection

@section('content')
<div class="w-full bg-gray-100 p-4 flex justify-between items-center">
    <!-- Botón Ayuda a la izquierda -->
    <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Tutorial</a>  
</div>
    <div class="grid grid-cols-3 gap-8 ml-36 mt-16">
        <div class="flex flex-col">
            <form method="POST" action="{{route('gasto.store') }}" class="input-container">
                @csrf
                
                
                <div class="mb-6">
                    <label for="disabledInputLeft" class="block text-xl font-semibold text-white">Gasto Fijo Actual Por Categoría</label>
                    <input type="hidden" id="disabledInputRight1" class="input-field" name="indicador" value="0" disabled>
                </div>
                <div class="mb-6">
                    <select id="categoria" class="select-field" name="categoriasID" required>
                        <option value="" disabled {{ old('categoriasID') === null ? 'selected' : '' }}>Seleccione la categoría</option>
                        @foreach ($categorias as $item)
                            <option value="{{ $item->id }}" {{ old('categoriasID') == $item->id ? 'selected' : '' }}>{{ $item->Nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label for="enabledInputLeft" class="block text-xl font-semibold text-white">Ingrese nuevo gasto fijo por categoría</label>
                    <input type="number" id="enabledInputLeft" class="input-field" name="monto_fijo" required>
                </div>
                <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md">Enviar</button>
            </form>

            <!-- Tabla de valores por categoría -->
            <div class="mt-6">
                <label class="block text-xl font-semibold text-gray-700 mb-2">Valores por Categoría</label>
                <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-md">
                    <thead class="table-header">
                        <tr>
                            <th class="py-3 px-4 border-b">Categoría</th>
                            <th class="py-3 px-4 border-b">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historial as $item)
                        <tr class="table-row">
                            <td class="py-3 px-4 border-b">{{ $item->categoria->Nombre }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->monto ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col">
            <form method="POST" action="{{route('gasto.store') }}" class="input-container">
                @csrf
                <div class="mb-6">
                    <label for="disabledInputRight1" class="block text-xl font-semibold text-white">Gasto Variable Necesario</label>
                    <input type="text" id="disabledInputRight1" class="input-field" name="gvn" value="{{ $final ?? 0 }}" disabled>
                    <input type="hidden" name="gvn" value="{{ $final ?? 0 }}">
                    <input type="hidden" name="indicador" value="1">
                </div>
                <div class="mb-6">
                    <label for="enabledInputRight1" class="block text-xl font-semibold text-white">Ingrese nuevo gasto variable necesario</label>
                    <input type="number" id="enabledInputRight1" class="input-field" name="gvn2" required>
                </div>
                <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md">Enviar</button>
            </form>
        </div>

        <div class="flex flex-col">
            <form method="POST" action="{{  route('gasto.store') }}" class="input-container">
                @csrf
                
                <div class="mb-6">
                    <label for="disabledInputRight2" class="block text-xl font-semibold text-white">Gasto Variable NO Necesario</label>
                    <input type="text" id="disabledInputRight2" class="input-field" name="gvnn" value="{{ $final2 ?? 0 }}" disabled>
                    <input type="hidden" name="gvnn" value="{{ $final2 ?? 0 }}">
                    <input type="hidden" name="indicador" value="2">
                </div>
                <div class="mb-6">
                    <label for="enabledInputRight2" class="block text-xl font-semibold text-white">Ingrese nuevo gasto variable NO necesario</label>
                    <input type="number" id="enabledInputRight2" class="input-field" name="gvnn2" required >
                </div>
                <button type="submit" class="btn-submit text-white font-bold py-3 px-6 rounded-md">Enviar</button>
            </form>
        </div>
    </div>

    <div class="flex justify-center items-center mt-12">
        <div class="flex flex-col justify-center w-1/3">
            <label for="disabledInputCenter" class="block text-2xl font-semibold text-gray-700 text-center mb-4">BALANCE DE GASTOS</label>
            <input type="text" id="disabledInputCenter" class="balance-input shadow-sm rounded-md" disabled value="{{ $totalSales }}">
        </div>
    </div>

    <!-- Nueva fila para el botón y la tabla de historial -->
    <div class="flex flex-col items-end mt-12 mr-auto pr-40">
        <button onclick="document.getElementById('tabla2Div').classList.toggle('hidden')" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-md shadow-lg transition duration-200 mb-4">Mostrar HISTORIAL</button>
        <div id="tabla2Div" class="w-full hidden">
            <table class="min-w-full bg-white border border-gray-300 text-center shadow-sm rounded-md">
                <thead class="table-header">
                    <tr>
                        <th class="py-3 px-4 border-b">CAMBIO</th>
                        <th class="py-3 px-4 border-b">CANTIDAD</th>
                        <th class="py-3 px-4 border-b">TIPO</th>
                        <th class="py-3 px-4 border-b">FECHA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historial_variableg as $row)
                        <tr class="table-row">
                            <td class="py-3 px-4 border-b">{{ $index_hgv++ }}</td>
                            <td class="py-3 px-4 border-b">{{ $row['monto'] }}</td>
                            <td class="py-3 px-4 border-b">
                                @switch($row['categoriasID'])
                                    @case(7)
                                        Necesario
                                        @break
                                    @case(8)
                                        No Necesario
                                        @break
                                    @default
                                @endswitch
                            </td>
                            <td class="py-3 px-4 border-b fecha-celda whitespace-nowrap">{{ $row['updated_at'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

<!-- Modal -->
<div id="aboutModalAyuda" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-400">
        <h2 class="text-xl font-bold mb-4">Ayuda</h2>
        <p class="mb-4">Bienvenido a la pantalla de Gastos. Como podrás ver, existen tres secciones para dividir tus gastos.
            Por un lado, en el cuadro izquierdo, registra tus gastos mensuales seleccionando en la barra desplegable la categoría, y procede a ingresar el número correspondiente. Recuerda que en esta sección si modificas un gasto, solo se va a actualizar.
            Al centro y a la derecha, tienes dos cuadros para ingresar tus gastos variables. Separa tus gastos en necesario y no necesario, y recuerda que estos dos gastos son cantidades que se van acumulando, no actualizando.
            
            
            
            
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
