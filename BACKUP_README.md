# 💾 Sistema de Backup Automático - FinanzasPro

Sistema completo de respaldo automático para la base de datos MySQL de FinanzasPro, optimizado para macOS M2.

## 📋 Archivos del Sistema

- `backup_database.sh` - Script principal de backup
- `setup_backup_macos.sh` - Configurador para macOS (recomendado)
- `setup_backup_cron.sh` - Configurador con cron (alternativo)
- `database_backups/` - Carpeta donde se almacenan los respaldos

## 🚀 Instalación Rápida (macOS)

### 1. Ejecutar el configurador para macOS (Recomendado)
```bash
chmod +x setup_backup_macos.sh
./setup_backup_macos.sh
```

### 2. Probar el backup manualmente (opcional)
```bash
./backup_database.sh
```

### 3. Verificar que el servicio esté activo
```bash
launchctl list | grep finanzaspro
```

## ⚙️ Configuración

### Programación Automática
- **Frecuencia**: Cada 5 días (432000 segundos)
- **Sistema**: launchd (macOS)
- **Retención**: Mantiene los últimos 10 backups
- **Compresión**: Archivos .sql.gz para ahorrar espacio

### Configuración de Base de Datos
El script usa la configuración definida en `production.env`:
- **Host**: 127.0.0.1
- **Puerto**: 3306
- **Base de datos**: titulacion
- **Usuario**: root

## 📁 Estructura de Archivos

```
proyecto/
├── backup_database.sh                    # Script principal
├── setup_backup_macos.sh                 # Configurador macOS
├── setup_backup_cron.sh                  # Configurador cron (alternativo)
└── database_backups/                     # Carpeta de respaldos
    ├── backup_finanzaspro_YYYYMMDD_HHMMSS.sql.gz
    ├── backup_finanzaspro_YYYYMMDD_HHMMSS.sql.gz
    ├── backup.log                        # Log del script
    ├── launchd.log                       # Log del servicio
    └── launchd_error.log                 # Log de errores
```

## 🔧 Comandos Útiles (macOS)

### Gestión del servicio
```bash
# Ver estado del servicio
launchctl list | grep finanzaspro

# Detener el servicio
launchctl unload ~/Library/LaunchAgents/com.finanzaspro.backup.plist

# Iniciar el servicio
launchctl load ~/Library/LaunchAgents/com.finanzaspro.backup.plist

# Forzar ejecución inmediata
launchctl start com.finanzaspro.backup
```

### Monitoreo y logs
```bash
# Ver logs del servicio en tiempo real
tail -f ./database_backups/launchd.log

# Ver logs de errores
tail -f ./database_backups/launchd_error.log

# Ver logs del script de backup
tail -f ./database_backups/backup.log
```

### Backup manual
```bash
./backup_database.sh
```

### Restaurar backup
```bash
# Descomprimir
gunzip database_backups/backup_finanzaspro_YYYYMMDD_HHMMSS.sql.gz

# Restaurar
mysql -u root -p titulacion < database_backups/backup_finanzaspro_YYYYMMDD_HHMMSS.sql
```

## 🔔 Notificaciones

El sistema incluye notificaciones nativas de macOS:
- ✅ **Éxito**: Notificación con tamaño del archivo
- ❌ **Error**: Alerta de fallo en el backup

## 🛠️ Características

### Seguridad
- ✅ Verificación de estado de MySQL
- ✅ Transacciones consistentes (`--single-transaction`)
- ✅ Respaldo de rutinas y triggers
- ✅ Logs detallados de operaciones

### Optimización
- ✅ Compresión automática con gzip
- ✅ Limpieza automática de backups antiguos
- ✅ Notificaciones del sistema
- ✅ Manejo de errores robusto

### Monitoreo
- ✅ Logs con timestamp
- ✅ Estadísticas de uso de espacio
- ✅ Contador de backups realizados
- ✅ Logs separados para servicio y script

## 🚨 Solución de Problemas

### MySQL no está ejecutándose
```bash
# Verificar estado
brew services list | grep mysql

# Iniciar MySQL
brew services start mysql
```

### El servicio no está ejecutándose
```bash
# Verificar estado
launchctl list | grep finanzaspro

# Recargar servicio
launchctl unload ~/Library/LaunchAgents/com.finanzaspro.backup.plist
launchctl load ~/Library/LaunchAgents/com.finanzaspro.backup.plist
```

### Permisos insuficientes
```bash
chmod +x backup_database.sh
chmod +x setup_backup_macos.sh
```

### Ver errores del servicio
```bash
# Logs de errores específicos
cat ./database_backups/launchd_error.log

# Verificar configuración del plist
plutil ~/Library/LaunchAgents/com.finanzaspro.backup.plist
```

### Espacio insuficiente
```bash
# Ver espacio usado por backups
du -sh database_backups/

# Limpiar backups antiguos manualmente
cd database_backups/
ls -t backup_finanzaspro_*.sql.gz | tail -n +6 | xargs rm
```

## 📊 Estadísticas

El sistema mantiene estadísticas automáticas:
- Número total de backups
- Espacio total utilizado
- Fecha del último backup
- Tamaño promedio de backups

## 🔐 Seguridad

### Recomendaciones
1. Los backups contienen datos sensibles - mantén seguro el directorio
2. Considera encriptar backups para producción
3. Realiza backups adicionales a ubicaciones externas
4. Verifica periódicamente la integridad de los backups

### Backup de Producción
Para entornos de producción, considera:
- Usar variables de entorno para credenciales
- Backup a servicios en la nube (AWS S3, Google Cloud)
- Encriptación de archivos de backup
- Monitoreo proactivo de fallos

## 🔄 Desinstalación

Para remover completamente el sistema de backup:
```bash
# Detener y descargar el servicio
launchctl unload ~/Library/LaunchAgents/com.finanzaspro.backup.plist

# Eliminar archivo de configuración
rm ~/Library/LaunchAgents/com.finanzaspro.backup.plist

# Eliminar scripts (opcional)
rm backup_database.sh setup_backup_macos.sh

# Eliminar backups (opcional)
rm -rf database_backups/
```

---

**FinanzasPro Backup System** - Protegiendo tus datos financieros automáticamente 🛡️ 