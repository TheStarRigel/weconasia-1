#!/bin/bash
set -e

echo "=== WECON ASIA Production Server Starting ==="

# Change Apache port if PORT env variable is set (Railway sets dynamic $PORT)
if [ -n "$PORT" ]; then
    echo "Configuring Apache to listen on port $PORT"
    sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
    sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf
fi

# Ensure storage and database directories exist with correct permissions
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache database
chown -R www-data:www-data storage bootstrap/cache database
chmod -R 775 storage bootstrap/cache database

# If APP_KEY is missing, generate one
if [ -z "$APP_KEY" ]; then
    echo "Notice: APP_KEY is not set. Generating a temporary application key..."
    php artisan key:generate --force
fi

# Detect database: if MYSQLHOST is present, use mysql, else default to sqlite
if [ -n "$MYSQLHOST" ] || [ -n "$MYSQL_URL" ]; then
    echo "Detected MySQL environment on Railway."
    export DB_CONNECTION=${DB_CONNECTION:-mysql}
else
    echo "Using SQLite database."
    export DB_CONNECTION=${DB_CONNECTION:-sqlite}
fi

# If SQLite is used, ensure database file exists
if [ "$DB_CONNECTION" = "sqlite" ]; then
    touch database/database.sqlite
    chown www-data:www-data database/database.sqlite
    chmod 664 database/database.sqlite
fi

# Run database migrations and seeders automatically
echo "Running database migrations..."
php artisan migrate --force --seed || echo "Migration notice: continuing startup..."

# Cache Laravel configurations for maximum production performance
echo "Caching configuration and routes..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "=== WECON ASIA Web Server Live ==="
exec apache2-foreground
