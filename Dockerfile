FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    unzip zip git curl libzip-dev libsqlite3-dev pkg-config \
    && docker-php-ext-install zip pdo pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Start Laravel dev server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
