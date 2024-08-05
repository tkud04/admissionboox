#!/usr/bin/env bash
echo "Running composer"
#composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Clearing and Caching routes..."
php artisan route:clear
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force