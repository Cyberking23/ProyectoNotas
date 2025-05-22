#!/bin/bash

# Start MySQL
service mysql start

# Setup MySQL if not already initialized
if [ ! -d "/var/lib/mysql/laravel" ]; then
    echo "Initializing MySQL..."
    mysql -u root <<-EOSQL
        CREATE DATABASE IF NOT EXISTS ${MYSQL_DATABASE};
        CREATE USER IF NOT EXISTS '${MYSQL_USER}'@'localhost' IDENTIFIED BY '${MYSQL_PASSWORD}';
        GRANT ALL PRIVILEGES ON ${MYSQL_DATABASE}.* TO '${MYSQL_USER}'@'localhost';
        FLUSH PRIVILEGES;
EOSQL
fi

# Run Laravel migrations if needed
cd /var/www/html
if [ -f artisan ]; then
    php artisan config:clear
    php artisan migrate --force || true
fi

# Start supervisord (Apache + MySQL)
exec /usr/bin/supervisord -n
