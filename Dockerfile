FROM php:8.2-apache-bullseye

# Instalăm extensiile necesare pentru conectare la MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Activăm mod_rewrite (opțional, dacă vei avea URL rewriting)
RUN a2enmod rewrite

# Setăm directorul sursă
WORKDIR /var/www/html
