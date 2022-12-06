#!/usr/bin/env sh
set -e

php artisan optimize:clear
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisn migrate

# Start cron daemon.
crond -b -l 8

# Start PHP FPM
php-fpm -D

# Run Nginx
nginx -g 'daemon off;'
