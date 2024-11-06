FROM php:8.3-fpm

WORKDIR /var/www/html

COPY . /var/www/html



RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    supervisor \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY .docker/supervisord/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN composer install --no-dev --optimize-autoloader

EXPOSE 9000
USER www-data
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
