#!/bin/bash
set -e

chmod -R 775 storage bootstrap/cache 2>/dev/null || true

composer install --no-dev --optimize-autoloader

if [ -f package-lock.json ]; then
  npm ci
else
  npm install
fi
npm run build

php artisan storage:link || true

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache
