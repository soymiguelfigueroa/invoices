FROM php:8.3.7-apache

RUN apt update
RUN docker-php-ext-install mysqli pdo pdo_mysql 
RUN docker-php-ext-enable pdo_mysql
RUN a2enmod rewrite