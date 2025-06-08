FROM php:8.2-apache

# Copier les fichiers de ton projet vers le serveur Apache
COPY . /var/www/html/
# Installer extension PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql
