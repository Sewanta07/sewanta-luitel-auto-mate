# Use the official PHP image with required extensions
FROM php:8.2-fpm

# Install system dependencies and Node.js
RUN apt-get update \
    && apt-get install -y git unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl libpq-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql zip gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install && npm run build

# Diagnostic: List resources/views contents for debugging
RUN ls -lR resources/views
# Diagnostic: Print resource_path('views') and list its contents
RUN echo "\n\n=== RESOURCE_PATH DIAGNOSTIC ===" \
    && ls -l "/var/www/resources/views" \
    && echo "=== END RESOURCE_PATH DIAGNOSTIC ===\n\n"
# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache resources/views

# Expose port 8000 and start Laravel with migrations and cache commands at container startup
EXPOSE 8000
WORKDIR /var/www
    CMD php artisan config:clear && php artisan view:clear && php artisan cache:clear && php artisan config:cache && php-fpm
