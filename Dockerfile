FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip npm \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN php artisan config:cache

EXPOSE 8080

CMD php artisan migrate --force && php -S 0.0.0.0:8080 -t public