#!/bin/bash

# ============================================
# Script de Backup Automático - FinanzasPro
# Ejecuta backup de MySQL cada 5 días
# Compatible con macOS M2
# ============================================

# Configuración de la base de datos
DB_HOST="127.0.0.1"
DB_PORT="3306"
DB_NAME="titulacion"
DB_USER="root"
DB_PASS="meteoro1234"

# Directorio del proyecto (obtiene la ruta actual del script)
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
BACKUP_DIR="$PROJECT_DIR/database_backups"

# Crear directorio de backups si no existe
mkdir -p "$BACKUP_DIR"

# Configuración de fecha y archivos
DATE=$(date +"%Y%m%d_%H%M%S")
BACKUP_FILE="$BACKUP_DIR/backup_finanzaspro_$DATE.sql"
LOG_FILE="$BACKUP_DIR/backup.log"

# Función para logging
log_message() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $1" | tee -a "$LOG_FILE"
}

# Función para limpiar backups antiguos (mantener solo los últimos 10)
cleanup_old_backups() {
    log_message "🧹 Limpiando backups antiguos..."
    cd "$BACKUP_DIR"
    # Mantener solo los 10 backups más recientes
    ls -t backup_finanzaspro_*.sql 2>/dev/null | tail -n +11 | xargs -r rm --
    log_message "✅ Limpieza completada"
}

# Función principal de backup
perform_backup() {
    log_message "🚀 Iniciando backup de FinanzasPro..."
    log_message "📁 Directorio de backup: $BACKUP_DIR"
    log_message "🗄️ Base de datos: $DB_NAME"
    
    # Verificar si MySQL está corriendo
    if ! pgrep -x "mysqld" > /dev/null; then
        log_message "❌ ERROR: MySQL no está ejecutándose"
        exit 1
    fi
    
    # Realizar el backup
    if mysqldump \
        --host="$DB_HOST" \
        --port="$DB_PORT" \
        --user="$DB_USER" \
        --password="$DB_PASS" \
        --single-transaction \
        --routines \
        --triggers \
        --databases "$DB_NAME" > "$BACKUP_FILE"; then
        
        # Comprimir el archivo
        gzip "$BACKUP_FILE"
        BACKUP_FILE="$BACKUP_FILE.gz"
        
        # Obtener el tamaño del archivo
        BACKUP_SIZE=$(ls -lh "$BACKUP_FILE" | awk '{print $5}')
        
        log_message "✅ Backup completado exitosamente"
        log_message "📋 Archivo: $(basename "$BACKUP_FILE")"
        log_message "📏 Tamaño: $BACKUP_SIZE"
        
        # Limpiar backups antiguos
        cleanup_old_backups
        
        # Enviar notificación al sistema (macOS)
        osascript -e "display notification \"Backup de FinanzasPro completado ($BACKUP_SIZE)\" with title \"Database Backup\" sound name \"Glass\""
        
    else
        log_message "❌ ERROR: Falló el backup de la base de datos"
        osascript -e "display notification \"Error en backup de FinanzasPro\" with title \"Database Backup Error\" sound name \"Basso\""
        exit 1
    fi
}

# Función para mostrar estadísticas
show_stats() {
    log_message "📊 Estadísticas de backups:"
    BACKUP_COUNT=$(ls -1 "$BACKUP_DIR"/backup_finanzaspro_*.sql.gz 2>/dev/null | wc -l)
    TOTAL_SIZE=$(du -sh "$BACKUP_DIR" 2>/dev/null | awk '{print $1}')
    log_message "📈 Total de backups: $BACKUP_COUNT"
    log_message "💾 Espacio usado: $TOTAL_SIZE"
}

# Ejecutar backup
echo "============================================"
echo "🏦 FINANZAS PRO - BACKUP AUTOMÁTICO"
echo "============================================"

perform_backup
show_stats

log_message "🎉 Proceso de backup finalizado"
echo "============================================" 