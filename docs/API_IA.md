# 🤖 API de Inteligencia Artificial - Documentación Técnica

## 📋 Índice
1. [Introducción](#introducción)
2. [Mejoras Implementadas](#mejoras-implementadas)
3. [Validación y Formateo](#validación-y-formateo)
4. [Endpoints y Métodos](#endpoints-y-métodos)
5. [Casos de Uso](#casos-de-uso)
6. [Troubleshooting](#troubleshooting)

---

## 🎯 Introducción

La **API de Inteligencia Artificial** de Future Prime Finance ha sido completamente renovada para proporcionar predicciones más precisas, validación inteligente de resultados y formateo consistente de datos financieros.

### 🆕 Características Principales v2.0

- **Validación inteligente**: Detección automática de valores negativos o inconsistentes
- **Formateo preciso**: Todos los valores redondeados a máximo 2 decimales
- **Cálculo de ahorro mínimo**: Cuando la IA detecta imposibilidad, calcula automáticamente el ahorro mínimo necesario
- **Manejo de errores robusto**: Timeout configurables y manejo de excepciones
- **Compatibilidad dual**: Funciona tanto para Metas Financieras como Análisis Financiero

---

## 🔧 Mejoras Implementadas

### **1. Método de Validación y Formateo**

#### **Función: `validateAndFormatApiResponse()`**

```php
private function validateAndFormatApiResponse($response, $dinero_meta, $fecha_meta, $historicoapi)
{
    // Validación de estructura de respuesta
    if (!isset($response["ahorro_extra_diario_necesario"]) || 
        !isset($response["ahorro_extra_mensual_necesario"])) {
        return null;
    }

    $ahorro_diario = $response["ahorro_extra_diario_necesario"];
    $ahorro_mensual = $response["ahorro_extra_mensual_necesario"];

    // Detección de valores negativos o cero
    if ($ahorro_diario <= 0 || $ahorro_mensual <= 0) {
        // Cálculo inteligente de ahorro mínimo
        $fecha_actual = Carbon::now();
        $fecha_objetivo = Carbon::createFromFormat('d-m-Y', $fecha_meta);
        $dias_restantes = $fecha_actual->diffInDays($fecha_objetivo, false);

        if ($dias_restantes > 0) {
            $saldo_actual = $historicoapi->last()->saldo ?? 0;
            $dinero_faltante = $dinero_meta - $saldo_actual;
            
            if ($dinero_faltante > 0) {
                $ahorro_diario = $dinero_faltante / $dias_restantes;
                $ahorro_mensual = $ahorro_diario * 30;
            } else {
                $ahorro_diario = 0;
                $ahorro_mensual = 0;
            }
        }
    }

    // Formateo a 2 decimales máximo
    return [
        number_format($ahorro_diario, 2, '.', ''),
        number_format($ahorro_mensual, 2, '.', '')
    ];
}
```

### **2. Integración en Controladores**

#### **Método `store()` - Análisis Financiero**
```php
public function store(Request $request)
{
    // ... código existente ...
    
    try {
        $response = Http::timeout(10)
            ->accept('application/json')
            ->post(env('API_URL'), [
                'X' => $xapi,
                'y' => $yapi,
                'dinero_meta' => $previoapi->dinero_meta,
                'fecha_meta' => $previoapi->fecha_meta
            ]);
        
        $apiResponse = $response->json();
        
        // Aplicar validación y formateo
        $response = $this->validateAndFormatApiResponse(
            $apiResponse, 
            $previoapi->dinero_meta, 
            $previoapi->fecha_meta, 
            $historicoapi
        );
        
        // ... procesamiento de resultados ...
    } catch (RequestException $e) {
        $errores[] = "Error de conexión con la API";
    }
}
```

#### **Método `meta()` - Metas Financieras**
```php
public function meta(Request $request)
{
    // ... código existente ...
    
    try {
        $apiCall = Http::accept('application/json')->post(env('API_URL'), [
            'X' => $xapi,
            'y' => $yapi,
            'dinero_meta' => $metaapi->dinero_meta,
            'fecha_meta' => $metaapi->fecha_meta
        ]);
        
        $apiResponse = $apiCall->json();
        
        // Aplicar validación y formateo
        $response = $this->validateAndFormatApiResponse(
            $apiResponse, 
            $metaapi->dinero_meta, 
            $metaapi->fecha_meta, 
            $historicoapi
        );
        
        // ... procesamiento de resultados ...
    } catch (RequestException $e) {
        $errores[] = "Error de conexión con la API";
    }
}
```

---

## 🔍 Validación y Formateo

### **Casos de Validación**

#### **1. Respuesta API Válida**
```json
// Input de API
{
    "ahorro_extra_diario_necesario": 156.789123,
    "ahorro_extra_mensual_necesario": 4703.673690
}

// Output Formateado
[
    "156.79",  // Redondeado a 2 decimales
    "4703.67"  // Redondeado a 2 decimales
]
```

#### **2. Valores Negativos (Meta ya alcanzada)**
```json
// Input de API
{
    "ahorro_extra_diario_necesario": -50.25,
    "ahorro_extra_mensual_necesario": -1507.50
}

// Cálculo Inteligente
// Si dinero_faltante <= 0 (meta alcanzada)
// Output: ["0.00", "0.00"]
```

#### **3. Valores Negativos (Meta no alcanzada)**
```json
// Input de API
{
    "ahorro_extra_diario_necesario": -25.75,
    "ahorro_extra_mensual_necesario": -772.50
}

// Cálculo Inteligente
// dinero_faltante = $50,000 - $35,000 = $15,000
// dias_restantes = 180 días
// ahorro_diario = $15,000 ÷ 180 = $83.33
// ahorro_mensual = $83.33 × 30 = $2,500.00

// Output: ["83.33", "2500.00"]
```

#### **4. Respuesta API Inválida**
```json
// Input de API (estructura incorrecta)
{
    "error": "Invalid parameters",
    "status": 400
}

// Output: null (se maneja como error)
```

### **Algoritmo de Cálculo de Ahorro Mínimo**

```php
// Pseudocódigo del algoritmo
if (valores_negativos_o_cero) {
    fecha_actual = hoy()
    fecha_objetivo = fecha_meta_usuario
    dias_restantes = diferencia_en_dias(fecha_objetivo, fecha_actual)
    
    if (dias_restantes > 0) {
        saldo_actual = ultimo_registro_historico.saldo
        dinero_faltante = dinero_meta - saldo_actual
        
        if (dinero_faltante > 0) {
            ahorro_diario_minimo = dinero_faltante / dias_restantes
            ahorro_mensual_minimo = ahorro_diario_minimo * 30
        } else {
            // Meta ya alcanzada
            ahorro_diario_minimo = 0
            ahorro_mensual_minimo = 0
        }
    } else {
        // Fecha ya pasó, cálculo de emergencia
        ahorro_diario_minimo = max(0, dinero_faltante)
        ahorro_mensual_minimo = ahorro_diario_minimo * 30
    }
}
```

---

## 🌐 Endpoints y Métodos

### **Configuración de API Externa**

#### **Variables de Entorno**
```bash
# .env
API_URL=http://localhost:5000/suggest_savings
API_TIMEOUT=10  # segundos
```

#### **Estructura de Request**
```json
{
    "X": ["2024-01-15", "2024-01-16", "2024-01-17"],  // Fechas históricas
    "y": [1000.50, 1250.75, 1500.25],                // Saldos históricos
    "dinero_meta": 50000.00,                          // Meta financiera
    "fecha_meta": "15-06-2024"                        // Fecha objetivo (d-m-Y)
}
```

#### **Estructura de Response Esperada**
```json
{
    "ahorro_extra_diario_necesario": 156.78,
    "ahorro_extra_mensual_necesario": 4703.40,
    "probabilidad_exito": 0.85,
    "recomendaciones": [
        "Mantén disciplina de ahorro",
        "Considera ingresos adicionales"
    ]
}
```

### **Manejo de Errores**

#### **Tipos de Errores**
```php
// 1. Error de Conexión
catch (ConnectionException $e) {
    $errores[] = "No se pudo conectar con el servidor de IA";
    $response = null;
}

// 2. Error de Timeout
catch (RequestException $e) {
    $errores[] = "Error de conexión con la API";
    $response = null;
}

// 3. Error General
catch (Exception $e) {
    $errores[] = "NO SE PUDO CONECTAR A LA API";
    $response = null;
}
```

#### **Fallback cuando API falla**
```php
if ($response === null) {
    // Mostrar mensaje de error al usuario
    // Permitir uso de funcionalidades básicas sin IA
    $ahorro = new \stdClass;
    $ahorro->ejemplo = "Servicio de IA temporalmente no disponible";
    $ahorro->foto = 'foto_error.jpg';
}
```

---

## 💼 Casos de Uso

### **Caso 1: Usuario con Meta Realista**

#### **Datos de Entrada:**
```php
$historicoapi = [
    ['fecha_click' => '2024-01-01', 'saldo' => 5000],
    ['fecha_click' => '2024-01-15', 'saldo' => 7500],
    ['fecha_click' => '2024-02-01', 'saldo' => 10000]
];
$dinero_meta = 25000;
$fecha_meta = '01-12-2024'; // 10 meses restantes
```

#### **Respuesta API:**
```json
{
    "ahorro_extra_diario_necesario": 50.00,
    "ahorro_extra_mensual_necesario": 1500.00
}
```

#### **Resultado Final:**
```php
$response = ["50.00", "1500.00"];
$ahorro->ejemplo = "Ahorra $50 pesos diarios para alcanzar tu meta";
$ahorro->foto = 'foto_realista.jpg';
```

### **Caso 2: Usuario con Meta Muy Ambiciosa**

#### **Datos de Entrada:**
```php
$historicoapi = [
    ['fecha_click' => '2024-01-01', 'saldo' => 2000],
    ['fecha_click' => '2024-01-15', 'saldo' => 2500],
    ['fecha_click' => '2024-02-01', 'saldo' => 3000]
];
$dinero_meta = 100000;
$fecha_meta = '01-06-2024'; // 4 meses restantes
```

#### **Respuesta API:**
```json
{
    "ahorro_extra_diario_necesario": 808.33,
    "ahorro_extra_mensual_necesario": 24250.00
}
```

#### **Resultado Final:**
```php
$response = ["808.33", "24250.00"];
$ahorro->ejemplo = "¡Cuidado, tu meta de ahorro tiene una baja probabilidad de tener éxito!";
$ahorro->foto = 'foto_irreal.jpg';
```

### **Caso 3: Usuario que ya Alcanzó su Meta**

#### **Datos de Entrada:**
```php
$historicoapi = [
    ['fecha_click' => '2024-01-01', 'saldo' => 15000],
    ['fecha_click' => '2024-01-15', 'saldo' => 18000],
    ['fecha_click' => '2024-02-01', 'saldo' => 22000]
];
$dinero_meta = 20000;
$fecha_meta = '01-12-2024';
```

#### **Respuesta API:**
```json
{
    "ahorro_extra_diario_necesario": -15.50,
    "ahorro_extra_mensual_necesario": -465.00
}
```

#### **Cálculo Inteligente:**
```php
// dinero_faltante = 20000 - 22000 = -2000 (ya alcanzada)
$response = ["0.00", "0.00"];
$ahorro->ejemplo = "¡MUY BIEN, VAS SOBRADO EN TUS AHORROS PARA LOGRAR TU META!";
$ahorro->foto = 'foto_feliz.jpg';
```

### **Caso 4: API No Disponible**

#### **Escenario:**
```php
// API externa no responde o devuelve error
$apiResponse = null;
```

#### **Manejo:**
```php
$response = null;
$ahorro = null;
$errores[] = "NO SE PUDO CONECTAR A LA API";

// En la vista se muestra:
// "Servicio de predicción temporalmente no disponible"
// "Puedes continuar usando las funciones básicas"
```

---

## 🔧 Troubleshooting

### **Problemas Comunes**

#### **1. API No Responde**
```bash
# Verificar que la API de Python esté corriendo
cd API_Titulacion
python app.py

# Verificar URL en .env
API_URL=http://localhost:5000/suggest_savings
```

#### **2. Timeout de Conexión**
```php
// Aumentar timeout en el controlador
$response = Http::timeout(30) // Aumentar de 10 a 30 segundos
    ->accept('application/json')
    ->post(env('API_URL'), $data);
```

#### **3. Datos Históricos Insuficientes**
```php
if (count($xapi) == 0 && count($yapi) == 0) {
    $errores[] = 'No hay registros historicos para continuar';
}

// Solución: Usuario debe registrar al menos 3 puntos de datos
```

#### **4. Formato de Fecha Incorrecto**
```php
// Asegurar formato correcto d-m-Y
$date = Carbon::createFromFormat('Y-m-d H:i:s', $previoapi->created_at);
$date = $date->addDays($previoapi->fecha_previo);
$previoapi->fecha_meta = $date->format('d-m-Y'); // Formato correcto
```

### **Logs y Debugging**

#### **Habilitar Logs de API**
```php
// En el controlador, agregar logging
Log::info('API Request', [
    'url' => env('API_URL'),
    'data' => $requestData,
    'user_id' => Auth::user()->id
]);

Log::info('API Response', [
    'response' => $apiResponse,
    'formatted' => $response
]);
```

#### **Verificar Datos de Entrada**
```php
// Debug de datos históricos
dd([
    'X' => $xapi,
    'y' => $yapi,
    'dinero_meta' => $previoapi->dinero_meta,
    'fecha_meta' => $previoapi->fecha_meta
]);
```

### **Monitoreo de Performance**

#### **Métricas Importantes**
- **Tiempo de respuesta API**: < 10 segundos
- **Tasa de éxito**: > 95%
- **Precisión de predicciones**: Validación continua
- **Uso de recursos**: Monitoreo de memoria y CPU

#### **Alertas Recomendadas**
```php
// Implementar alertas para:
// 1. API no disponible por > 5 minutos
// 2. Tiempo de respuesta > 15 segundos
// 3. Tasa de error > 5%
// 4. Valores de predicción fuera de rangos esperados
```

---

## 📊 Métricas y Analytics

### **KPIs de la API**

#### **Técnicos**
- **Uptime**: 99.9% objetivo
- **Response Time**: < 5 segundos promedio
- **Error Rate**: < 1%
- **Throughput**: 100 requests/minuto

#### **Funcionales**
- **Precisión de predicciones**: Comparación con resultados reales
- **Satisfacción del usuario**: Feedback sobre utilidad de predicciones
- **Adopción**: % de usuarios que usan predicciones IA

### **Mejoras Futuras**

#### **Versión 2.1 (Planeada)**
- **Machine Learning avanzado**: Modelos más sofisticados
- **Predicciones personalizadas**: Basadas en perfil demográfico
- **Análisis de sentimiento**: Incorporar factores económicos externos
- **API caching**: Reducir latencia para consultas similares

#### **Versión 3.0 (Roadmap)**
- **IA conversacional**: Chatbot financiero integrado
- **Predicciones multi-objetivo**: Múltiples metas simultáneas
- **Análisis predictivo avanzado**: Detección de patrones complejos
- **Integración con bancos**: Datos en tiempo real

---

*API de Inteligencia Artificial - Future Prime Finance v2.0* 