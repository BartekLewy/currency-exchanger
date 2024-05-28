FROM php:8.2-fpm as php

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libcurl4-openssl-dev \
    libxml2-dev \
    libonig-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install curl mbstring dom zip

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /.composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app