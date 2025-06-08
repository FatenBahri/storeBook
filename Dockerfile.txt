FROM php:8.2-apache

# Copier les fichiers de ton projet vers le serveur Apache
COPY . /var/www/html/

# Activer mod_rewrite si necessaire
RUN a2enmod rewrite
