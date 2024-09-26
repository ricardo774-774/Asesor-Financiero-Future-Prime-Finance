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
            height: 60%;
        }

        /* Estilo del modal */
        #aboutModalAyuda {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw; /* Asegura que el fondo cubra todo el ancho */
            height: 100vh; /* Asegura que cubra toda la altura */
            background-color: rgba(0, 0, 0, 0.8); /* Fondo oscuro con opacidad */
            align-items: center;
            justify-content: center;
            padding: 0; /* Eliminar cualquier padding */
        }

        /* Estilo del contenido dentro del modal */
        #aboutModalAyuda .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 90%; /* Ajusta el ancho del modal */
        }
    </style>

        <div class="bg-gradient-to-b">
            <div class="w-full sm:px-6 lg:px-8 mb-6 from-gray-100 to-gray-300">
                <div class="w-full bg-gray-100 p-4 flex justify-between items-center">
                <!-- Botón Ayuda a la izquierda -->
                <a href="#" id="openModalBtnAyuda" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Ayuda</a> 
                </div>
            
            <div class="w-full flex flex-col items-center space-y-20">
                
                <div class="grid grid-cols-3 gap-6 w-full max-w-6xl px-6 mx-auto">
    
                    <!-- Tarjeta Metas -->
                    <div class="relative group bg-white shadow-md rounded-lg overflow-hidden transition transform hover:scale-105">
                        <a href="{{ route('meta.create') }}" class="block w-full h-full">

                            <img id="image" src="{{ asset('metas-target.png') }}" alt="Metas" class="w-full h-48 object-cover transition duration-300 ease-in-out transform group-hover:scale-105">
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">METAS</h3>
                                <p class="text-gray-600">Configura y administra tus metas financieras aquí.</p>
                            </div>
                        </a>
                    </div>
                
                    <!-- Tarjeta Análisis Financiero -->
                    <div class="relative group bg-white shadow-md rounded-lg overflow-hidden transition transform hover:scale-105">
                        <a href="{{ route('previo.create') }}" class="block w-full h-full">

                            <img id="image" src="{{ asset('analisis-financiero.jpg') }}" alt="Análisis Financiero" class="w-full h-48 object-cover transition duration-300 ease-in-out transform group-hover:scale-105">
                            

                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">ANÁLISIS FINANCIERO</h3>
                                <p class="text-gray-600">Realiza un análisis financiero basado en tus datos.</p>
                            </div>
                        </a>
                    </div>
                
                    <!-- Tarjeta Generador -->
                    <div class="relative group bg-white shadow-md rounded-lg overflow-hidden transition transform hover:scale-105">
                        <a href="{{ route('generador.index') }}" class="block w-full h-full">

                            <img id="image" src="{{ asset('generador.png') }}" alt="Generador" class="w-full h-48 object-cover transition duration-300 ease-in-out transform group-hover:scale-105">
                            

                            <div class="p-6">
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
    <div id="aboutModalAyuda" class="hidden">
        <div class="modal-content">
            <h2 class="text-xl font-bold mb-4">Ayuda</h2>
            <p class="mb-4">
                Bienvenido a tu Asesor Financiero Personal Future Prime Finance:
                Una herramienta pensada para ser el asesor financiero sencillo de utilizar y de acoplar a tu vida diaria. Disfruta de las diversas funcionalidades que ofrecemos, a través de registros sencillos de llevar, mediante una interfaz amigable y agradable, brindando una experiencia de calidad, siendo tu acompañamiento en el camino de las Finanzas Personales.
            </p>
            <p class="mb-4">
                Recuerda que siempre puedes utilizar este tutorial si en algún momento te sientes perdido. 
            </p>
            <p class="mb-4">   
                En cada pantalla del programa encontrarás una sección informativa, con el propósito de orientar y responder tus dudas en caso de que experimentes problemas mientras disfrutas del sistema.
                Future Prime Finance es un asesor financiero personal que te ayuda a registrar y a concientizar tu información económica, en pro de encaminar tus decisiones financieras hacia la mejoría, basado en la madurez, la planeación a largo plazo y el ahorro.
            </p>
            <p class="mb-4">   
                En el menú superior podrás encontrar tres pestañas donde llevarás a cabo tus registros financieros: estarás estableciendo tus ingresos y tus gastos para poder visualizar tu saldo y la misma información de una manera gráfica, para facilitar la perspectiva sobre el cómo utilizas tu dinero.
            </p>
            <p class="mb-4">    
                Al centro de la pantalla principal, podrás encontrar tres opciones, que corresponden a las herramientas que te brindamos.
                Una vez que hayas hecho los registros correspondientes de tu información, experimenta con la ayuda de la Inteligencia Artificial, y fija metas u objetivos financieros. Visualiza el ahorro que necesitas y recuerda que cualquier meta que te propongas se puede lograr, pero siempre recordando la importancia del ahorro, y aprovecha las recomendaciones que el sistema te ofrecerá para empezar a hacer modificaciones a la forma en la que aprovechas tu dinero. 
                De parte del equipo de desarrollo, esperamos que este programa te aporte, aunque sea un poco en el camino de tu crecimiento financiero.
                ¡Recuerda que los grandes cambios comienzan día con día!
            </p>
            <button id="closeModalBtnAyuda" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
        </div>
    </div>

    <script>
        const openModalBtnAyuda = document.getElementById('openModalBtnAyuda');
        const closeModalBtnAyuda = document.getElementById('closeModalBtnAyuda');
        const aboutModalAyuda = document.getElementById('aboutModalAyuda');

        openModalBtnAyuda.addEventListener('click', function(event) {
            event.preventDefault();
            console.log("Abriendo modal");
            aboutModalAyuda.classList.remove('hidden');
            aboutModalAyuda.classList.add('flex'); 
        });

        closeModalBtnAyuda.addEventListener('click', function() {
            console.log("Cerrando modal");
            aboutModalAyuda.classList.add('hidden');
            aboutModalAyuda.classList.remove('flex'); 
        });

        window.addEventListener('click', function(event) {
            if (event.target === aboutModalAyuda) {
                console.log("Cerrando modal al hacer clic fuera");
                aboutModalAyuda.classList.add('hidden');
                aboutModalAyuda.classList.remove('flex');
            }
        });

    </script>
    @endcan
</x-app-layout>
