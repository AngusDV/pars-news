#!/bin/sh
if [ ! -f "composer.json" ]; then
cp composer.sample.json composer.json
fi

if [ ! -f ".env" ]; then
  cp .env.example .env
fi

if [ ! -f "vendor/autoload.php" ]; then
composer install --no-progress --no-interaction
fi

php-fpm -D
nginx -g "daemon off;"


