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

        .comparison-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-left: 4px solid #3b82f6;
        }

        .crisis-simulator {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-left: 4px solid #ef4444;
        }

        .benchmark-positive {
            color: #059669;
            font-weight: bold;
        }

        .benchmark-negative {
            color: #dc2626;
            font-weight: bold;
        }

        .benchmark-neutral {
            color: #d97706;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
<!-- Header Section with Tutorial Button -->
<div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">ANÁLISIS FINANCIERO AVANZADO</h1>
                <p class="text-blue-100 mt-2">Compara tu situación con promedios nacionales y simula escenarios de crisis</p>
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

        <!-- Profile Setup Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8 mb-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Perfil para Análisis</h2>
                <p class="text-gray-600">Completa tu información para obtener comparaciones precisas</p>
            </div>
            
            <form id="profileForm" class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="edad" class="block text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        Edad
                    </label>
                    <select id="edad" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Selecciona tu rango de edad</option>
                        <option value="18-25">18-25 años</option>
                        <option value="26-35">26-35 años</option>
                        <option value="36-45">36-45 años</option>
                        <option value="46-55">46-55 años</option>
                        <option value="56-65">56-65 años</option>
                        <option value="65+">65+ años</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="region" class="block text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 inline mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        Región
                    </label>
                    <select id="region" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Selecciona tu región</option>
                        <option value="norte">Norte (Nuevo León, Sonora, Chihuahua)</option>
                        <option value="centro">Centro (CDMX, Estado de México, Puebla)</option>
                        <option value="bajio">Bajío (Jalisco, Guanajuato, Aguascalientes)</option>
                        <option value="sur">Sur (Oaxaca, Chiapas, Guerrero)</option>
                        <option value="sureste">Sureste (Yucatán, Quintana Roo, Campeche)</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="ingresos_mensuales" class="block text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 inline mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                        Ingresos Mensuales (MXN)
                    </label>
                    <input type="number" id="ingresos_mensuales" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ej: 25000">
                </div>

                <div class="space-y-2">
                    <label for="gastos_mensuales" class="block text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 inline mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        Gastos Mensuales (MXN)
                    </label>
                    <input type="number" id="gastos_mensuales" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ej: 18000">
                </div>

                <div class="md:col-span-2 flex justify-center pt-4">
                    <button type="button" onclick="generateComparison()" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-8 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Generar Análisis Comparativo
                    </button>
                </div>
            </form>
        </div>

        <!-- Analysis Results Grid -->
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            <!-- Comparación con Promedios Nacionales -->
            <div id="comparisonResults" class="bg-white rounded-xl shadow-lg border border-gray-200 hidden">
                <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-6 rounded-t-xl">
                    <h2 class="text-xl font-bold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Comparación Nacional
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="comparison-card p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-800 mb-2">📊 Ingresos vs Promedio Nacional</h3>
                        <div id="incomeComparison" class="text-sm"></div>
                    </div>
                    
                    <div class="comparison-card p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-800 mb-2">💰 Capacidad de Ahorro</h3>
                        <div id="savingsComparison" class="text-sm"></div>
                    </div>
                    
                    <div class="comparison-card p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-800 mb-2">🎯 Recomendaciones Personalizadas</h3>
                        <div id="recommendations" class="text-sm"></div>
                    </div>
                </div>
            </div>

            <!-- Simulador de Crisis -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="bg-gradient-to-r from-red-600 to-red-700 text-white p-6 rounded-t-xl">
                    <h2 class="text-xl font-bold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.667-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Simulador de Crisis
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">Simula diferentes escenarios de crisis para evaluar tu resistencia financiera</p>
                    
                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Crisis</label>
                            <select id="crisisType" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <option value="job_loss">Pérdida de empleo</option>
                                <option value="medical">Emergencia médica</option>
                                <option value="economic">Crisis económica general</option>
                                <option value="family">Emergencia familiar</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Duración (meses)</label>
                            <select id="crisisDuration" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <option value="1">1 mes</option>
                                <option value="3" selected>3 meses</option>
                                <option value="6">6 meses</option>
                                <option value="12">12 meses</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Reducción de ingresos (%)</label>
                            <select id="incomeReduction" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <option value="25">25% - Reducción parcial</option>
                                <option value="50">50% - Reducción significativa</option>
                                <option value="75">75% - Reducción severa</option>
                                <option value="100" selected>100% - Pérdida total</option>
                            </select>
                        </div>
                    </div>
                    
                    <button onclick="simulateCrisis()" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-md">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        Simular Escenario de Crisis
                    </button>
                </div>
            </div>
        </div>

        <!-- Crisis Results -->
        <div id="crisisResults" class="bg-white rounded-xl shadow-lg border border-gray-200 hidden mb-8">
            <div class="bg-gradient-to-r from-red-600 to-red-700 text-white p-6 rounded-t-xl">
                <h2 class="text-xl font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    Resultados del Simulador
                </h2>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="crisis-simulator p-4 rounded-lg text-center">
                        <h3 class="font-semibold text-gray-800 mb-2">⏱️ Tiempo de Supervivencia</h3>
                        <div id="survivalTime" class="text-2xl font-bold text-red-600"></div>
                    </div>
                    
                    <div class="crisis-simulator p-4 rounded-lg text-center">
                        <h3 class="font-semibold text-gray-800 mb-2">💸 Déficit Total</h3>
                        <div id="totalDeficit" class="text-2xl font-bold text-red-600"></div>
                    </div>
                    
                    <div class="crisis-simulator p-4 rounded-lg text-center">
                        <h3 class="font-semibold text-gray-800 mb-2">🛡️ Fondo Recomendado</h3>
                        <div id="recommendedFund" class="text-2xl font-bold text-green-600"></div>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-r-lg">
                    <h3 class="font-semibold text-yellow-800 mb-2">📋 Plan de Acción Recomendado</h3>
                    <div id="actionPlan" class="text-sm text-yellow-700"></div>
                </div>
            </div>
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
                Tutorial - Análisis Financiero Avanzado
            </h2>
        </div>
        <div class="p-6">
            <div class="space-y-4 text-gray-700">
                <p class="leading-relaxed">
                    <strong>Análisis Financiero Avanzado</strong> te permite:
                </p>
                <ul class="list-disc list-inside space-y-2 text-sm">
                    <li><strong>Comparar</strong> tus finanzas con promedios nacionales por edad y región</li>
                    <li><strong>Simular crisis</strong> como pérdida de empleo para evaluar tu resistencia financiera</li>
                    <li><strong>Obtener recomendaciones</strong> personalizadas basadas en tu perfil</li>
                    <li><strong>Planificar</strong> fondos de emergencia según diferentes escenarios</li>
                </ul>
                <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                    <p class="text-blue-800 font-medium">💡 Completa tu perfil para obtener análisis más precisos</p>
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
    // Datos financieros reales del usuario desde la base de datos
    const datosUsuario = @json($datosFinancieros ?? []);
    
    // Datos de referencia nacional (simulados pero basados en estadísticas reales)
    const nationalAverages = {
        '18-25': {
            norte: { income: 18000, savings: 0.08 },
            centro: { income: 16000, savings: 0.06 },
            bajio: { income: 15000, savings: 0.07 },
            sur: { income: 12000, savings: 0.05 },
            sureste: { income: 13000, savings: 0.06 }
        },
        '26-35': {
            norte: { income: 28000, savings: 0.12 },
            centro: { income: 25000, savings: 0.10 },
            bajio: { income: 22000, savings: 0.11 },
            sur: { income: 18000, savings: 0.08 },
            sureste: { income: 20000, savings: 0.09 }
        },
        '36-45': {
            norte: { income: 35000, savings: 0.15 },
            centro: { income: 32000, savings: 0.13 },
            bajio: { income: 28000, savings: 0.14 },
            sur: { income: 22000, savings: 0.10 },
            sureste: { income: 25000, savings: 0.12 }
        },
        '46-55': {
            norte: { income: 40000, savings: 0.18 },
            centro: { income: 38000, savings: 0.16 },
            bajio: { income: 32000, savings: 0.17 },
            sur: { income: 25000, savings: 0.12 },
            sureste: { income: 28000, savings: 0.14 }
        },
        '56-65': {
            norte: { income: 35000, savings: 0.20 },
            centro: { income: 33000, savings: 0.18 },
            bajio: { income: 28000, savings: 0.19 },
            sur: { income: 22000, savings: 0.15 },
            sureste: { income: 25000, savings: 0.16 }
        },
        '65+': {
            norte: { income: 25000, savings: 0.25 },
            centro: { income: 23000, savings: 0.22 },
            bajio: { income: 20000, savings: 0.24 },
            sur: { income: 15000, savings: 0.18 },
            sureste: { income: 18000, savings: 0.20 }
        }
    };

    function generateComparison() {
        const edad = document.getElementById('edad').value;
        const region = document.getElementById('region').value;
        let ingresos = parseFloat(document.getElementById('ingresos_mensuales').value);
        let gastos = parseFloat(document.getElementById('gastos_mensuales').value);

        // Si no hay datos en el formulario, usar datos reales del usuario
        if ((!ingresos || !gastos) && datosUsuario) {
            ingresos = datosUsuario.ingreso_mensual || 0;
            gastos = datosUsuario.gastos_mensuales || 0;
            
            // Llenar los campos del formulario con los datos reales
            if (ingresos > 0) document.getElementById('ingresos_mensuales').value = ingresos;
            if (gastos > 0) document.getElementById('gastos_mensuales').value = gastos;
        }

        if (!edad || !region) {
            alert('Por favor selecciona tu edad y región para continuar');
            return;
        }
        
        if (!ingresos || !gastos) {
            alert('No se encontraron datos financieros. Por favor completa tu información de ingresos y gastos en el sistema primero.');
            return;
        }

        const userSavings = ingresos - gastos;
        const userSavingsRate = userSavings / ingresos;
        
        const nationalData = nationalAverages[edad][region];
        const avgIncome = nationalData.income;
        const avgSavingsRate = nationalData.savings;
        const avgSavings = avgIncome * avgSavingsRate;

        // Mostrar resultados
        document.getElementById('comparisonResults').classList.remove('hidden');

        // Comparación de ingresos
        const incomePercentage = ((ingresos / avgIncome - 1) * 100).toFixed(1);
        const incomeClass = ingresos > avgIncome ? 'benchmark-positive' : ingresos < avgIncome * 0.8 ? 'benchmark-negative' : 'benchmark-neutral';
        document.getElementById('incomeComparison').innerHTML = `
            <p>Tus ingresos: <strong>$${ingresos.toLocaleString()}</strong></p>
            <p>Promedio nacional: <strong>$${avgIncome.toLocaleString()}</strong></p>
            <p class="${incomeClass}">Diferencia: ${incomePercentage > 0 ? '+' : ''}${incomePercentage}%</p>
        `;

        // Comparación de ahorro
        const savingsPercentage = ((userSavingsRate / avgSavingsRate - 1) * 100).toFixed(1);
        const savingsClass = userSavingsRate > avgSavingsRate ? 'benchmark-positive' : userSavingsRate < avgSavingsRate * 0.5 ? 'benchmark-negative' : 'benchmark-neutral';
        document.getElementById('savingsComparison').innerHTML = `
            <p>Tu ahorro mensual: <strong>$${userSavings.toLocaleString()}</strong> (${(userSavingsRate * 100).toFixed(1)}%)</p>
            <p>Promedio nacional: <strong>$${avgSavings.toLocaleString()}</strong> (${(avgSavingsRate * 100).toFixed(1)}%)</p>
            <p class="${savingsClass}">Diferencia: ${savingsPercentage > 0 ? '+' : ''}${savingsPercentage}%</p>
        `;

        // Recomendaciones
        let recommendations = '';
        if (userSavingsRate < 0.05) {
            recommendations = '🚨 <strong>Crítico:</strong> Tu tasa de ahorro es muy baja. Considera reducir gastos no esenciales y crear un presupuesto estricto.';
        } else if (userSavingsRate < avgSavingsRate) {
            recommendations = '⚠️ <strong>Mejorable:</strong> Estás por debajo del promedio. Intenta aumentar tu ahorro al menos 2-3% de tus ingresos.';
        } else if (userSavingsRate > avgSavingsRate * 1.5) {
            recommendations = '🌟 <strong>Excelente:</strong> Tu capacidad de ahorro es superior al promedio. Considera diversificar en inversiones.';
        } else {
            recommendations = '✅ <strong>Bien:</strong> Estás en el promedio nacional. Mantén este ritmo y considera optimizar tus inversiones.';
        }
        document.getElementById('recommendations').innerHTML = recommendations;
    }

    function simulateCrisis() {
        const crisisType = document.getElementById('crisisType').value;
        const duration = parseInt(document.getElementById('crisisDuration').value);
        const incomeReduction = parseInt(document.getElementById('incomeReduction').value);
        
        // Usar datos del formulario o datos reales del usuario
        let ingresos = parseFloat(document.getElementById('ingresos_mensuales').value) || 0;
        let gastos = parseFloat(document.getElementById('gastos_mensuales').value) || 0;
        let saldoActual = 0;
        
        // Si no hay datos en el formulario, usar datos reales del usuario
        if ((!ingresos || !gastos) && datosUsuario) {
            ingresos = datosUsuario.ingreso_mensual || 0;
            gastos = datosUsuario.gastos_mensuales || 0;
            saldoActual = datosUsuario.saldo_actual || 0;
            
            // Llenar los campos del formulario con los datos reales
            if (ingresos > 0) document.getElementById('ingresos_mensuales').value = ingresos;
            if (gastos > 0) document.getElementById('gastos_mensuales').value = gastos;
        }
        
        if (!ingresos || !gastos) {
            alert('No se encontraron datos financieros. Por favor completa tu información de ingresos y gastos en el sistema primero.');
            return;
        }

        const reducedIncome = ingresos * (1 - incomeReduction / 100);
        const monthlyDeficit = Math.max(0, gastos - reducedIncome); // Evitar déficit negativo
        const totalDeficit = monthlyDeficit * duration;
        
        // CORRECCIÓN: Usar el saldo actual acumulado, no el ahorro mensual
        // El saldo actual es lo que realmente tiene disponible para emergencias
        const availableFunds = saldoActual > 0 ? saldoActual : Math.max(0, ingresos - gastos) * 3; // Estimar 3 meses de ahorro si no hay saldo
        
        // Calcular tiempo de supervivencia con fondos disponibles
        let survivalMonths = 0;
        if (monthlyDeficit > 0 && availableFunds > 0) {
            survivalMonths = Math.floor(availableFunds / monthlyDeficit);
        } else if (monthlyDeficit <= 0) {
            survivalMonths = duration; // Si no hay déficit, puede sobrevivir toda la crisis
        }
        
        // Fondo de emergencia recomendado
        const recommendedFund = gastos * 6; // 6 meses de gastos
        
        // Mostrar resultados
        document.getElementById('crisisResults').classList.remove('hidden');
        
        document.getElementById('survivalTime').textContent = 
            survivalMonths > 0 ? `${survivalMonths} meses` : 'Menos de 1 mes';
        
        document.getElementById('totalDeficit').textContent = 
            `$${totalDeficit.toLocaleString()}`;
        
        document.getElementById('recommendedFund').textContent = 
            `$${recommendedFund.toLocaleString()}`;

        // Plan de acción
        let actionPlan = '';
        const crisisNames = {
            job_loss: 'pérdida de empleo',
            medical: 'emergencia médica',
            economic: 'crisis económica',
            family: 'emergencia familiar'
        };

        if (survivalMonths < 3) {
            actionPlan = `
                <strong>Situación crítica ante ${crisisNames[crisisType]}:</strong><br>
                • Crear fondo de emergencia inmediatamente<br>
                • Reducir gastos no esenciales en 30-40%<br>
                • Buscar fuentes de ingresos adicionales<br>
                • Considerar refinanciamiento de deudas
            `;
        } else if (survivalMonths < 6) {
            actionPlan = `
                <strong>Situación moderada ante ${crisisNames[crisisType]}:</strong><br>
                • Aumentar fondo de emergencia a 6 meses de gastos<br>
                • Diversificar fuentes de ingresos<br>
                • Revisar y optimizar gastos mensuales<br>
                • Considerar seguros de protección
            `;
        } else {
            actionPlan = `
                <strong>Buena preparación ante ${crisisNames[crisisType]}:</strong><br>
                • Mantener fondo de emergencia actualizado<br>
                • Considerar inversiones de bajo riesgo<br>
                • Revisar pólizas de seguros existentes<br>
                • Planificar estrategias de ingresos pasivos
            `;
        }
        
        document.getElementById('actionPlan').innerHTML = actionPlan;
    }

    // Modal functionality
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

    // Auto-hide error messages
    if (document.getElementById('error-message')) {
        let errorDiv = document.getElementById('error-message');
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }

    // Cargar datos del usuario automáticamente al cargar la página
    function cargarDatosUsuario() {
        if (datosUsuario && datosUsuario.ingreso_mensual > 0) {
            document.getElementById('ingresos_mensuales').value = datosUsuario.ingreso_mensual;
            document.getElementById('gastos_mensuales').value = datosUsuario.gastos_mensuales;
            
            // Mostrar información adicional al usuario
            const infoDiv = document.createElement('div');
            infoDiv.className = 'bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg mb-6';
            infoDiv.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <strong class="text-blue-800">Datos Cargados:</strong>
                </div>
                <p class="text-blue-700 mt-2 ml-7">
                    Se han cargado automáticamente tus datos financieros del sistema:<br>
                    • Ingresos: $${datosUsuario.ingreso_mensual.toLocaleString()}<br>
                    • Gastos: $${datosUsuario.gastos_mensuales.toLocaleString()}<br>
                    • Saldo actual: $${datosUsuario.saldo_actual.toLocaleString()}
                </p>
            `;
            
            // Insertar la información después del header
            const container = document.querySelector('.container.mx-auto.px-4.py-8');
            if (container && container.firstChild) {
                container.insertBefore(infoDiv, container.firstChild);
            }
        }
    }

    // Ejecutar al cargar la página
    document.addEventListener('DOMContentLoaded', cargarDatosUsuario);
</script>
@endsection
