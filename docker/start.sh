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

# 5. Enforce cookie session (zero database writes)
export SESSION_DRIVER=cookie
sed -i "s|^SESSION_DRIVER=.*|SESSION_DRIVER=cookie|" .env 2>/dev/null || echo "SESSION_DRIVER=cookie" >> .env

# 6. Optimize Laravel caches for production
echo "Caching Laravel configuration and routes..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# 7. Ensure permissions are granted to www-data for web execution
echo "Fixing file and directory permissions for www-data..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/.env || true
chmod 777 /var/www/html || true
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache || true

# 8. Verify Apache syntax before launch
echo "Verifying Apache configuration syntax..."
apache2ctl configtest || true

echo "=== WECON ASIA Web Server Live on Port $PORT ==="
exec apache2-foreground
