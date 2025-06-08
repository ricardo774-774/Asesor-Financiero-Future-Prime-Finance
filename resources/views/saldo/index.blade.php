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

        .action-btn {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(5, 150, 105, 0.3);
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(5, 150, 105, 0.4);
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
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

        #first-chart, #second-chart {
            height: auto;
            width: auto;
        }

        /* Print Styles - Matching PDF color palette */
        @media print {
            @page {
                margin: 30px;
                size: A4;
            }

            body {
                font-family: 'DejaVu Sans', Arial, sans-serif !important;
                color: #1e293b !important;
                background-color: #f8fafc !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Hide non-printable elements */
            .no-print,
            nav,
            .tutorial-btn,
            .action-btn,
            button,
            .reset-button,
            #aboutModalAyuda {
                display: none !important;
            }

            /* Print header with PDF styling */
            .print-header {
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%) !important;
                color: white !important;
                padding: 20px !important;
                border-radius: 8px !important;
                text-align: center !important;
                margin-bottom: 30px !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .print-header h1 {
                margin: 0 !important;
                font-size: 28px !important;
                font-weight: bold !important;
            }

            .print-header p {
                margin: 8px 0 0 !important;
                font-size: 14px !important;
                opacity: 0.9 !important;
            }

            /* Chart containers for print */
            .print-chart-container {
                background-color: white !important;
                border: 2px solid #e2e8f0 !important;
                border-radius: 12px !important;
                padding: 20px !important;
                margin-bottom: 20px !important;
                box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1) !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .print-chart-title {
                color: #1e40af !important;
                font-size: 18px !important;
                font-weight: bold !important;
                margin-bottom: 15px !important;
                text-align: center !important;
                border-bottom: 2px solid #3b82f6 !important;
                padding-bottom: 10px !important;
            }

            /* Balance section for print */
            .print-balance-container {
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%) !important;
                color: white !important;
                padding: 30px !important;
                border-radius: 12px !important;
                text-align: center !important;
                margin: 20px 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .print-balance-title {
                font-size: 24px !important;
                font-weight: bold !important;
                margin-bottom: 15px !important;
            }

            .print-balance-amount {
                font-size: 36px !important;
                font-weight: bold !important;
                margin: 10px 0 !important;
            }

            .print-balance-description {
                font-size: 14px !important;
                opacity: 0.9 !important;
            }

            /* Print footer */
            .print-footer {
                margin-top: 40px !important;
                text-align: center !important;
                font-size: 12px !important;
                color: #64748b !important;
                border-top: 1px solid #e2e8f0 !important;
                padding-top: 20px !important;
            }

            /* Grid layout for print */
            .print-grid {
                display: grid !important;
                grid-template-columns: 1fr 1fr !important;
                gap: 20px !important;
                margin: 20px 0 !important;
            }

            /* Hide charts canvas for print, show print version */
            canvas {
                display: none !important;
            }

            .print-chart-placeholder {
                display: block !important;
                background-color: #f1f5f9 !important;
                border: 2px dashed #3b82f6 !important;
                border-radius: 8px !important;
                padding: 40px !important;
                text-align: center !important;
                color: #1e40af !important;
                font-weight: bold !important;
            }

            /* Ensure colors are preserved */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        /* Print chart placeholders (hidden by default) */
        .print-chart-placeholder {
            display: none;
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

    <!-- Print Header (Only visible when printing) -->
    <div class="print-header" style="display: none;">
        <h1>REPORTE DE SALDO FINANCIERO</h1>
        <p>Generado automáticamente por Finanzas Pro - Tu Asesor Financiero Personal</p>
        <p>Fecha: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Header Section with Action Buttons -->
    <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white no-print">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold">MI SALDO</h1>
                    <p class="text-blue-100 mt-2">Visualiza tu situación financiera actual</p>
                </div>
                <div class="flex flex-col md:flex-row gap-3">
                    <a href="#" id="openModalBtnAyuda" class="tutorial-btn">Tutorial</a>
                    <a href="{{ route('descargar-registros') }}" class="action-btn">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Descargar Registros en PDF
                    </a>
                    <button id="printButton" class="action-btn">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H3a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Imprimir Saldo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-slate-50">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Financiero</h2>
                <p class="text-gray-600">Visualización completa de tus ingresos, gastos y saldo actual</p>
            </div>

            <!-- Main Balance Section -->
            <div id="min" class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-center justify-center mb-8">
                <!-- Income Chart -->
                <div id="first-chart" class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 print-chart-container">
                    <div class="text-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 print-chart-title">Distribución de Ingresos</h3>
                        <p class="text-gray-600 text-sm">Fijos vs Variables</p>
                    </div>
                    <div class="flex justify-center">
                        <canvas id="pieChart1" class="chart-canvas max-w-xs"></canvas>
                        <div class="print-chart-placeholder">
                            📊 Gráfico de Distribución de Ingresos<br>
                            <small>Fijo: {{ number_format($ingreso_fijo, 1) }}% | Variable: {{ number_format($ingreso_variable, 1) }}%</small>
                        </div>
                    </div>
                </div>

                <!-- Balance Container -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <label for="saldo" class="block mb-4 text-2xl font-extrabold tracking-tight text-gray-800">Mi Saldo Actual</label>
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg p-6 mb-6 print-balance-container">
                            <div class="print-balance-title">SALDO ACTUAL</div>
                            <input type="text" id="saldo" name="saldo" value="${{ number_format($operacionfinal, 2) }}" class="bg-transparent text-white font-bold text-3xl text-center w-full border-none outline-none print-balance-amount" disabled>
                            <p class="text-white text-sm mt-2 opacity-90 print-balance-description">Este es tu saldo disponible basado en las últimas operaciones.</p>
                        </div>

                        <!-- Reset Buttons -->
                        <div class="space-y-3 no-print">
                            <form action="{{ route('saldo.reset') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="reset-button bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-lg w-full transition-all duration-300">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Resetear INGRESOS Y GASTOS
                                </button>
                            </form>
                            <form action="{{ route('saldo.clear') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="reset-button bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg w-full transition-all duration-300">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Resetear SALDO
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Expenses Chart -->
                <div id="second-chart" class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 print-chart-container">
                    <div class="text-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 print-chart-title">Distribución de Gastos</h3>
                        <p class="text-gray-600 text-sm">Por categorías</p>
                    </div>
                    <div class="flex justify-center">
                        <canvas id="pieChart2" class="chart-canvas max-w-xs"></canvas>
                        <div class="print-chart-placeholder">
                            📊 Gráfico de Distribución de Gastos<br>
                            <small>Gastos por categorías principales</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Footer (Only visible when printing) -->
    <div class="print-footer" style="display: none;">
        <p>Reporte generado el {{ now()->format('d/m/Y H:i') }} · Finanzas Pro - Tu Asesor Financiero Personal © {{ now()->year }}</p>
        <p>Este documento contiene información confidencial de tu situación financiera personal.</p>
    </div>

    <!-- Modal -->
    <div id="aboutModalAyuda" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="modal-content bg-white rounded-xl shadow-2xl max-w-md mx-4">
            <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-6 rounded-t-xl">
                <h2 class="text-2xl font-bold flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                    Tutorial - Saldo
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4 text-gray-700">
                    <p class="leading-relaxed"> 
                        Bienvenido a la pantalla de Saldo, donde puedes visualizar tu información financiera de una manera clara. 
                    </p>
                    <p class="leading-relaxed">
                        A los lados del recuadro central, están tus ingresos y tus gastos, divididos en una gráfica de pastel para que puedas ver tu información en forma de porcentaje. Al centro de la pantalla, está tu saldo actual. Debajo de dicho dato, están dos botones, en caso de que necesites reiniciar tu información. El primer botón reinicia solo tus gastos y tus ingresos, y el segundo botón reinicia tu saldo, en caso de que quieras empezar desde cero.
                    </p>
                    <div class="bg-green-50 p-4 rounded-lg border-l-4 border-green-400">
                        <p class="text-green-800 font-medium">💡 Utiliza los botones de descarga e impresión en el header para generar reportes de tu información.</p>
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
        document.getElementById('printButton').addEventListener('click', function() {
            // Show print-specific elements
            document.querySelectorAll('.print-header, .print-footer').forEach(el => {
                el.style.display = 'block';
            });
            
            // Add print title to document
            const originalTitle = document.title;
            document.title = 'Reporte de Saldo Financiero - Finanzas Pro';
            
            // Print the document
            window.print();
            
            // Hide print elements after printing
            setTimeout(() => {
                document.querySelectorAll('.print-header, .print-footer').forEach(el => {
                    el.style.display = 'none';
                });
                document.title = originalTitle;
            }, 1000);
        });
    </script>

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

@section('js')
    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            // Show print-specific elements
            document.querySelectorAll('.print-header, .print-footer').forEach(el => {
                el.style.display = 'block';
            });
            
            // Add print title to document
            const originalTitle = document.title;
            document.title = 'Reporte de Saldo Financiero - Finanzas Pro';
            
            // Print the document
            window.print();
            
            // Hide print elements after printing
            setTimeout(() => {
                document.querySelectorAll('.print-header, .print-footer').forEach(el => {
                    el.style.display = 'none';
                });
                document.title = originalTitle;
            }, 1000);
        });
    </script>
@endsection
