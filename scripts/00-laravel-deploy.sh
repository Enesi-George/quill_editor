#!/usr/bin/env bash

# Navigate to the project directory
cd /var/www/html

# Install Composer dependencies
echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# Set correct permissions
echo "Setting correct permissions..."
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html/storage

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Clear and cache config
echo "Clearing and caching config..."
php artisan config:clear
php artisan config:cache

# Cache routes
echo "Caching routes..."
php artisan route:cache

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# Install NPM dependencies
echo "Installing NPM dependencies..."
npm ci

# Build frontend assets
echo "Building frontend assets..."
npm run build

# Optimize Laravel
echo "Optimizing Laravel..."
php artisan optimize

echo "Deployment finished!"