#!/usr/bin/env bash

# Navigate to the project directory
cd /var/www/html

echo "Running composer"
composer install --no-dev --optimize-autoloader -vvv

# Verify if Ziggy is installed
echo "Listing contents of vendor/tightenco/ziggy/dist/"
ls -l /var/www/html/vendor/tightenco/ziggy/dist/

# Optional: Generate Ziggy routes (uncomment if needed)
echo "Generating Ziggy routes"
php artisan ziggy:generate

echo "Installing NPM dependencies"
npm install

echo "Building assets"
npm run build

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Clearing optimized files..."
php artisan optimize:clear

echo "Optimizing application..."
php artisan optimize
