#!/bin/bash

php artisan migrate --database=sqlite
php artisan db:seed --database=sqlite
