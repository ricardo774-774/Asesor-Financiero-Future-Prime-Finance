<x-guest-layout>
    <!-- Título de la página -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Bienvenido de vuelta</h1>
        <p class="text-gray-600">Accede a tu asesor financiero personal</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
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
                             autocomplete="current-password"
                             placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Captcha Section -->
        <div class="bg-gradient-to-r from-blue-50 to-slate-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <x-input-label for="captcha" :value="__('Verificación de Seguridad')" class="text-gray-800 font-semibold text-sm mb-1" />
                        <p class="text-xs text-gray-600">Resuelve la operación para continuar</p>
                    </div>
                </div>
                <button type="button" onclick="generateCaptcha()" class="text-blue-600 hover:text-blue-800 transition duration-200" title="Generar nueva operación">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            
            <div class="mt-3 flex items-center space-x-3">
                <div id="captcha-display" class="bg-white border border-slate-300 rounded-lg px-4 py-3 text-lg font-bold text-gray-800 min-w-0 flex-1 text-center shadow-sm">
                    <!-- La operación se generará aquí -->
                </div>
                <div class="flex items-center">
                    <span class="text-lg font-semibold text-gray-700">=</span>
                </div>
                <div class="relative flex-1">
                    <input type="number" 
                           id="captcha" 
                           name="captcha_answer"
                           class="block w-full py-3 px-4 border-slate-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 focus:ring-2 transition duration-200 bg-white text-center text-lg font-semibold" 
                           placeholder="?" 
                           required>
                    <input type="hidden" id="captcha_result" name="captcha_result" value="">
                </div>
            </div>
            <x-input-error :messages="$errors->get('captcha_answer')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-2 w-4 h-4" 
                       name="remember">
                <span class="ml-2 text-sm text-gray-600 font-medium">{{ __('Recordarme') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 font-medium underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300" 
                   href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif
        </div>

        <!-- Botón de login -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center bg-blue-800 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:ring-blue-500 py-3 px-4 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                {{ __('Iniciar Sesión') }}
            </x-primary-button>

            <!-- Divisor -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">o continúa con</span>
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
                Continuar con Google
            </a>

            <!-- Divisor -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">¿No tienes cuenta?</span>
                </div>
            </div>

            <!-- Enlace a registro -->
            <a href="{{ route('register') }}" 
               class="w-full inline-flex justify-center items-center py-3 px-4 border-2 border-green-600 rounded-lg text-green-600 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-semibold transition-all duration-200 hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                </svg>
                Crear Nueva Cuenta
            </a>
        </div>
    </form>

    <!-- Términos y Condiciones Link -->
    <div class="mt-6 text-center">
        <p class="text-xs text-gray-600">
            Al acceder a la plataforma, aceptas nuestros 
            <a href="#" id="loginTermsModal" class="text-blue-600 hover:text-blue-800 underline font-medium transition duration-300">
                Términos y Condiciones
            </a>
            y 
            <a href="#" id="loginPrivacyModal" class="text-blue-600 hover:text-blue-800 underline font-medium transition duration-300">
                Política de Privacidad
            </a>
        </p>
    </div>

    <!-- Footer informativo -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="grid grid-cols-3 gap-4 text-center">
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Acceso Seguro</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Protegido</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-orange-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-xs text-gray-600 font-medium">Anti-Robots</p>
            </div>
        </div>
    </div>

    <br>

    <!-- Modal Términos y Condiciones -->
    <div id="loginTermsModalDiv" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 max-w-4xl mx-auto max-h-[90vh] overflow-y-auto border border-slate-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Términos y Condiciones</h2>
                <button id="closeLoginTermsModal" class="text-gray-400 hover:text-gray-600 transition duration-300">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="space-y-6 text-gray-700">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Finanzas Pro - Plataforma de Asesoría Financiera</h3>
                    <p class="text-sm text-blue-700">Fecha de vigencia: {{ date('d/m/Y') }}</p>
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
            </div>

            <div class="mt-8 flex justify-end">
                <button id="closeLoginTermsModalBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg transition duration-300 font-semibold">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Política de Privacidad -->
    <div id="loginPrivacyModalDiv" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 max-w-4xl mx-auto max-h-[90vh] overflow-y-auto border border-slate-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Política de Privacidad</h2>
                <button id="closeLoginPrivacyModal" class="text-gray-400 hover:text-gray-600 transition duration-300">
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
                        incluyendo datos de ingresos, gastos, metas financieras e información de contacto.
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
                <button id="closeLoginPrivacyModalBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg transition duration-300 font-semibold">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <script>
        function generateCaptcha() {
            const num1 = Math.floor(Math.random() * 10) + 1;
            const num2 = Math.floor(Math.random() * 10) + 1;
            const operations = ['+', '-', '*'];
            const operation = operations[Math.floor(Math.random() * operations.length)];
            
            let result;
            let displayOperation;
            
            switch(operation) {
                case '+':
                    result = num1 + num2;
                    displayOperation = `${num1} + ${num2}`;
                    break;
                case '-':
                    // Asegurar que el resultado sea positivo
                    const larger = Math.max(num1, num2);
                    const smaller = Math.min(num1, num2);
                    result = larger - smaller;
                    displayOperation = `${larger} - ${smaller}`;
                    break;
                case '*':
                    // Usar números más pequeños para multiplicación
                    const small1 = Math.floor(Math.random() * 5) + 1;
                    const small2 = Math.floor(Math.random() * 5) + 1;
                    result = small1 * small2;
                    displayOperation = `${small1} × ${small2}`;
                    break;
            }
            
            document.getElementById('captcha-display').textContent = displayOperation;
            document.getElementById('captcha_result').value = result;
            document.getElementById('captcha').value = '';
        }

        // Generar captcha al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            generateCaptcha();
        });

        // Validar captcha antes de enviar
        document.querySelector('form').addEventListener('submit', function(e) {
            const userAnswer = parseInt(document.getElementById('captcha').value);
            const correctAnswer = parseInt(document.getElementById('captcha_result').value);
            
            if (userAnswer !== correctAnswer) {
                e.preventDefault();
                alert('La respuesta del captcha es incorrecta. Por favor, inténtalo de nuevo.');
                generateCaptcha();
                return false;
            }
        });

        // Login Terms Modal
        const loginTermsModal = document.getElementById('loginTermsModal');
        const closeLoginTermsModal = document.getElementById('closeLoginTermsModal');
        const closeLoginTermsModalBtn = document.getElementById('closeLoginTermsModalBtn'); 
        const loginTermsModalDiv = document.getElementById('loginTermsModalDiv');

        // Login Privacy Modal  
        const loginPrivacyModal = document.getElementById('loginPrivacyModal');
        const closeLoginPrivacyModal = document.getElementById('closeLoginPrivacyModal');
        const closeLoginPrivacyModalBtn = document.getElementById('closeLoginPrivacyModalBtn');
        const loginPrivacyModalDiv = document.getElementById('loginPrivacyModalDiv');

        // Open Login Terms Modal
        loginTermsModal.addEventListener('click', function(event) {
            event.preventDefault();
            loginTermsModalDiv.classList.remove('hidden');
        });

        // Close Login Terms Modal
        [closeLoginTermsModal, closeLoginTermsModalBtn].forEach(btn => {
            btn.addEventListener('click', function() {
                loginTermsModalDiv.classList.add('hidden');
            });
        });

        // Open Login Privacy Modal
        loginPrivacyModal.addEventListener('click', function(event) {
            event.preventDefault();
            loginPrivacyModalDiv.classList.remove('hidden');
        });

        // Close Login Privacy Modal
        [closeLoginPrivacyModal, closeLoginPrivacyModalBtn].forEach(btn => {
            btn.addEventListener('click', function() {
                loginPrivacyModalDiv.classList.add('hidden');
            });
        });

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === loginTermsModalDiv) {
                loginTermsModalDiv.classList.add('hidden');
            }
            if (event.target === loginPrivacyModalDiv) {
                loginPrivacyModalDiv.classList.add('hidden');
            }
        });
    </script>
</x-guest-layout>
