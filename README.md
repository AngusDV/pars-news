# Pars News API

## Installation
### Step 1: Install via Composer
Run the following command to install the package from Packagist:
```
composer require angus-dv/pars-news
```
## Docker Setup
### Step 2: Add Docker File
Run the installation command for Docker:
```angular2html
php artisan pars-news:install-docker
```
### Step 3: Start Docker Compose

Use the following command to start the Docker containers:
```angular2html
docker compose up -d
```

## Publish Vendor Assets
To publish the vendor assets, execute:
```
docker exec -it pars_php  php artisan vendor:publish
```
## Migrations and Seeders
To run migrations, seeders, and install Sanctum, use:
```angular2html
docker exec -it pars_php  php artisan robot:install
```

## Queue Management
### Step 4: Install Supervisor

To manage queues, install Supervisor with:
```angular2html
sudo apt-get install supervisor
```
### Step 5: Configure Supervisor

Create a Supervisor configuration file at /etc/supervisor/conf.d/laravel-worker.conf with the following content:
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
### Step 6: Start Supervisor

Run the following commands to update and start Supervisor:
```
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start all
```

## Testing

To run tests for the Pars News package, execute:
```angular2html
sudo docker exec -it pars_php  php  artisan test vendor/angus-dv/pars-news/src/Test/Feature
```

## Postman Collection

A Postman collection for testing the API is available here.
[ parse-news.postman_collection.json ] 
