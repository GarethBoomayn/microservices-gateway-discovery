FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y libicu-dev libzip-dev libxml2-dev git unzip libonig-dev nginx supervisor

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql intl zip opcache

# Install Composer
COPY --from=composer/composer:latest /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/symfony

# Copy Symfony code
COPY symfony/ /var/www/symfony/

# Allow Composer plugins to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Symfony dependencies
RUN composer install --no-dev --optimize-autoloader

# Remove default Nginx config and copy our config
RUN rm /etc/nginx/sites-enabled/default
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copy Supervisor configuration
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 80
EXPOSE 80

# Start Supervisor to run Nginx and PHP-FPM
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
