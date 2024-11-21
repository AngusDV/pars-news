FROM php:8.2-fpm as pars_php

ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_ENABLE_CLI=0
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=1
ENV PHP_OPCACHE_REVALIDATE_FREQ=1

RUN usermod -u 1000 www-data



RUN php-fpm --daemonize

RUN apt-get update -y   && apt-get install -y apt-utils unzip libpq-dev libcurl4-gnutls-dev nginx  libxml2-dev zip libzip-dev  libonig-dev libpng-dev \
    && apt-get install -y  python3-launchpadlib \
    && apt-get install -y dirmngr gnupg ca-certificates software-properties-common


RUN docker-php-ext-install pdo pdo_mysql bcmath curl opcache soap zip xml intl mbstring  gd exif
RUN pecl install redis && docker-php-ext-enable redis \
    && pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /var/www

COPY --chown=www-data . /var/www/

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

#WORKDIR /var/www
#RUN php artisan optimize:clear
#RUN php artisan cache:clear
#RUN php artisan config:clear

RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap

ENTRYPOINT [ "docker/entrypoint.sh" ]
