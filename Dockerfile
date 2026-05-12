FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev \
    libxml2-dev libzip-dev \
    && docker-php-ext-install \
    pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g 1000 www \
    && useradd -u 1000 -ms /bin/bash -g www www

WORKDIR /var/www

COPY --chown=www:www . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader 2>/dev/null || true

RUN chown -R www:www /var/www

USER www

EXPOSE 9000
CMD ["php-fpm"]