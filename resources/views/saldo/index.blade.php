@extends('layouts.app')

@section('css')
    <style>
        .main-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 100px); /* Adjust based on the height of your top menu */
        }

        .balance-container {
            background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
            margin: 0 2rem; /* Space between the pie charts and the balance container */
            flex: 1; /* Allow it to resize */
            max-width: 350px; /* Limit the width of the balance container */
        }

        .balance-input {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: none;
            color: white;
            font-size: 1.75rem;
            text-align: center;
            border-radius: 8px;
            padding: 1rem;
            width: 100%;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .balance-input:disabled {
            cursor: not-allowed;
        }

        .reset-button {
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            margin-top: 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .reset-button:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .chart-container {
            max-width: 250px; /* Adjusted width for the first pie chart */
            margin: 0 2rem; /* Space between pie charts and balance container */
            flex: 1; /* Allow it to resize */
        }

        .chart-canvas {
            width: 100%;
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
            display: none; /* Oculto por defecto */
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
    </style>
@endsection

@section('content')
<div class="w-full bg-gray-100 p-4 flex justify-between items-center">
    <!-- Botón Ayuda a la izquierda -->
    <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Tutorial</a>  
    <a href="{{ route('descargar-registros') }}" class="btn btn-primary">Descargar Registros en PDF</a>
    <div>
        <button id="printButton">Imprimir Saldo</button>
        <script>
            document.getElementById('printButton').addEventListener('click', function() {
                window.print();
            });
        </script>
    </div>
</div>

<div id="min" class="main-container">
    <!-- First Pie Chart -->
    <div class="chart-container">
        <canvas id="pieChart1" class="chart-canvas"></canvas>
    </div>

    <!-- Balance Container -->
    <div class="balance-container text-center">
        <label for="saldo" class="block mb-4 text-3xl font-extrabold tracking-tight">Mi Saldo Actual</label>
        <input type="text" id="saldo" name="saldo" value="{{ $operacionfinal }}" class="balance-input" disabled>
        <p class="mt-4 text-lg font-medium">Este es tu saldo disponible basado en las últimas operaciones.</p>
        <form action="{{ route('saldo.reset') }}" method="POST">
            @csrf
            <button type="submit" class="reset-button">Resetear INGRESOS Y GASTOS</button>
        </form>
        <form action="{{ route('saldo.clear') }}" method="POST">
            @csrf
            <button type="submit" class="reset-button">Resetear SALDO</button>
        </form>
    </div>

    <!-- Second Pie Chart -->
    <div class="chart-container">
        <canvas id="pieChart2" class="chart-canvas"></canvas>
    </div>
</div>

    <!-- Modal -->
    <div id="aboutModalAyuda" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg m-8">
            <h2 class="text-xl font-bold mb-4">Saldo</h2>
            <p class="mb-4 text-justify"> 
                Bienvenido a la pantalla de Saldo, donde puedes visualizar tu información financiera de una manera clara. 
            </p>
            <p class="mb-4 text-justify">
                A los lados del recuadro central, están tus ingresos y tus gastos, 
                divididos en una gráfica de pastel para que puedas ver tu información en forma de porcentaje. 
                Al centro de la pantalla, está tu saldo actual.
                Debajo de dicho dato, están dos botones, en caso de que necesites reiniciar tu información. 
                El primer botón reinicia solo tus gastos y tus ingresos, y el segundo botón reinicia tu saldo, 
                en caso de que quieras empezar desde cero.
            </p>
            <button id="closeModalBtnAyuda" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
        </div>
    </div>

@endsection

@section('js')
    <!-- Include Chart.js from CDN -->
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // First Pie Chart Data and Configuration
            var ctx1 = document.getElementById('pieChart1').getContext('2d');
            @php
            $ingreso_fijo = 0;
            $ingreso_variable = 0;
            if ($ingreso) {
                $suma = $ingreso->ingreso_fijo + $ingreso->ingreso_variable;
                if ($suma > 0) {
                    $ingreso_fijo = $ingreso->ingreso_fijo * 100 / $suma;
                    $ingreso_variable = $ingreso->ingreso_variable * 100 / $suma;
                }
            }
            @endphp
            var pieChart1 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ['Ingreso Fijo', 'Ingreso Variable'],
                    datasets: [{
                        data: [{{$ingreso_fijo}}, {{$ingreso_variable}}],
                        backgroundColor: ['#FF6384', '#36A2EB']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.toFixed(2) + '%';
                                }
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    }
                }
            });

            // Second Pie Chart Data and Configuration
            var ctx2 = document.getElementById('pieChart2').getContext('2d');
            var labels = [];
            var data = [];
            @foreach ($historial as $gasto)
                labels.push('{{$gasto->categoria->Nombre}}');
                data.push('{{$gasto->percentage}}');
            @endforeach
            var pieChart2 = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#FE9900', '#060270', '#CC6CE7', '#D20103']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.toFixed(2) + '%';
                                }
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    }
                }
            });
        });
    </script>
@endsection
