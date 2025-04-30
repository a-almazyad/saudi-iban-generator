FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip zip git curl libzip-dev libsqlite3-dev pkg-config \
    && docker-php-ext-install zip pdo pdo_sqlite

# Copy existing application directory contents
COPY . .

# Set permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html

# Start command for Render
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
