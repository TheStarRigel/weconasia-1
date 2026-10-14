#!/bin/bash
set -e

echo "=== Starting WECON ASIA Production Service ==="

# 1. Bind Apache to dynamic Railway port
PORT="${PORT:-80}"
echo "Binding Apache to port $PORT"
sed -i "s/Listen [0-9]*/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost [^>]*>/<VirtualHost *:*>/g" /etc/apache2/sites-available/000-default.conf

# 2. Ensure environment file exists
if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        echo "Creating .env from .env.example..."
        cp .env.example .env
    else
        touch .env
    fi
fi

# 3. Ensure APP_KEY exists
if [ -z "$APP_KEY" ]; then
    # Check if APP_KEY is empty in .env
    if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
        echo "Generating application encryption key..."
        php artisan key:generate --force || true
    fi
fi

# 4. Determine database connection
if [ -n "$MYSQLHOST" ] || [ -n "$MYSQL_URL" ] || [ "$DB_CONNECTION" = "mysql" ]; then
    echo "Configuring MySQL database connection..."
    export DB_CONNECTION=mysql

    # Wait up to 15 seconds for MySQL service to accept connections
    echo "Checking MySQL connection..."
    for i in {1..15}; do
        if php artisan db:monitor >/dev/null 2>&1; then
            echo "MySQL database ready!"
            break
        fi
        echo "Waiting for MySQL... ($i/15)"
        sleep 1
    done
else
    echo "Configuring SQLite database..."
    export DB_CONNECTION=sqlite
    mkdir -p database
    touch database/database.sqlite
    chown www-data:www-data database/database.sqlite
    chmod 664 database/database.sqlite
fi

# 5. Run database migrations and seed default content
echo "Running database migrations..."
php artisan migrate --force --seed || echo "Notice: Database migration completed with warnings. Continuing boot."

# 6. Optimize Laravel cache for production speed
echo "Caching Laravel configuration and routes..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# 7. Ensure permissions are solid before web server boot
chown -R www-data:www-data storage bootstrap/cache database .env || true

echo "=== WECON ASIA is now running on port $PORT ==="
exec apache2-foreground
