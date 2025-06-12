<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 💰 FinanzasPro - Tu Asesor Financiero Personal

FinanzasPro es una aplicación web desarrollada en Laravel que funciona como tu asesor financiero personal. Diseñada para ayudarte a gestionar, analizar y optimizar tus finanzas personales de manera inteligente y segura.

## ✨ Características Principales

### 📊 **Gestión Financiera Completa**
- **Ingresos**: Registro de ingresos fijos (salarios) y variables (comisiones, bonos)
- **Gastos**: Control de gastos por categorías (vivienda, alimentación, entretenimiento, etc.)
- **Saldo**: Visualización en tiempo real de tu balance financiero

### 🎯 **Metas Financieras Inteligentes**
- Establecimiento de objetivos financieros con fechas límite
- Cálculo automático del ahorro mensual necesario
- Seguimiento del progreso hacia tus metas

### 🤖 **Análisis con Inteligencia Artificial**
- Predicciones basadas en tu historial financiero
- Recomendaciones personalizadas para optimizar gastos
- Análisis de probabilidad de éxito de tus metas

### 🔐 **Seguridad Avanzada**
- Autenticación de dos factores (2FA) con Google Authenticator
- Protección de datos financieros sensibles
- Sesiones seguras y encriptación de datos

### 📱 **Experiencia de Usuario**
- Interfaz moderna y responsive
- Dashboard visual con gráficos interactivos
- Generación de reportes financieros en PDF
- Generador de ideas para metas financieras

## 🚀 Comandos para levantar el proyecto

### 1. Instalación de dependencias
```bash
composer install
npm install
```

### 2. Configuración del entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configuración de base de datos
```bash
php artisan migrate
php artisan db:seed
```

### 4. Compilar assets
```bash
npm run build
```

### 5. Iniciar el servidor
```bash
php artisan serve
```

## 📈 Flujo de Uso

1. **Registro y configuración** - Crea tu cuenta y habilita 2FA para mayor seguridad
2. **Configuración financiera** - Registra tus ingresos y gastos por categorías
3. **Establecimiento de metas** - Define objetivos financieros específicos
4. **Análisis inteligente** - Utiliza la IA para obtener recomendaciones personalizadas
5. **Seguimiento diario** - Mantén un registro constante para análisis precisos

## 🔧 Tecnologías Utilizadas

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates, TailwindCSS
- **Base de datos**: MySQL/SQLite
- **Seguridad**: Laravel Breeze, Google2FA
- **Gráficos**: Chart.js
- **PDF**: DomPDF

---

**FinanzasPro** - Transformando la manera en que gestionas tu dinero, una decisión inteligente a la vez.

