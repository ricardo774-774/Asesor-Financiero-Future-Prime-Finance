<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Verificación de Seguridad</h2>
        <p class="text-gray-600 text-sm mt-2">Introduce el código de tu aplicación de autenticación</p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            @foreach($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- Verification Form -->
    <form method="POST" action="{{ route('two-factor.validate') }}">
        @csrf
        
        <div class="mb-6">
            <label for="verification_code" class="block font-medium text-sm text-gray-700 mb-2">
                Código de 6 dígitos
            </label>
            <input id="verification_code" 
                   type="text" 
                   name="verification_code" 
                   class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-center text-2xl font-mono letter-spacing-wide"
                   placeholder="000000"
                   maxlength="6"
                   autocomplete="off"
                   autofocus
                   required>
            <p class="text-xs text-gray-500 mt-2">Abre Google Authenticator y usa el código generado para esta aplicación</p>
        </div>

        <div class="flex items-center justify-between mb-6">
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Verificar Código
            </button>
        </div>
    </form>

    <!-- Help Section -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h3 class="font-semibold text-gray-800 text-sm mb-2">¿Necesitas ayuda?</h3>
        <ul class="text-xs text-gray-600 space-y-1">
            <li>• Asegúrate de que el reloj de tu dispositivo esté sincronizado</li>
            <li>• El código cambia cada 30 segundos</li>
            <li>• Si tienes problemas, contacta al administrador</li>
        </ul>
    </div>

    <!-- Back to Login -->
    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" 
           class="text-sm text-blue-600 hover:text-blue-800 transition duration-200">
            ← Volver al inicio de sesión
        </a>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('verification_code');
        
        // Auto-format and restrict to numbers only
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 6) {
                value = value.slice(0, 6);
            }
            e.target.value = value;
            
            // Auto-submit when 6 digits are entered
            if (value.length === 6) {
                // Add a small delay to let user see the complete code
                setTimeout(() => {
                    e.target.closest('form').submit();
                }, 300);
            }
        });
        
        // Handle paste
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            let paste = (e.clipboardData || window.clipboardData).getData('text');
            let value = paste.replace(/\D/g, '').slice(0, 6);
            this.value = value;
            
            if (value.length === 6) {
                setTimeout(() => {
                    this.closest('form').submit();
                }, 300);
            }
        });
    });
    </script>
</x-guest-layout> 