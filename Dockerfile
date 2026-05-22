FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

RUN apt-get update && apt-get install -y nodejs npm && npm install && npm run build && rm -rf /var/lib/apt/lists/*

RUN chown -R www-data:www-data storage bootstrap/cache

RUN if [ ! -f .env ]; then cp .env.example .env; fi
RUN php artisan key:generate || true

EXPOSE 8080

CMD sh -c "echo 'Starting migrations...' && php artisan migrate --force && echo 'Migrations complete' && php artisan serve --host=0.0.0.0 --port=8080"
