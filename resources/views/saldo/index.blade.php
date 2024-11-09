@extends('layouts.app')

@section('css')
    <style>
        .main-container {
            min-height: 80vh;
        }
        .balance-input:disabled {
            cursor: not-allowed;
        }
        .reset-button {
            transition: background-color 0.3s ease;
        } 
        .reset-button:hover {
            background-color: rgba(255, 255, 255, 0.5);
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

        #first-chart, #second-chart {
            height: auto;
            width: auto;
        }
    </style>
@endsection

@section('content')
    @php
        // Calcular los datos de los gráficos
        $ingreso_fijo = 0;
        $ingreso_variable = 0;
        if ($ingreso) {
            $suma = $ingreso->ingreso_fijo + $ingreso->ingreso_variable;
            if ($suma > 0) {
                $ingreso_fijo = $ingreso->ingreso_fijo * 100 / $suma;
                $ingreso_variable = $ingreso->ingreso_variable * 100 / $suma;
            }
        }
        $labels = [];
        $data = [];
        foreach ($historial as $gasto) {
            $labels[] = $gasto->categoria->Nombre;
            $data[] = $gasto->percentage;
        }
    @endphp

    <div class="main-container min-w-screen">
        <div class="w-full bg-gray-100 p-4 flex flex-col md:flex-row justify-between items-start md:items-center">
            <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded mb-4 md:mb-0">Tutorial</a>  
            <a href="{{ route('descargar-registros') }}" class="btn btn-primary mb-4 md:mb-0 text-center self-center">Descargar Registros en PDF</a>
            <button id="printButton" class="btn btn-secondary text-center self-center">Imprimir Saldo</button>
            <script>
                document.getElementById('printButton').addEventListener('click', function() {
                    window.print();
                });
            </script>
        </div>
    
        <div id="min" class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-4 p-4 md:mr-8">
            <div id="first-chart" class="chart-container max-w-xs w-full">
                <canvas id="pieChart1" class="chart-canvas"></canvas>
            </div>
    
            <div class="balance-container text-center p-6 rounded-lg shadow-lg w-full max-w-xs bg-gradient-to-r from-blue-500 to-purple-500">
                <label for="saldo" class="block mb-4 text-2xl font-extrabold tracking-tight text-white">Mi Saldo Actual</label>
                <input type="text" id="saldo" name="saldo" value="{{ $operacionfinal }}" class="bg-white bg-opacity-30 text-white font-bold text-2xl p-4 rounded-lg w-full mb-4 text-white text-center" disabled>
                <p class="text-white font-medium">Este es tu saldo disponible basado en las últimas operaciones.</p>
                <form action="{{ route('saldo.reset') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="reset-button bg-white bg-opacity-30 text-white font-bold py-2 px-4 rounded-lg w-full mt-2">Resetear INGRESOS Y GASTOS</button>
                </form>
                <form action="{{ route('saldo.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="reset-button bg-white bg-opacity-30 text-white font-bold py-2 px-4 rounded-lg w-full mt-2">Resetear SALDO</button>
                </form>
            </div>
    
            <div id="second-chart" class="chart-container max-w-xs w-full">
                <canvas id="pieChart2" class="chart-canvas"></canvas>
            </div>
        </div>
    
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
    </div>
@endsection

@section('js')
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx1 = document.getElementById('pieChart1').getContext('2d');
            var ingresoFijo = {{ $ingreso_fijo }};
            var ingresoVariable = {{ $ingreso_variable }};

            if (ingresoFijo > 0 || ingresoVariable > 0) {
                var pieChart1 = new Chart(ctx1, {
                    type: 'pie',
                    data: {
                        labels: ['Ingreso Fijo', 'Ingreso Variable'],
                        datasets: [{
                            data: [ingresoFijo, ingresoVariable],
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
            } else {
                document.getElementById('first-chart').style.display = 'none';
            }

            var ctx2 = document.getElementById('pieChart2').getContext('2d');
            var labels = @json($labels);
            var data = @json($data);

            if (data.length > 0 && data.some(val => val > 0)) {
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
            } else {
                document.getElementById('second-chart').style.display = 'none';
            }
        });
    </script>
@endsection
