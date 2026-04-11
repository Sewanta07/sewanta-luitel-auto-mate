#!/bin/bash
set -e

# Ensure storage and cache are writable
chmod -R 775 storage bootstrap/cache

# Run Laravel optimizations
php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Install composer dependencies
composer install --no-dev --optimize-autoloader

# Build frontend assets
npm install
npm run build
