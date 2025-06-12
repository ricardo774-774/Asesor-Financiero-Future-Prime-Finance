#!/bin/bash

# ============================================
# Configurador de Backup macOS - FinanzasPro
# Usa launchd para programar backups cada 5 días
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
PLIST_NAME="com.finanzaspro.backup"
PLIST_FILE="$HOME/Library/LaunchAgents/$PLIST_NAME.plist"

echo -e "${BLUE}============================================${NC}"
echo -e "${BLUE}🏦 FINANZAS PRO - CONFIGURADOR macOS${NC}"
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

# Crear directorio LaunchAgents si no existe
mkdir -p "$HOME/Library/LaunchAgents"

# Descargar servicio existente si existe
if [ -f "$PLIST_FILE" ]; then
    echo -e "${YELLOW}⚠️  Servicio de backup existente encontrado${NC}"
    launchctl unload "$PLIST_FILE" 2>/dev/null
    echo -e "${YELLOW}🗑️  Servicio anterior desinstalado${NC}"
fi

# Crear el archivo plist para launchd
cat > "$PLIST_FILE" << EOF
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
    <key>Label</key>
    <string>$PLIST_NAME</string>
    
    <key>ProgramArguments</key>
    <array>
        <string>$BACKUP_SCRIPT</string>
    </array>
    
    <key>StartInterval</key>
    <integer>432000</integer>
    
    <key>RunAtLoad</key>
    <false/>
    
    <key>StandardOutPath</key>
    <string>$PROJECT_DIR/database_backups/launchd.log</string>
    
    <key>StandardErrorPath</key>
    <string>$PROJECT_DIR/database_backups/launchd_error.log</string>
    
    <key>EnvironmentVariables</key>
    <dict>
        <key>PATH</key>
        <string>/usr/local/bin:/usr/bin:/bin</string>
    </dict>
</dict>
</plist>
EOF

echo -e "${GREEN}✅ Archivo de configuración creado${NC}"

# Cargar el servicio
if launchctl load "$PLIST_FILE"; then
    echo -e "${GREEN}✅ Servicio de backup configurado exitosamente${NC}"
    echo -e "${BLUE}📅 Programación: Cada 5 días (432000 segundos)${NC}"
    echo -e "${BLUE}📁 Directorio de backups: $PROJECT_DIR/database_backups${NC}"
    echo -e "${BLUE}📋 Servicio: $PLIST_NAME${NC}"
    echo ""
    echo -e "${GREEN}🎉 Configuración completada${NC}"
    echo ""
    echo -e "${YELLOW}📋 Comandos útiles:${NC}"
    echo -e "${BLUE}• Ver estado del servicio:${NC}"
    echo -e "  launchctl list | grep finanzaspro"
    echo ""
    echo -e "${BLUE}• Detener el servicio:${NC}"
    echo -e "  launchctl unload ~/Library/LaunchAgents/$PLIST_NAME.plist"
    echo ""
    echo -e "${BLUE}• Iniciar el servicio:${NC}"
    echo -e "  launchctl load ~/Library/LaunchAgents/$PLIST_NAME.plist"
    echo ""
    echo -e "${BLUE}• Ejecutar backup manualmente:${NC}"
    echo -e "  ./backup_database.sh"
    echo ""
    echo -e "${BLUE}• Ver logs del servicio:${NC}"
    echo -e "  tail -f ./database_backups/launchd.log"
    echo ""
    echo -e "${BLUE}• Forzar ejecución inmediata:${NC}"
    echo -e "  launchctl start $PLIST_NAME"
    
else
    echo -e "${RED}❌ Error al cargar el servicio${NC}"
    echo -e "${YELLOW}💡 Intenta ejecutar manualmente:${NC}"
    echo -e "${BLUE}   launchctl load ~/Library/LaunchAgents/$PLIST_NAME.plist${NC}"
    exit 1
fi

echo ""
echo -e "${BLUE}============================================${NC}" 