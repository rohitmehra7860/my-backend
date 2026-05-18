FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev \
    libxml2-dev libzip-dev \
    libicu-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
    && docker-php-ext-install \
    pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

RUN groupadd -g 1000 www \
    && useradd -u 1000 -ms /bin/bash -g www www

WORKDIR /var/www

COPY --chown=www:www . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader 2>/dev/null || true

RUN chown -R www:www /var/www

USER www

EXPOSE 9000
CMD ["php-fpm"]