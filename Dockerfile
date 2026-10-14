FROM php:8.4-cli-bookworm

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libonig-dev \
    libxml2-dev libsqlite3-dev \
    && docker-php-ext-install \
    pdo_sqlite mbstring bcmath intl zip xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

COPY . .

RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
    && touch database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache \
    && chmod 664 database/database.sqlite

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/app/database/database.sqlite
ENV SESSION_DRIVER=file
ENV CACHE_STORE=file
ENV QUEUE_CONNECTION=sync

 EXPOSE 8080/tcp

CMD ["sh", "-c", "php artisan migrate --force || exit 1; php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
