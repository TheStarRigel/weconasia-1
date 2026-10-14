#!/bin/bash
set -e

echo "=== WECON ASIA Production Server Starting ==="

# 1. Configure dynamic Railway port
PORT="${PORT:-80}"
echo "Configuring Apache to listen on port: $PORT"

# Overwrite ports.conf to listen ONLY on the dynamic port (avoids duplicate port collision)
echo "Listen ${PORT}" > /etc/apache2/ports.conf

# Update VirtualHost to listen on the dynamic port
sed -i "s/<VirtualHost [^>]*>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# 2. Ensure .env exists (failsafe)
if [ ! -f .env ]; then
    cp .env.example .env || touch .env
fi

# 3. Synchronize APP_KEY if provided as environment variable
if [ -n "$APP_KEY" ]; then
    sed -i "s|^APP_KEY=.*|APP_KEY=${APP_KEY}|" .env 2>/dev/null || echo "APP_KEY=${APP_KEY}" >> .env
elif ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    php artisan key:generate --force || true
fi

# 4. Determine database connection
if [ -n "$MYSQLHOST" ] || [ -n "$MYSQL_URL" ] || [ "$DB_CONNECTION" = "mysql" ]; then
    echo "Using MySQL database..."
    export DB_CONNECTION=mysql

    # Wait up to 10s for MySQL if not immediately available
    for i in {1..10}; do
        if php artisan db:show >/dev/null 2>&1; then
            echo "MySQL connection verified!"
            break
        fi
        echo "Waiting for database connection... ($i/10)"
        sleep 1
    done
else
    echo "Using SQLite database..."
    export DB_CONNECTION=sqlite
    mkdir -p database
    touch database/database.sqlite
    chown www-data:www-data database/database.sqlite
    chmod 664 database/database.sqlite
fi

# 5. Run database migrations and seed default content
echo "Running database migrations..."
php artisan migrate --force --seed || echo "Migration notice: continuing startup..."

# 6. Optimize Laravel caches for production
echo "Caching Laravel configuration and routes..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# 7. Ensure permissions are set
chown -R www-data:www-data storage bootstrap/cache database .env || true
chmod -R 775 storage bootstrap/cache database || true

# 8. Verify Apache syntax before launch
echo "Verifying Apache configuration syntax..."
apache2ctl configtest || true

echo "=== WECON ASIA Web Server Live on Port $PORT ==="
exec apache2-foreground
