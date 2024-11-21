# Pars News Api

## Installation
1. Composer install from packages.org:
```
composer require angus-dv/pars-news
```
2. Docker compose up:
```angular2html
docker compose up -d
```
3. Publish vendor : 
```
docker exec -it pars_php  php artisan vendor:publish
```
4.run migrations and seeders and sanctum install
```angular2html
docker exec -it pars_php  php robot:install
```

