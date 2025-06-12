1. Iniciar app

- php artisan serve 

2. Actualizar estilos

- npm run build

3. Arracar IA API

- python 3 app.py

4. Seeder y migraciones

- php artisan migrate:fresh --seed

5. Ver estado del servicio backup automatico
launchctl list | grep finanzaspro

6. Ejecutar backup manual
./backup_database.sh

7. Ver logs en tiempo real
tail -f ./database_backups/backup.log

8. Forzar backup inmediato
launchctl start com.finanzaspro.backup

9. Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
