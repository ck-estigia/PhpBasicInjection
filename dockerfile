FROM php:8.3-apache

# Install dependencies + PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (optional but common)
RUN a2enmod rewrite