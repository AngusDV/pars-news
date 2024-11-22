# Pars News Api

## Installation
1. Composer install from packages.org:
```
composer require angus-dv/pars-news
```
## Docker Run
 Docker file add to root:
```angular2html
php artisan pars-news:install-docker
```
 Docker compose up:
```angular2html
docker compose up -d
```

## Publish Vendor

```
docker exec -it pars_php  php artisan vendor:publish
```
## Migraion and seder
run migrations and seeders and sanctum install
```angular2html
docker exec -it pars_php  php artisan robot:install
```

## Queue
for queue work you must install supervisor
```angular2html
sudo apt-get install supervisor
```
7.make supervisor config in /etc/supervisor/conf.d/laravel-worker.conf
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command= docker exec  pars_php  php  artisan queue:work
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=root
numprocs=4
redirect_stderr=true
stdout_logfile=/var/log/laravel-worker.log
stopwaitsecs=3600
```
after that you must do : 
```
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start all
```

## TEST
```angular2html
sudo docker exec -it pars_php  php  artisan test /vendor/angus-dv/pars-news/Test/
```
