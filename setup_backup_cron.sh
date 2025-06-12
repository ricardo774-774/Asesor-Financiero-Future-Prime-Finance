#!/bin/bash

# ============================================
# Configurador de Cron Job - FinanzasPro
# Configura backup automático cada 5 días
# Compatible con macOS M2
# ============================================

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Directorio actual del proyecto
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
BACKUP_SCRIPT="$PROJECT_DIR/backup_database.sh"

echo -e "${BLUE}============================================${NC}"
echo -e "${BLUE}🏦 FINANZAS PRO - CONFIGURADOR DE BACKUP${NC}"
echo -e "${BLUE}============================================${NC}"
echo ""

# Verificar si el script de backup existe
if [ ! -f "$BACKUP_SCRIPT" ]; then
    echo -e "${RED}❌ Error: No se encontró el script backup_database.sh${NC}"
    echo -e "${YELLOW}💡 Asegúrate de que backup_database.sh esté en el mismo directorio${NC}"
    exit 1
fi

# Hacer el script ejecutable
chmod +x "$BACKUP_SCRIPT"
echo -e "${GREEN}✅ Script de backup configurado como ejecutable${NC}"

# Crear la entrada de cron job
CRON_JOB="0 2 */5 * * $BACKUP_SCRIPT"

echo -e "${YELLOW}📋 Configurando cron job para ejecutar cada 5 días a las 2:00 AM...${NC}"

# Verificar si ya existe un cron job para este script
if crontab -l 2>/dev/null | grep -q "$BACKUP_SCRIPT"; then
    echo -e "${YELLOW}⚠️  Ya existe un cron job para este script${NC}"
    echo -e "${BLUE}📝 Cron jobs actuales:${NC}"
    crontab -l 2>/dev/null | grep "$BACKUP_SCRIPT"
    echo ""
    read -p "¿Deseas reemplazarlo? (y/n): " -n 1 -r
    echo ""
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        # Remover el cron job existente
        crontab -l 2>/dev/null | grep -v "$BACKUP_SCRIPT" | crontab -
        echo -e "${YELLOW}🗑️  Cron job anterior removido${NC}"
    else
        echo -e "${BLUE}ℹ️  Configuración cancelada${NC}"
        exit 0
    fi
fi

# Agregar el nuevo cron job
(crontab -l 2>/dev/null; echo "$CRON_JOB") | crontab -

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Cron job configurado exitosamente${NC}"
    echo -e "${BLUE}📅 Programación: Cada 5 días a las 2:00 AM${NC}"
    echo -e "${BLUE}📁 Directorio de backups: $PROJECT_DIR/database_backups${NC}"
    echo ""
    echo -e "${GREEN}🎉 Configuración completada${NC}"
    echo ""
    echo -e "${YELLOW}📋 Para verificar tu cron job:${NC}"
    echo -e "${BLUE}   crontab -l${NC}"
    echo ""
    echo -e "${YELLOW}📋 Para probar el backup manualmente:${NC}"
    echo -e "${BLUE}   ./backup_database.sh${NC}"
    echo ""
    echo -e "${YELLOW}📋 Para ver los logs de backup:${NC}"
    echo -e "${BLUE}   tail -f ./database_backups/backup.log${NC}"
else
    echo -e "${RED}❌ Error al configurar el cron job${NC}"
    exit 1
fi

echo -e "${BLUE}============================================${NC}" 