FROM php:8.0.6-fpm-buster

# COPY php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Composer install
COPY --from=composer:2.0 /usr/bin/composer /bin/composer

# install Node.js
COPY --from=node:lts /usr/local/bin /usr/local/bin
COPY --from=node:lts /usr/local/lib /usr/local/lib

RUN apt-get update \
    && apt-get -y install \
    git \
    zip \
    unzip \
    vim \
    && docker-php-ext-install pdo_mysql bcmath

RUN pecl install xdebug-3.1.4 && docker-php-ext-enable xdebug

WORKDIR /var/www/html
