<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center bg-gray-100">
            {{ __('ASESOR FINANCIERO') }}
        </h2>
    </x-slot>

    @can('gasto.index')

    <style>
        .main-box {
            border: 1px solid rgba(225, 225, 225, 0.8);
            box-shadow: 0px 0px 10px #ccc;
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
        }

    </style>
    
    <div class="bg-gradient-to-b from-gray-100 to-gray-300 min-h-screen flex flex-col">
        <div class="w-full sm:px-6 lg:px-8 mb-6">
            <div class="w-full bg-gray-100 p-4 flex justify-between items-center">
                <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Ayuda</a> 
            </div>
    
            <div class="w-full flex flex-col items-center space-y-10 lg:space-y-20">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full max-w-6xl px-6 mx-auto">
                    
                    <!-- Tarjeta Metas -->
                    <div class="relative group bg-white shadow-md rounded-lg overflow-hidden transition transform hover:scale-105 flex flex-col min-h-[28rem]">
                        <a href="{{ route('meta.create') }}" class="block w-full h-full flex flex-col justify-between">
                            <img src="{{ asset('metas-target.png') }}" alt="Metas" class="w-full h-60 object-cover transition duration-300 ease-in-out transform group-hover:scale-105">
                            <div class="p-6 flex-grow">
                                <h3 class="text-xl font-bold mb-2">METAS</h3>
                                <p class="text-gray-600">Configura y administra tus metas financieras aquí.</p>
                            </div>
                        </a>
                    </div>
                
                    <!-- Tarjeta Análisis Financiero -->
                    <div class="relative group bg-white shadow-md rounded-lg overflow-hidden transition transform hover:scale-105 flex flex-col min-h-[28rem]">
                        <a href="{{ route('previo.create') }}" class="block w-full h-full flex flex-col justify-between">
                            <img src="{{ asset('analisis-financiero.jpg') }}" alt="Análisis Financiero" class="w-full h-60 object-cover transition duration-300 ease-in-out transform group-hover:scale-105">
                            <div class="p-6 flex-grow">
                                <h3 class="text-xl font-bold mb-2">ANÁLISIS FINANCIERO</h3>
                                <p class="text-gray-600">Realiza un análisis financiero basado en tus datos.</p>
                            </div>
                        </a>
                    </div>
                
                    <!-- Tarjeta Generador -->
                    <div class="relative group bg-white shadow-md rounded-lg overflow-hidden transition transform hover:scale-105 flex flex-col min-h-[28rem]">
                        <a href="{{ route('generador.index') }}" class="block w-full h-full flex flex-col justify-between">
                            <img src="{{ asset('generador.png') }}" alt="Generador" class="w-full h-60 object-cover transition duration-300 ease-in-out transform group-hover:scale-105">
                            <div class="p-6 flex-grow">
                                <h3 class="text-xl font-bold mb-2">GENERADOR</h3>
                                <p class="text-gray-600">Inspírate por alguna de las sugerencias más populares entre la población</p>
                            </div>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="aboutModalAyuda" class="hidden flex items-center justify-center">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg m-8">
            <h2 class="text-xl font-bold mb-4">Ayuda</h2>
            <p class="mb-4 text-justify"> 
                Bienvenido a tu Asesor Financiero Personal Future Prime Finance. Recuerda que siempre puedes utilizar este tutorial si en algún momento te sientes perdido. 
            </p>
            <p class="mb-4 text-justify">   
                En cada pantalla del programa encontrarás una sección informativa, con el propósito de orientar y responder tus dudas en caso de que experimentes problemas mientras disfrutas del sistema.
                Future Prime Finance es un asesor financiero personal que te ayuda a registrar y a concientizar tu información económica, en pro de encaminar tus decisiones financieras hacia la mejoría, basado en la madurez, la planeación a largo plazo y el ahorro.
            </p>
            <p class="mb-4 text-justify">   
                En el menú superior podrás encontrar tres pestañas donde llevarás a cabo tus registros financieros: estarás estableciendo tus ingresos y tus gastos para poder visualizar tu saldo y la misma información de una manera gráfica, para facilitar la perspectiva sobre el cómo utilizas tu dinero.
            </p>
            <p class="mb-4 text-justify">    
                Al centro de la pantalla principal, podrás encontrar tres opciones, que corresponden a las herramientas que te brindamos.
                Una vez que hayas hecho los registros correspondientes de tu información, experimenta con la ayuda de la Inteligencia Artificial, y fija metas u objetivos financieros. Visualiza el ahorro que necesitas y recuerda que cualquier meta que te propongas se puede lograr, pero siempre recordando la importancia del ahorro, y aprovecha las recomendaciones que el sistema te ofrecerá para empezar a hacer modificaciones a la forma en la que aprovechas tu dinero. 
                De parte del equipo de desarrollo, esperamos que este programa te aporte, aunque sea un poco en el camino de tu crecimiento financiero.
            </p>
            <p class="mb-4 text-justify">
                ¡Recuerda que los grandes cambios comienzan día con día!
            </p>
            <button id="closeModalBtnAyuda" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
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