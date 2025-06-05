<x-guest-layout>
    <!-- Título de la página -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Confirmar Contraseña</h1>
        <p class="text-gray-600">Confirma tu contraseña para continuar de forma segura</p>
    </div>

    <!-- Descripción -->
    <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-amber-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-700">
                    {{ __('Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.') }}
                </p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-800 font-semibold text-sm mb-2" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input id="password" 
                             class="block w-full pl-10 pr-3 py-3 border-slate-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 focus:ring-2 transition duration-200 bg-gray-50 focus:bg-white"
                             type="password"
                             name="password"
                             required 
                             autocomplete="current-password"
                             placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Botón -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center bg-blue-800 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:ring-blue-500 py-3 px-4 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                {{ __('Confirmar Contraseña') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Footer informativo -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="grid grid-cols-2 gap-4 text-center">
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Área Protegida</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Acceso Seguro</p>
            </div>
        </div>
    </div>
</x-guest-layout>
