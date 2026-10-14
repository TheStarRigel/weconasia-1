#!/bin/bash
set -e

# Change Apache port if PORT env variable is set (Render/Railway use dynamic $PORT)
if [ -n "$PORT" ]; then
    echo "Configuring Apache to listen on port $PORT"
    sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
    sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf
fi

# Ensure storage directories exist with correct permissions
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# If SQLite is used and database file doesn't exist, create it
if [ "$DB_CONNECTION" = "sqlite" ]; then
    mkdir -p database
    touch database/database.sqlite
    chown -R www-data:www-data database
    chmod -R 775 database
fi

# Run migrations and seeders automatically
echo "Running database migrations..."
php artisan migrate --force --seed || echo "Migration warning: check DB connectivity."

# Cache Laravel configurations for production performance
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting Apache web server..."
exec apache2-foreground
