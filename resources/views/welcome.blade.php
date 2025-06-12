<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FINANZAS PRO</title>
    <link rel="icon" href="{{ asset('lofo-v2.png') }}" type="image/x-icon">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>

    <!-- Estilos personalizados -->
    <style>
        .button-inicio {
            padding: 14px 28px;
            font-size: 1.1rem;
            color: #ffffff;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 600;
            border: 2px solid transparent;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 4px 18px rgba(30, 64, 175, 0.4);
        }
        .button-inicio:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 24px rgba(30, 64, 175, 0.6);
        }

        .glass-effect {
            backdrop-filter: blur(25px);
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .hero-container {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.95), rgba(59, 130, 246, 0.85));
            backdrop-filter: blur(10px);
        }

        .auth-container {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.95), rgba(51, 65, 85, 0.90));
            backdrop-filter: blur(15px);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-container {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.98), rgba(59, 130, 246, 0.92));
            backdrop-filter: blur(12px);
            color: #f8fafc;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: fade-in 1s ease-in-out;
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .gradient-text {
            background: linear-gradient(135deg, #60a5fa, #1e3a8a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .text-blue-100,
        .text-blue-200 {
            color: #f1f5f9 !important; /* reemplazo sutil para mejor legibilidad */
        }
    </style>
</head>

<body class="min-h-screen bg-fixed bg-center bg-no-repeat bg-cover text-white" style="background-image: url('{{asset('money-fond.png')}}');">
    
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/30 via-slate-900/50 to-blue-800/30 backdrop-blur-sm"></div>
    
    <!-- Overlay de gradiente -->
    
    <div class="relative min-h-screen flex flex-col lg:flex-row items-center justify-center px-4 py-8">
        
        <!-- Sección Hero - Presentación -->
        <div class="hero-container rounded-2xl p-8 lg:p-12 max-w-2xl mx-4 lg:mx-0 lg:mr-8 mb-8 lg:mb-0 shadow-2xl border border-blue-400/30 floating-animation">
            <div class="text-center lg:text-left">
                <div class="mb-6">
                    <h1 class="text-4xl lg:text-6xl font-bold leading-tight mb-4 text-white drop-shadow-lg">
                        Bienvenidos a 
                        <span class="gradient-text block lg:inline">Finanzas Pro</span>
                    </h1>
                </div>
                
                <div class="space-y-4">
                    <p class="text-lg lg:text-xl leading-relaxed text-blue-100 font-medium">
                        En Finanzas Pro, estamos dedicados a ayudarte a alcanzar tus metas financieras.
                    </p>
                    <p class="text-base lg:text-lg leading-relaxed text-blue-200">
                        Ya sea que estés buscando ahorrar para el futuro, invertir sabiamente o simplemente manejar mejor tu dinero, estamos aquí para ofrecerte las herramientas y el conocimiento que necesitas.
                    </p>
                </div>

                <!-- Características destacadas -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="glass-effect rounded-lg p-4">
                        <h3 class="text-white font-semibold mb-2">🎯 Metas Inteligentes</h3>
                        <p class="text-blue-100 text-sm">Planifica y alcanza tus objetivos financieros</p>
                    </div>
                    <div class="glass-effect rounded-lg p-4">
                        <h3 class="text-white font-semibold mb-2">📊 Análisis Avanzado</h3>
                        <p class="text-blue-100 text-sm">Visualiza tu progreso con gráficos detallados</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sección de Autenticación -->
        <div class="auth-container rounded-2xl p-8 lg:p-10 max-w-md w-full mx-4 shadow-2xl border border-slate-600/50">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white mb-2">Comienza Ahora</h2>
                <p class="text-slate-300">Accede a tu asesor financiero personal</p>
            </div>

            <div class="space-y-6">
                <!-- Iniciar Sesión -->
                <div class="bg-white/10 rounded-xl p-6 border border-white/20">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold text-white mb-3">¿Ya tienes una cuenta?</h3>
                        <p class="text-slate-300 text-sm mb-4">Accede a tu dashboard personalizado</p>
                        <a href="{{ route('login') }}" class="button-inicio bg-blue-800 hover:bg-blue-700 inline-block w-full text-center">
                            Iniciar Sesión
                        </a>
                    </div>
                </div>

                <!-- Divisor -->
                <div class="flex items-center">
                    <div class="flex-1 border-t border-slate-500"></div>
                    <span class="px-4 text-slate-400 text-sm">o</span>
                    <div class="flex-1 border-t border-slate-500"></div>
                </div>

                <!-- Registro -->
                <div class="bg-white/10 rounded-xl p-6 border border-white/20">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold text-white mb-3">¿Nuevo aquí?</h3>
                        <p class="text-slate-300 text-sm mb-4">Crea tu cuenta y comienza tu viaje financiero</p>
                        <a href="{{ route('register') }}" class="button-inicio bg-green-600 hover:bg-green-500 inline-block w-full text-center">
                            Crear Cuenta
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer de características -->
            <div class="mt-8 pt-6 border-t border-slate-600">
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <div class="text-2xl mb-1">🔒</div>
                        <p class="text-slate-300 text-xs">100% Seguro</p>
                    </div>
                    <div>
                        <div class="text-2xl mb-1">⚡</div>
                        <p class="text-slate-300 text-xs">Acceso Rápido</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Términos y Condiciones Note -->
    <div class="fixed bottom-4 left-4 right-4 z-10">
        <div class="max-w-md mx-auto bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-white/20 p-3">
            <p class="text-xs text-gray-600 text-center">
                Al usar esta plataforma, aceptas los 
                <a href="#" onclick="showTermsInfo()" class="text-blue-600 hover:text-blue-800 underline font-medium">
                    Términos y Condiciones
                </a>
                conforme a la normativa mexicana de fintech
            </p>
        </div>
    </div>

    <script>
        function showTermsInfo() {
            alert('Finanzas Pro cumple con los artículos 48 y 49 de la Ley para Regular las Instituciones de Tecnología Financiera (México, 2018). Garantizamos confidencialidad, integridad y disponibilidad de tu información financiera bajo supervisión de la CNBV.');
        }
    </script>

</body>
</html>