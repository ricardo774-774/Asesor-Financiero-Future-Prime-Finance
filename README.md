<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 💰 FinanzasPro - Tu Asesor Financiero Personal

FinanzasPro es una aplicación web desarrollada en Laravel que funciona como tu asesor financiero personal avanzado. Diseñada para ayudarte a gestionar, analizar y optimizar tus finanzas personales de manera inteligente, comparativa y predictiva.

## ✨ Características Principales

### 📊 **Gestión Financiera Completa**
- **Ingresos**: Registro de ingresos fijos (salarios) y variables (comisiones, bonos)
- **Gastos**: Control de gastos por categorías (vivienda, alimentación, entretenimiento, etc.)
- **Saldo**: Visualización en tiempo real de tu balance financiero con historial detallado

### 🎯 **Metas Financieras Inteligentes**
- Establecimiento de objetivos financieros con fechas límite específicas
- Cálculo automático del ahorro diario y mensual necesario
- Seguimiento del progreso hacia tus metas con predicciones IA
- Registro diario personalizado con validaciones avanzadas

### 🔬 **Análisis Financiero Avanzado**
#### 📈 **Comparación con Promedios Nacionales**
- **Benchmarking por demografía**: Compara tus finanzas con promedios nacionales por edad y región
- **5 regiones de México**: Norte, Centro, Bajío, Sur, Sureste
- **6 rangos de edad**: 18-25, 26-35, 36-45, 46-55, 56-65, 65+ años
- **Análisis de ingresos**: Evaluación de tu posición vs. promedio nacional
- **Capacidad de ahorro**: Comparación de tu tasa de ahorro con estándares nacionales
- **Recomendaciones personalizadas**: Consejos específicos basados en tu perfil demográfico

#### 🚨 **Simulador de Crisis Financiera**
- **4 tipos de crisis**: Pérdida de empleo, emergencia médica, crisis económica, emergencia familiar
- **Duración configurable**: 1, 3, 6 o 12 meses
- **Reducción de ingresos**: 25%, 50%, 75% o 100% (pérdida total)
- **Análisis de supervivencia**: Cálculo de tiempo de resistencia con ahorros actuales
- **Déficit proyectado**: Estimación del impacto financiero total
- **Fondo de emergencia**: Recomendaciones de ahorro preventivo
- **Plan de acción**: Estrategias específicas según nivel de riesgo

### 🤖 **Inteligencia Artificial Mejorada**
- **Predicciones precisas**: Algoritmos mejorados con validación de resultados
- **Formateo inteligente**: Valores redondeados a 2 decimales máximo
- **Cálculo de ahorro mínimo**: Cuando la IA detecta valores negativos, calcula automáticamente el ahorro mínimo necesario
- **Análisis de viabilidad**: Evaluación realista de probabilidad de éxito de metas

### 🔐 **Seguridad Avanzada**
- Autenticación de dos factores (2FA) con Google Authenticator
- Protección de datos financieros sensibles
- Sesiones seguras y encriptación de datos

### 📱 **Experiencia de Usuario Premium**
- Interfaz moderna con paleta corporativa azul profesional
- Dashboard visual con gráficos interactivos
- Generación de reportes financieros en PDF
- Tutoriales integrados para cada funcionalidad
- Responsive design para todos los dispositivos

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

### 4. Configuración de la API de IA
```bash
# En el archivo .env, configurar:
API_URL=http://localhost:5000/suggest_savings
```

### 5. Compilar assets
```bash
npm run build
```

### 6. Iniciar el servidor
```bash
php artisan serve
```

### 7. Iniciar API de Python (opcional)
```bash
cd API_Titulacion
python app.py
```

## 📈 Flujo de Uso Actualizado

### **Configuración Inicial**
1. **Registro y seguridad** - Crea tu cuenta y habilita 2FA
2. **Configuración financiera** - Registra tus ingresos y gastos por categorías

### **Metas Financieras**
3. **Establecimiento de metas** - Define objetivos específicos con fechas
4. **Registro diario** - Mantén un historial con saldo y fecha personalizados
5. **Predicción IA** - Obtén cálculos precisos de ahorro necesario

### **Análisis Financiero Avanzado** 
6. **Perfil demográfico** - Completa edad, región, ingresos y gastos
7. **Comparación nacional** - Analiza tu posición vs. promedios mexicanos
8. **Simulación de crisis** - Evalúa tu resistencia ante diferentes escenarios
9. **Planificación preventiva** - Implementa recomendaciones de fondos de emergencia

## 🆕 Nuevas Funcionalidades Destacadas

### **🎯 Diferenciación Clara**
- **Metas Financieras**: Enfocado en planificación y seguimiento de objetivos específicos
- **Análisis Financiero**: Orientado a diagnóstico, comparación y preparación ante crisis

### **📊 Datos Nacionales Integrados**
- Base de datos con promedios reales por región y edad
- Algoritmos de comparación automática
- Recomendaciones contextualizadas para México

### **🛡️ Preparación ante Crisis**
- Simulaciones realistas de diferentes tipos de emergencias
- Cálculos precisos de tiempo de supervivencia
- Estrategias preventivas personalizadas

## 🔧 Tecnologías Utilizadas

- **Backend**: Laravel 11.x con controladores optimizados
- **Frontend**: Blade Templates, TailwindCSS con paleta corporativa
- **Base de datos**: MySQL/SQLite con nuevas validaciones
- **IA/ML**: API Python con Flask y scikit-learn
- **Seguridad**: Laravel Breeze, Google2FA
- **Análisis**: Algoritmos de comparación demográfica
- **PDF**: DomPDF para reportes

## 📚 Documentación Adicional

- [Guía de Análisis Financiero Avanzado](docs/ANALISIS_FINANCIERO.md)
- [Tutorial de Comparación Nacional](docs/COMPARACION_NACIONAL.md)
- [Manual del Simulador de Crisis](docs/SIMULADOR_CRISIS.md)
- [API de Inteligencia Artificial](docs/API_IA.md)

---

**FinanzasPro** - Revolucionando la gestión financiera personal con análisis avanzado, comparaciones nacionales y preparación inteligente ante crisis financieras.

*Versión 2.0 - Análisis Financiero Avanzado*

