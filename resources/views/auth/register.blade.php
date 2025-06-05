<x-guest-layout>
    <!-- Título de la página -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Crear Nueva Cuenta</h1>
        <p class="text-gray-600">Únete a Finanzas Pro y comienza tu viaje financiero</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre Completo')" class="text-gray-800 font-semibold text-sm mb-2" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input id="name" 
                             class="block w-full pl-10 pr-3 py-3 border-slate-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 focus:ring-2 transition duration-200 bg-gray-50 focus:bg-white" 
                             type="text" 
                             name="name" 
                             :value="old('name')" 
                             required 
                             autofocus 
                             autocomplete="name"
                             placeholder="Tu nombre completo" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                             autocomplete="username"
                             placeholder="tu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

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
                             autocomplete="new-password"
                             placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-gray-800 font-semibold text-sm mb-2" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation" 
                             class="block w-full pl-10 pr-3 py-3 border-slate-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 focus:ring-2 transition duration-200 bg-gray-50 focus:bg-white"
                             type="password"
                             name="password_confirmation" 
                             required 
                             autocomplete="new-password"
                             placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Términos y Condiciones -->
        <div class="bg-gradient-to-r from-slate-50 to-blue-50 border border-slate-200 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <div class="flex items-center h-5 mt-1">
                    <input id="terms" 
                           type="checkbox" 
                           name="terms" 
                           class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-2 w-4 h-4" 
                           required>
                </div>
                <div class="text-sm">
                    <label for="terms" class="text-gray-700 font-medium">
                        Acepto los 
                        <a href="#" id="openTermsModal" class="text-blue-600 hover:text-blue-800 underline font-semibold transition duration-300">
                            Términos y Condiciones
                        </a>
                        y la 
                        <a href="#" id="openPrivacyModal" class="text-blue-600 hover:text-blue-800 underline font-semibold transition duration-300">
                            Política de Privacidad
                        </a>
                        de Finanzas Pro
                    </label>
                    <p class="text-xs text-gray-600 mt-1">
                        Al registrarte, confirmas que has leído y aceptas nuestros términos de servicio y políticas de protección de datos.
                    </p>
                </div>
            </div>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>

        <!-- Botones -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center bg-blue-800 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:ring-blue-500 py-3 px-4 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                </svg>
                {{ __('Crear Cuenta') }}
            </x-primary-button>

            <!-- Divisor -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">o regístrate con</span>
                </div>
            </div>

            <!-- Botón de Google OAuth -->
            <a href="{{ route('auth.google') }}" 
               class="w-full inline-flex justify-center items-center py-3 px-4 border-2 border-red-500 rounded-lg text-red-600 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 font-semibold transition-all duration-200 hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Registrarse con Google
            </a>

            <!-- Divisor -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">¿Ya tienes cuenta?</span>
                </div>
            </div>

            <!-- Enlace a login -->
            <a href="{{ route('login') }}" 
               class="w-full inline-flex justify-center items-center py-3 px-4 border-2 border-green-600 rounded-lg text-green-600 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-semibold transition-all duration-200 hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Iniciar Sesión
            </a>
        </div>
    </form>

    <!-- Footer informativo -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="grid grid-cols-3 gap-4 text-center">
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Datos Seguros</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Verificado</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-purple-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Confiable</p>
            </div>
        </div>
    </div>

    <!-- Modal Términos y Condiciones -->
    <div id="termsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 max-w-4xl mx-auto max-h-[90vh] overflow-y-auto border border-slate-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Términos y Condiciones</h2>
                <button id="closeTermsModal" class="text-gray-400 hover:text-gray-600 transition duration-300">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="space-y-6 text-gray-700">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Finanzas Pro - Plataforma de Asesoría Financiera</h3>
                    <p class="text-sm text-blue-700">Effective Date: {{ date('d/m/Y') }}</p>
                </div>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">1. Marco Legal y Cumplimiento Regulatorio</h3>
                    <div class="space-y-3 text-justify">
                        <p>
                            <strong>Conforme al artículo 48 de la Ley para Regular las Instituciones de Tecnología Financiera</strong>, 
                            Finanzas Pro garantiza la <span class="font-semibold text-blue-700">confidencialidad, integridad y disponibilidad</span> 
                            de toda la información financiera de nuestros usuarios (Congreso de los Estados Unidos Mexicanos, 2018).
                        </p>
                        <p>
                            <strong>De acuerdo con el artículo 49</strong>, nuestra plataforma cumple obligatoriamente con la 
                            <span class="font-semibold text-blue-700">Ley Federal de Protección de Datos Personales en Posesión de los Particulares</span>, 
                            asegurando el tratamiento adecuado y protección de sus datos personales.
                        </p>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">2. Protección y Seguridad de Datos</h3>
                    <div class="space-y-3 text-justify">
                        <p>
                            Implementamos medidas técnicas y administrativas para <strong>prevenir el acceso no autorizado, 
                            destrucción, pérdida, alteración o divulgación indebida</strong> de sus datos financieros y personales.
                        </p>
                        <p>
                            La <span class="font-semibold text-blue-700">Comisión Nacional Bancaria y de Valores (CNBV)</span> 
                            está facultada para auditar y verificar el cumplimiento de estos controles de seguridad en nuestra plataforma.
                        </p>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">3. Transparencia en el Manejo de Información</h3>
                    <div class="space-y-3 text-justify">
                        <p>
                            Conforme a la legislación vigente, informamos de manera <strong>clara y accesible</strong>:
                        </p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li><strong>Qué datos recolectamos:</strong> Información financiera, datos personales de identificación, patrones de gasto e ingresos</li>
                            <li><strong>Propósito de uso:</strong> Análisis financiero personalizado, generación de metas de ahorro, predicciones de comportamiento financiero</li>
                            <li><strong>Compartición de datos:</strong> No compartimos información personal con terceros sin su consentimiento explícito</li>
                        </ul>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">4. Derechos del Usuario</h3>
                    <div class="space-y-3 text-justify">
                        <p>Como usuario de Finanzas Pro, usted tiene derecho a:</p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Acceder a sus datos personales almacenados en nuestra plataforma</li>
                            <li>Rectificar información incorrecta o incompleta</li>
                            <li>Cancelar su cuenta y solicitar la eliminación de sus datos</li>
                            <li>Oponerse al tratamiento de sus datos para fines específicos</li>
                        </ul>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">5. Responsabilidades del Usuario</h3>
                    <div class="space-y-3 text-justify">
                        <p>Al utilizar nuestra plataforma, usted se compromete a:</p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Proporcionar información veraz y actualizada</li>
                            <li>Mantener la confidencialidad de sus credenciales de acceso</li>
                            <li>Utilizar la plataforma únicamente para fines lícitos</li>
                            <li>Notificar cualquier actividad sospechosa en su cuenta</li>
                        </ul>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">6. Contacto y Soporte</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm">
                            Para ejercer sus derechos o resolver dudas sobre el tratamiento de sus datos personales, 
                            puede contactarnos a través de los canales oficiales de Finanzas Pro.
                        </p>
                    </div>
                </section>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <button id="acceptTerms" class="bg-blue-800 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-300 font-semibold">
                    Acepto los Términos
                </button>
                <button id="closeTermsModalBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg transition duration-300 font-semibold">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Política de Privacidad -->
    <div id="privacyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 max-w-4xl mx-auto max-h-[90vh] overflow-y-auto border border-slate-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Política de Privacidad</h2>
                <button id="closePrivacyModal" class="text-gray-400 hover:text-gray-600 transition duration-300">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="space-y-6 text-gray-700 text-justify">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                    <h3 class="text-lg font-semibold text-green-800 mb-2">Compromiso con la Privacidad</h3>
                    <p class="text-sm text-green-700">En Finanzas Pro, su privacidad es nuestra prioridad</p>
                </div>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Recolección de Datos</h3>
                    <p>
                        Recolectamos únicamente la información necesaria para brindar nuestros servicios de asesoría financiera, 
                        incluyendo datos de ingresos, gastos, metas financieras y información de contacto.
                    </p>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Uso de la Información</h3>
                    <p>
                        Sus datos se utilizan exclusivamente para generar análisis financieros personalizados, 
                        predicciones de ahorro y recomendaciones adaptadas a su perfil financiero.
                    </p>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Protección de Datos</h3>
                    <p>
                        Implementamos cifrado de extremo a extremo, autenticación multifactor y auditorías regulares 
                        para garantizar la máxima seguridad de su información financiera.
                    </p>
                </section>
            </div>

            <div class="mt-8 flex justify-end">
                <button id="closePrivacyModalBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg transition duration-300 font-semibold">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <script>
        // Modal Terms
        const openTermsModal = document.getElementById('openTermsModal');
        const closeTermsModal = document.getElementById('closeTermsModal');
        const closeTermsModalBtn = document.getElementById('closeTermsModalBtn');
        const termsModal = document.getElementById('termsModal');
        const acceptTerms = document.getElementById('acceptTerms');
        const termsCheckbox = document.getElementById('terms');

        // Modal Privacy
        const openPrivacyModal = document.getElementById('openPrivacyModal');
        const closePrivacyModal = document.getElementById('closePrivacyModal');
        const closePrivacyModalBtn = document.getElementById('closePrivacyModalBtn');
        const privacyModal = document.getElementById('privacyModal');

        // Open Terms Modal
        openTermsModal.addEventListener('click', function(event) {
            event.preventDefault();
            termsModal.classList.remove('hidden');
        });

        // Close Terms Modal
        [closeTermsModal, closeTermsModalBtn].forEach(btn => {
            btn.addEventListener('click', function() {
                termsModal.classList.add('hidden');
            });
        });

        // Accept Terms
        acceptTerms.addEventListener('click', function() {
            termsCheckbox.checked = true;
            termsModal.classList.add('hidden');
        });

        // Open Privacy Modal
        openPrivacyModal.addEventListener('click', function(event) {
            event.preventDefault();
            privacyModal.classList.remove('hidden');
        });

        // Close Privacy Modal
        [closePrivacyModal, closePrivacyModalBtn].forEach(btn => {
            btn.addEventListener('click', function() {
                privacyModal.classList.add('hidden');
            });
        });

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === termsModal) {
                termsModal.classList.add('hidden');
            }
            if (event.target === privacyModal) {
                privacyModal.classList.add('hidden');
            }
        });
    </script>
</x-guest-layout>
