# 🔐 Configuración de Google OAuth para Finanzas Pro

Este documento te guiará paso a paso para configurar la autenticación con Google en la aplicación **Finanzas Pro**.

## 📋 Prerequisitos

- Tener una cuenta de Google
- Acceso a la [Google Cloud Console](https://console.cloud.google.com/)
- Laravel Socialite instalado (ya incluido en el proyecto)

## 🚀 Pasos de Configuración

### 1. Configurar Google Cloud Console

1. **Ir a Google Cloud Console**
   - Navega a [https://console.cloud.google.com/](https://console.cloud.google.com/)
   - Inicia sesión con tu cuenta de Google

2. **Crear un Proyecto (si no tienes uno)**
   - Haz clic en "Seleccionar proyecto" en la parte superior
   - Clic en "Nuevo proyecto"
   - Nombra tu proyecto: `finanzas-pro-oauth`
   - Haz clic en "Crear"

3. **Habilitar APIs necesarias**
   - Ve a "APIs y servicios" → "Biblioteca"
   - Busca "Google+ API" o "Google Sign-In API"
   - Haz clic en "Habilitar"

### 2. Crear Credenciales OAuth 2.0

1. **Ir a Credenciales**
   - Ve a "APIs y servicios" → "Credenciales"
   - Haz clic en "Crear credenciales"
   - Selecciona "ID de cliente OAuth 2.0"

2. **Configurar la Pantalla de Consentimiento (si es necesario)**
   - Si aparece un mensaje, ve a "Pantalla de consentimiento OAuth"
   - Selecciona "Externo" para usuarios fuera de tu organización
   - Completa la información requerida:
     - Nombre de la aplicación: `Finanzas Pro`
     - Correo de soporte: tu email
     - Dominio de la aplicación: `localhost` (para desarrollo)

3. **Configurar el Cliente OAuth**
   - Tipo de aplicación: "Aplicación web"
   - Nombre: `Finanzas Pro Web Client`
   
   **Orígenes de JavaScript autorizados:**
   ```
   http://localhost:8000
   http://127.0.0.1:8000
   ```
   
   **URIs de redireccionamiento autorizados:**
   ```
   http://localhost:8000/auth/google/callback
   http://127.0.0.1:8000/auth/google/callback
   ```

4. **Guardar y Obtener Credenciales**
   - Haz clic en "Crear"
   - Copia el **Client ID** y **Client Secret**

### 3. Configurar el Archivo .env

Crea o actualiza tu archivo `.env` con las siguientes variables:

```env
# Configuración básica de la aplicación
APP_NAME="FINANZAS PRO"
APP_ENV=local
APP_KEY=base64:tu_app_key_aqui
APP_DEBUG=true
APP_URL=http://localhost:8000

# Configuración de base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finanzas_pro_db
DB_USERNAME=root
DB_PASSWORD=

# Configuración de Google OAuth
GOOGLE_CLIENT_ID=tu_google_client_id_aqui
GOOGLE_CLIENT_SECRET=tu_google_client_secret_aqui
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 4. Comandos de Instalación

Si aún no tienes el proyecto configurado, ejecuta:

```bash
# Instalar dependencias
composer install
npm install

# Generar clave de aplicación (si no tienes una)
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders (para datos de prueba)
php artisan db:seed

# Compilar assets
npm run dev

# Iniciar servidor de desarrollo
php artisan serve
```

### 5. Verificar la Configuración

1. **Probar la Autenticación**
   - Ve a `http://localhost:8000/login`
   - Deberías ver el botón "Continuar con Google"
   - Haz clic y verifica que te redirija a Google

2. **Verificar Callback**
   - Después de autorizar en Google, deberías ser redirigido de vuelta a tu aplicación
   - Si todo está correcto, serás logged in automáticamente

## 🔒 Configuración para Producción

Para un entorno de producción, actualiza las siguientes configuraciones:

### 1. En Google Cloud Console:
```
Orígenes autorizados:
https://tudominio.com

URIs de redireccionamiento:
https://tudominio.com/auth/google/callback
```

### 2. En el archivo .env de producción:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

GOOGLE_REDIRECT_URI=https://tudominio.com/auth/google/callback
```

## 🛠️ Troubleshooting

### Error: "redirect_uri_mismatch"
- Verifica que la URL de callback en Google Console coincida exactamente con la de tu aplicación
- Asegúrate de incluir el protocolo (http/https)

### Error: "invalid_client"
- Verifica que el GOOGLE_CLIENT_ID y GOOGLE_CLIENT_SECRET sean correctos
- Asegúrate de que no haya espacios en blanco en las variables de entorno

### Error: "access_denied"
- El usuario canceló el proceso de autenticación
- Esto es normal y esperado si el usuario no desea autorizar la aplicación

## 📞 Soporte

Si encuentras problemas durante la configuración:

1. Verifica que todas las variables de entorno estén configuradas correctamente
2. Asegúrate de que las URLs coincidan exactamente
3. Revisa los logs de Laravel: `tail -f storage/logs/laravel.log`

## 🔐 Seguridad

- **Nunca** compartas tus credenciales de Google OAuth en repositorios públicos
- Usa variables de entorno para todas las credenciales sensibles
- En producción, configura HTTPS obligatorio
- Considera implementar rate limiting en las rutas de OAuth

---

¡Listo! Ahora tu aplicación **Finanzas Pro** soporta autenticación con Google OAuth. 🚀 