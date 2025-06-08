FROM php:8.2-apache

# Copier les fichiers de ton projet vers le serveur Apache
COPY . /var/www/html/

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y libzip-dev libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip pdo pdo_mysql 