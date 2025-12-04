FROM php:8.3-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


COPY . .

# 6. Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# 7. Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

CMD ["php-fpm"]
