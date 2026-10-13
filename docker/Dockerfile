# Local development image for damasmc.com — matches production: PHP 8.2 + Apache + mod_rewrite.
# (Production vendor/ requires PHP >= 8.2; PHP 8.1 fails with "Composer detected issues in your platform".)
FROM php:8.2-apache

RUN apt-get update \
 && apt-get install -y --no-install-recommends git unzip libzip-dev libicu-dev libpng-dev libjpeg-dev libwebp-dev libfreetype6-dev default-mysql-client \
 && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
 && docker-php-ext-install -j"$(nproc)" pdo_mysql mysqli intl zip gd opcache \
 && a2enmod rewrite headers expires deflate \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php-local.ini /usr/local/etc/php/conf.d/zz-local.ini

WORKDIR /var/www/html
