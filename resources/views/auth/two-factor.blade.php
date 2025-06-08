@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">AUTENTICACIÓN DE DOS FACTORES</h1>
                    <p class="text-blue-100 mt-2">Protege tu cuenta con una capa adicional de seguridad</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            
            <!-- Status Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-8">
                
                <!-- Setup Instructions -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Configuración de Seguridad</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">1</div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Descarga Google Authenticator</h3>
                                <p class="text-gray-600 text-sm">Instala la app desde Google Play Store o App Store</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">2</div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Escanea el código QR</h3>
                                <p class="text-gray-600 text-sm">Usa la app para escanear el código de la derecha</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">3</div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Ingresa el código</h3>
                                <p class="text-gray-600 text-sm">Introduce el código de 6 dígitos para activar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Current Status -->
                    <div class="mt-6 p-4 border rounded-lg {{ $is_enabled ? 'bg-green-50 border-green-200' : 'bg-yellow-50 border-yellow-200' }}">
                        <div class="flex items-center">
                            @if($is_enabled)
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold text-green-800">2FA Habilitado</span>
                            @else
                                <svg class="w-5 h-5 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold text-yellow-800">2FA Deshabilitado</span>
                            @endif
                        </div>
                        <p class="text-sm {{ $is_enabled ? 'text-green-700' : 'text-yellow-700' }} mt-1">
                            @if($is_enabled)
                                Tu cuenta está protegida con autenticación de dos factores.
                            @else
                                Configura 2FA para mayor seguridad en tu cuenta.
                            @endif
                        </p>
                    </div>
                </div>

                <!-- QR Code and Forms -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    @if(!$is_enabled)
                        <!-- QR Code Display -->
                        <div class="text-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Código QR</h3>
                            <div class="bg-gray-50 p-6 rounded-lg inline-block">
                                <img src="{{ $qrCodeImageUrl }}" alt="QR Code" class="mx-auto">
                            </div>
                            <div class="mt-4 p-3 bg-gray-100 rounded">
                                <p class="text-sm text-gray-600 mb-1">Clave manual (si no puedes escanear):</p>
                                <code class="text-xs bg-white px-2 py-1 rounded break-all">{{ $secret }}</code>
                            </div>
                        </div>

                        <!-- Enable 2FA Form -->
                        <form method="POST" action="{{ route('two-factor.enable') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="verification_code" class="block text-sm font-medium text-gray-700 mb-2">
                                    Código de verificación
                                </label>
                                <input type="text" 
                                       id="verification_code" 
                                       name="verification_code" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center text-lg font-mono"
                                       placeholder="123456"
                                       maxlength="6"
                                       required>
                            </div>
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Habilitar 2FA
                            </button>
                        </form>
                    @else
                        <!-- Disable 2FA Form -->
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2FA Activo</h3>
                            <p class="text-gray-600 mb-6">Tu cuenta está protegida con autenticación de dos factores.</p>
                        </div>

                        <form method="POST" action="{{ route('two-factor.disable') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="verification_code" class="block text-sm font-medium text-gray-700 mb-2">
                                    Código de verificación para deshabilitar
                                </label>
                                <input type="text" 
                                       id="verification_code" 
                                       name="verification_code" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-center text-lg font-mono"
                                       placeholder="123456"
                                       maxlength="6"
                                       required>
                            </div>
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Deshabilitar 2FA
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Security Note -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-600 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-blue-800 mb-2">Importante</h3>
                        <ul class="text-blue-700 text-sm space-y-1">
                            <li>• Guarda tu clave secreta en un lugar seguro como respaldo</li>
                            <li>• Si pierdes acceso a tu dispositivo, contacta al administrador</li>
                            <li>• 2FA es opcional pero altamente recomendado para mayor seguridad</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-format verification code input
document.addEventListener('DOMContentLoaded', function() {
    const verificationInputs = document.querySelectorAll('input[name="verification_code"]');
    verificationInputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });
    });
});
</script>
@endsection 