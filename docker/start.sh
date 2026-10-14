#!/bin/bash
set -e

echo "=== WECON ASIA Production Server Starting ==="

# 1. Ensure exactly one MPM (mpm_prefork) is loaded (fixes AH00534 duplicate MPM error)
echo "Configuring Apache MPM modules..."
rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf
a2enmod mpm_prefork >/dev/null 2>&1 || true

# 2. Configure dynamic Railway port
PORT="${PORT:-80}"
echo "Configuring Apache to listen on port: $PORT"

# Overwrite ports.conf to listen ONLY on the dynamic port (avoids duplicate port collision)
echo "Listen ${PORT}" > /etc/apache2/ports.conf

# Update VirtualHost to listen on the dynamic port
sed -i "s/<VirtualHost [^>]*>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# 3. Ensure .env exists (failsafe)
if [ ! -f .env ]; then
    cp .env.example .env || touch .env
fi

# 4. Synchronize APP_KEY if provided as environment variable
if [ -n "$APP_KEY" ]; then
    sed -i "s|^APP_KEY=.*|APP_KEY=${APP_KEY}|" .env 2>/dev/null || echo "APP_KEY=${APP_KEY}" >> .env
elif ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    php artisan key:generate --force || true
fi

# 5. Determine database connection
if [ -n "$MYSQLHOST" ] || [ -n "$MYSQL_URL" ]; then
    echo "Using MySQL database..."
    export DB_CONNECTION=mysql
    sed -i "s|^DB_CONNECTION=.*|DB_CONNECTION=mysql|" .env 2>/dev/null || echo "DB_CONNECTION=mysql" >> .env

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
    export DB_DATABASE=/var/www/html/database/database.sqlite
    export SESSION_DRIVER=cookie

    # Synchronize .env with sqlite and cookie session
    sed -i "s|^DB_CONNECTION=.*|DB_CONNECTION=sqlite|" .env 2>/dev/null || echo "DB_CONNECTION=sqlite" >> .env
    sed -i "s|^DB_DATABASE=.*|DB_DATABASE=/var/www/html/database/database.sqlite|" .env 2>/dev/null || echo "DB_DATABASE=/var/www/html/database/database.sqlite" >> .env
    sed -i "s|^SESSION_DRIVER=.*|SESSION_DRIVER=cookie|" .env 2>/dev/null || echo "SESSION_DRIVER=cookie" >> .env

    mkdir -p /var/www/html/database
    touch /var/www/html/database/database.sqlite

    # If a legacy root wecon_asia database exists with data, migrate its content
    if [ -f /var/www/html/wecon_asia ] && [ ! -s /var/www/html/database/database.sqlite ]; then
        cp /var/www/html/wecon_asia /var/www/html/database/database.sqlite 2>/dev/null || true
    fi

    # Symlink wecon_asia and laravel to database.sqlite as failsafe against external env overrides
    rm -f /var/www/html/wecon_asia /var/www/html/laravel 2>/dev/null || true
    ln -sf /var/www/html/database/database.sqlite /var/www/html/wecon_asia 2>/dev/null || true
    ln -sf /var/www/html/database/database.sqlite /var/www/html/laravel 2>/dev/null || true

    chown -R www-data:www-data /var/www/html/database
    chmod 777 /var/www/html/database /var/www/html
    chmod 666 /var/www/html/database/database.sqlite
fi

# 6. Run database migrations and seed default content
echo "Running database migrations..."
php artisan migrate --force --seed || echo "Migration notice: continuing startup..."

# 7. Optimize Laravel caches for production
echo "Caching Laravel configuration and routes..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# 8. Ensure permissions are strictly granted to www-data for web execution
echo "Fixing file and directory permissions for www-data..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database /var/www/html/.env || true
chmod 777 /var/www/html || true
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database || true
chmod 666 /var/www/html/database/*.sqlite* /var/www/html/*.sqlite* /var/www/html/wecon_asia* 2>/dev/null || true

# 9. Verify Apache syntax before launch
echo "Verifying Apache configuration syntax..."
apache2ctl configtest || true

echo "=== WECON ASIA Web Server Live on Port $PORT ==="
exec apache2-foreground
