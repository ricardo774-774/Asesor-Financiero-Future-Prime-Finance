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
    
        /* Estilo del modal */
        #aboutModalAyuda {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.8);
            align-items: center;
            justify-content: center;
            padding: 0;
        }
    
        /* Estilo del contenido dentro del modal */
        #aboutModalAyuda .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 600px;
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
        <div class="modal-content">
            <h2 class="text-xl font-bold mb-4">Ayuda</h2>
            <p class="mb-4 text-justify"> Bienvenido a tu Asesor Financiero Personal Future Prime Finance:
                Una herramienta pensada para ser el asesor financiero sencillo de utilizar y de 
                acoplar a tu vida diaria. Disfruta de las diversas funcionalidades que ofrecemos, 
                a través de registros sencillos de llevar, mediante una interfaz amigable y agradable, 
                brindando una experiencia de calidad, siendo tu acompañamiento en el camino 
                de las Finanzas Personales.</p>
            <button id="closeModalBtnAyuda" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
        </div>
    </div>

    <script>
        const openModalBtnAyuda = document.getElementById('openModalBtnAyuda');
        const closeModalBtnAyuda = document.getElementById('closeModalBtnAyuda');
        const aboutModalAyuda = document.getElementById('aboutModalAyuda');

        openModalBtnAyuda.addEventListener('click', function(event) {
            event.preventDefault();
            aboutModalAyuda.classList.remove('hidden');
            aboutModalAyuda.classList.add('flex'); 
        });

        closeModalBtnAyuda.addEventListener('click', function() {
            aboutModalAyuda.classList.add('hidden');
            aboutModalAyuda.classList.remove('flex'); 
        });

        window.addEventListener('click', function(event) {
            if (event.target === aboutModalAyuda) {
                aboutModalAyuda.classList.add('hidden');
                aboutModalAyuda.classList.remove('flex');
            }
        });
    </script>

    @endcan
</x-app-layout>