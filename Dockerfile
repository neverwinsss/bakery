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

# Entrypoint script
RUN echo '#!/bin/bash\necho "Running migrations..."\nphp /app/artisan migrate --force 2>&1\necho "Starting server..."\nphp /app/artisan serve --host=0.0.0.0 --port=8080' > /entrypoint.sh && chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
