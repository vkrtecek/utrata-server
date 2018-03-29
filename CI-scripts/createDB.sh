#!/bin/bash

if [ ! -f ".env" ]; then
    cp .env.example .env
    sed -i 's|^APP_ENV=.*$|APP_ENV=testing|' .env
fi

php artisan migrate --database=sqlite
php artisan db:seed --database=sqlite
