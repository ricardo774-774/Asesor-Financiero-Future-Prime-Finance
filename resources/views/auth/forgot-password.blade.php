<x-guest-layout>
    <!-- Título de la página -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Recuperar Contraseña</h1>
        <p class="text-gray-600">Te enviaremos un enlace para restablecer tu contraseña</p>
    </div>

    <!-- Descripción -->
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-gray-700 leading-relaxed">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente ingresa tu dirección de correo electrónico y te enviaremos un enlace de restablecimiento de contraseña que te permitirá elegir una nueva.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-800 font-semibold text-sm mb-2" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <x-text-input id="email" 
                             class="block w-full pl-10 pr-3 py-3 border-slate-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 focus:ring-2 transition duration-200 bg-gray-50 focus:bg-white" 
                             type="email" 
                             name="email" 
                             :value="old('email')" 
                             required 
                             autofocus
                             placeholder="tu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Botones -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center bg-blue-800 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:ring-blue-500 py-3 px-4 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
                {{ __('Enviar Enlace de Restablecimiento') }}
            </x-primary-button>

            <!-- Divisor -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">¿Recordaste tu contraseña?</span>
                </div>
            </div>

            <!-- Enlace a login -->
            <a href="{{ route('login') }}" 
               class="w-full inline-flex justify-center items-center py-3 px-4 border-2 border-green-600 rounded-lg text-green-600 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-semibold transition-all duration-200 hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Regresar al Login
            </a>
        </div>
    </form>

    <!-- Footer informativo -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="grid grid-cols-2 gap-4 text-center">
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Enlace Seguro</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Respuesta Rápida</p>
            </div>
        </div>
    </div>
</x-guest-layout>
