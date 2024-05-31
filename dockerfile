FROM php:8.3.7-apache

RUN apt update
RUN apt-get install -y libzip-dev zip
RUN docker-php-ext-install mysqli pdo pdo_mysql zip
RUN docker-php-ext-enable pdo_mysql
RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer