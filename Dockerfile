FROM php:8.3-cli

WORKDIR /workspace

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    sqlite3 \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_sqlite sqlite3

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && mkdir -p database \
    && touch database/database.sqlite

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]