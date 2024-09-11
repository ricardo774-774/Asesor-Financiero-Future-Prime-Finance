<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            {{ __('ASESOR FINANCIERO') }}
        </h2>
    </x-slot>

    @can('gasto.index')
    <div class="bg-gradient-to-b from-gray-100 to-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full bg-gray-100 p-4 flex justify-between items-center">
                <!-- Botón Ayuda a la izquierda -->
                <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Ayuda</a>  
            </div>
            
            <div class="bg-white/90 backdrop-blur-md overflow-hidden shadow-sm sm:rounded-lg min-h-screen flex justify-center items-center">
                <!-- Aquí va el contenido -->
            
                            
                <div class="w-full flex flex-col items-center">
                    
                    <!-- Sección central con botones -->
                    <div class="w-full flex flex-col items-center space-y-20"> <!-- Aumenta aún más el espacio entre los botones -->
                        
                        <!-- Botón de Metas -->
                        <div class="relative group">
                            <a href="{{route('meta.create')}}" class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-bold py-8 px-16 rounded-full w-2/3 text-center text-2xl shadow-lg transition transform hover:scale-105">
                                METAS
                            </a>
                            <!-- Tooltip -->
                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-72 bg-gray-700 text-white text-sm rounded-lg p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Configura y administra tus metas financieras aquí.
                            </div>
                        </div>

                        <!-- Botón de Análisis Financiero -->
                        <div class="relative group">
                            <a href="{{route('previo.create')}}" class="bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white font-bold py-8 px-16 rounded-full w-2/3 text-center text-2xl shadow-lg transition transform hover:scale-105">
                                ANÁLISIS FINANCIERO
                            </a>
                            <!-- Tooltip -->
                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-72 bg-gray-700 text-white text-sm rounded-lg p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Realiza un análisis financiero basado en tus datos.
                            </div>
                        </div>

                        <!-- Botón de Generador -->
                        <div class="relative group">
                            <a href="{{route('generador.index')}}" class="bg-gradient-to-r from-purple-500 to-purple-700 hover:from-purple-600 hover:to-purple-800 text-white font-bold py-8 px-16 rounded-full w-2/3 text-center text-2xl shadow-lg transition transform hover:scale-105">
                                GENERADOR
                            </a>
                            <!-- Tooltip -->
                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-72 bg-gray-700 text-white text-sm rounded-lg p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Genera un reporte o documento según tus necesidades.
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="aboutModalAyuda" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-400">
            <h2 class="text-xl font-bold mb-4">Ayuda</h2>
            <p class="mb-4">Bienvenido a tu Asesor Financiero Personal Future Prime Finance:
                Una herramienta pensada para ser el asesor financiero sencillo de utilizar y de acoplar a tu vida diaria. Disfruta de las diversas funcionalidades que ofrecemos, a través de registros sencillos de llevar, mediante una interfaz amigable y agradable, brindando una experiencia de calidad, siendo tu acompañamiento en el camino de las Finanzas Personales.
            </p><p class="mb-4">
                Recuerda que siempre puedes utilizar este tutorial si en algún momento te sientes perdido. 
            </p><p class="mb-4">   
                En cada pantalla del programa encontrarás una sección informativa, con el propósito de orientar y responder tus dudas en caso de que experimentes problemas mientras disfrutas del sistema.
                Future Prime Finance es un asesor financiero personal que te ayuda a registrar y a concientizar tu información económica, en pro de encaminar tus decisiones financieras hacia la mejoría, basado en la madurez, la planeación a largo plazo y el ahorro.
            </p><p class="mb-4">   
                En el menú superior podrás encontrar tres pestañas donde llevarás a cabo tus registros financieros: estarás estableciendo tus ingresos y tus gastos para poder visualizar tu saldo y la misma información de una manera gráfica, para facilitar la perspectiva sobre el cómo utilizas tu dinero.
            </p><p class="mb-4">    
                Al centro de la pantalla principal, podrás encontrar tres opciones, que corresponden a las herramientas que te brindamos.
                Una vez que hayas hecho los registros correspondientes de tu información, experimenta con la ayuda de la Inteligencia Artificial, y fija metas u objetivos financieros. Visualiza el ahorro que necesitas y recuerda que cualquier meta que te propongas se puede lograr, pero siempre recordando la importancia del ahorro, y aprovecha las recomendaciones que el sistema te ofrecerá para empezar a hacer modificaciones a la forma en la que aprovechas tu dinero. 
                De parte del equipo de desarrollo, esperamos que este programa te aporte, aunque sea un poco en el camino de tu crecimiento financiero.
                ¡Recuerda que los grandes cambios comienzan día con día!
                
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
    @endcan
</x-app-layout>
