<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Conectar al server
- Estar parado en la carpeta modular
```
ssh ubuntu@3.138.169.53 -i access-key.pem
```

## Nginx sigue trabajando 
```
systemctl status nginx
```
Debemos ver "Active: active (running)"

curl -sL https://deb.nodesource.com/setup_20.x -o nodesource_setup.sh


sudo ln -s /etc/nginx/sites-available/laravel.conf /etc/nginx/sites-enabled/
sudo nginx -t 
sudo systemctl restart nginx 


sudo chown -R www-data:www-data /home/ubuntu/modular/Asesor-Financiero-Future-Prime-Finance/public
sudo chmod -R 755 /home/ubuntu/modular/Asesor-Financiero-Future-Prime-Finance/public


sudo chown -R www-data:www-data /home/ubuntu/modular/Asesor-Financiero-Future-Prime-Finance
sudo chmod -R 755 /home/ubuntu/modular/Asesor-Financiero-Future-Prime-Finance
sudo chmod -R 775 /home/ubuntu/modular/Asesor-Financiero-Future-Prime-Finance/storage
sudo chmod -R 775 /home/ubuntu/modular/Asesor-Financiero-Future-Prime-Finance/bootstrap/cache


sudo chown -R www-data:www-data /home/ubuntu/modular/Asesor-Financiero-Future-Prime-Finance
sudo chmod -R 755 /home/ubuntu/modular/Asesor-Financiero-Future-Prime-Finance


sudo ln -s /etc/nginx/sites-available/laravel.conf /etc/nginx/sites-enabled/
sudo nginx -t # Verifica la configuración
sudo systemctl reload nginx


ls -l /etc/nginx/sites-enabled/


sudo mv ~/Asesor-Financiero-Future-Prime-Finance /var/www/Asesor-Financiero-Future-Prime-Finance

sudo chown -R www-data.www-data /var/www/Asesor-Financiero-Future-Prime-Finance/storage
sudo chown -R www-data.www-data /var/www/Asesor-Financiero-Future-Prime-Finance/bootstrap/cache


sudo nano /etc/nginx/sites-available/
/etc/nginx/sites-available/laravel.conf


sudo ln -s /etc/nginx/sites-available/laravel.conf /etc/nginx/sites-enabled/


sudo chmod -R 775 /var/www/html/Asesor-Financiero-Future-Prime-Finance

sudo chown -R www-data:www-data /var/www/html/Asesor-Financiero-Future-Prime-Finance
