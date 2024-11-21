# Pars News Api

## Installation
1. Composer install from packages.org:
```
composer require angus-dv/pars-news
```
2. Docker file add to root:
```angular2html
php artisan pars-news:install-docker
```
3. Docker compose up:
```angular2html
docker compose up -d
```
4. Publish vendor : 
```
docker exec -it pars_php  php artisan vendor:publish
```
5.run migrations and seeders and sanctum install
```angular2html
docker exec -it pars_php  php robot:install
```

