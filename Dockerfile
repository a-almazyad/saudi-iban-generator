FROM php:8.2-cli

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    unzip zip git curl libzip-dev \
    && docker-php-ext-install zip pdo pdo_sqlite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Copy app files
COPY . /var/www/html
WORKDIR /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set the Laravel key manually (render won't run php artisan)
ENV APP_KEY=base64:CbpI/k9IdQUWo6uDvjpdFDobrRnsd+MPAVRHOxQCV4s=

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=10000
