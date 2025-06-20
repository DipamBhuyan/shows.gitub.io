# Use PHP 8.1 with Apache
FROM php:8.1-apache

# Enable required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files into the container
COPY . /var/www/html/

# Set upload folder permissions
RUN chown -R www-data:www-data /var/www/html/uploads

# Enable mod_rewrite if using clean URLs
RUN a2enmod rewrite
