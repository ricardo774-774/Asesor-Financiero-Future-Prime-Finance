<x-app-layout>

    @can('gasto.index')

    <style>
        .main-box {
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0px 0px 10px rgba(100, 116, 139, 0.2);
        }
    
        #image {
            height: auto; /* Ajuste para que las imágenes se adapten */
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

        /* Estilos para el contenido del modal */
        .modal-content {
            background-color: #fff;
            padding: 20px;
            max-width: 70%;
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border: 1px solid #e2e8f0;
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

        .dashboard-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(30, 64, 175, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.2);
            border-color: rgba(59, 130, 246, 0.4);
        }

        .card-image {
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover .card-image {
            transform: scale(1.05);
        }
    </style>
    
    <!-- Header Section with Tutorial Button -->
    <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">ASESOR FINANCIERO</h1>
                    <p class="text-blue-100 mt-2">Tu centro de control financiero personal</p>
                </div>
                <a href="#" id="openModalBtnAyuda" class="tutorial-btn">Tutorial</a>
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
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Herramientas Financieras</h2>
                <p class="text-gray-600">Selecciona la herramienta que deseas utilizar</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                <!-- Tarjeta Metas -->
                <div class="dashboard-card group">
                    <a href="{{ route('meta.create') }}" class="block h-full">
                        <div class="overflow-hidden">
                            <img src="{{ asset('metas-target.png') }}" alt="Metas" class="w-full h-60 object-cover card-image">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">METAS</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed">Configura y administra tus metas financieras aquí. Establece objetivos claros y haz seguimiento a tu progreso.</p>
                            <div class="mt-4 flex items-center text-blue-600 font-medium group-hover:text-blue-700">
                                <span>Ir a Metas</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            
                <!-- Tarjeta Análisis Financiero -->
                <div class="dashboard-card group">
                    <a href="{{ route('previo.create') }}" class="block h-full">
                        <div class="overflow-hidden">
                            <img src="{{ asset('analisis-financiero.jpg') }}" alt="Análisis Financiero" class="w-full h-60 object-cover card-image">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">ANÁLISIS FINANCIERO</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed">Realiza un análisis financiero basado en tus datos. Obtén insights valiosos sobre tu situación económica.</p>
                            <div class="mt-4 flex items-center text-blue-600 font-medium group-hover:text-blue-700">
                                <span>Ir a Análisis</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            
                <!-- Tarjeta Generador -->
                <div class="dashboard-card group">
                    <a href="{{ route('generador.index') }}" class="block h-full">
                        <div class="overflow-hidden">
                            <img src="{{ asset('generador.png') }}" alt="Generador" class="w-full h-60 object-cover card-image">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">GENERADOR</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed">Inspírate por alguna de las sugerencias más populares entre la población. Descubre nuevas ideas financieras.</p>
                            <div class="mt-4 flex items-center text-blue-600 font-medium group-hover:text-blue-700">
                                <span>Ir a Generador</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="aboutModalAyuda" class="hidden flex items-center justify-center">
        <div class="modal-content bg-white rounded-xl shadow-2xl max-w-2xl mx-4">
            <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white p-6 rounded-t-xl">
                <h2 class="text-2xl font-bold flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                    Tutorial - Asesor Financiero
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4 text-gray-700">
                    <p class="leading-relaxed"> 
                        Bienvenido a tu asesor financiero personal Finanzas Pro. Recuerda que siempre puedes utilizar este tutorial si en algún momento te sientes perdido. 
                    </p>
                    <p class="leading-relaxed">   
                        En cada pantalla del programa encontrarás una sección informativa, con el propósito de orientar y responder tus dudas en caso de que experimentes problemas mientras disfrutas del sistema.
                        Finanzas Pro es un asesor financiero personal que te ayuda a registrar y a concientizar tu información económica, en pro de encaminar tus decisiones financieras hacia la mejoría, basado en la madurez, la planeación a largo plazo y el ahorro.
                    </p>
                    <p class="leading-relaxed">   
                        En el menú superior podrás encontrar tres pestañas donde llevarás a cabo tus registros financieros: estarás estableciendo tus ingresos y tus gastos para poder visualizar tu saldo y la misma información de una manera gráfica, para facilitar la perspectiva sobre el cómo utilizas tu dinero.
                    </p>
                    <p class="leading-relaxed">    
                        Al centro de la pantalla principal, podrás encontrar tres opciones, que corresponden a las herramientas que te brindamos.
                        Una vez que hayas hecho los registros correspondientes de tu información, experimenta con la ayuda de la Inteligencia Artificial, y fija metas u objetivos financieros. Visualiza el ahorro que necesitas y recuerda que cualquier meta que te propongas se puede lograr, pero siempre recordando la importancia del ahorro, y aprovecha las recomendaciones que el sistema te ofrecerá para empezar a hacer modificaciones a la forma en la que aprovechas tu dinero. 
                        De parte del equipo de desarrollo, esperamos que este programa te aporte, aunque sea un poco en el camino de tu crecimiento financiero.
                    </p>
                    <div class="bg-green-50 p-4 rounded-lg border-l-4 border-green-400">
                        <p class="text-green-800 font-medium">💡 ¡Recuerda que los grandes cambios comienzan día con día!</p>
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
    </script>

    @endcan
</x-app-layout>