<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            {{ __('ASESOR FINANCIERO') }}
        </h2>
    </x-slot>

    @can('gasto.index')
    <div class="py-12 bg-gradient-to-b from-gray-100 to-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-md overflow-hidden shadow-sm sm:rounded-lg h-screen flex justify-center items-center">
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
    @endcan
</x-app-layout>
