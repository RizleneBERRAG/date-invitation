#!/bin/sh
set -eu

DB_FILE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"

mkdir -p \
    "$(dirname "$DB_FILE")" \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

touch "$DB_FILE"
chmod -R 775 storage bootstrap/cache database

php artisan optimize:clear
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache

exec php artisan serve \
    --host=0.0.0.0 \
    --port="${PORT:-10000}"
