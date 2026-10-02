# syntax=docker/dockerfile:1

FROM node:22-bookworm-slim AS frontend

WORKDIR /src
COPY frontend/package.json frontend/package-lock.json ./
RUN npm ci
COPY frontend/ ./
RUN npm run build

FROM dunglas/frankenphp:1-php8.4

WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN install-php-extensions intl opcache zip \
    && apt-get update \
    && apt-get install -y --no-install-recommends unzip \
    && rm -rf /var/lib/apt/lists/*

COPY docker/php.ini /usr/local/etc/php/conf.d/alseq.ini
COPY backend/composer.json backend/composer.lock backend/symfony.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction

COPY backend/ ./
COPY --from=frontend /src/dist/ ./public/
RUN composer dump-autoload --optimize --classmap-authoritative --no-dev \
    && mkdir -p var/cache var/log var/share /data \
    && chown -R www-data:www-data var /data

COPY docker/Caddyfile /etc/frankenphp/Caddyfile
COPY docker/entrypoint.sh /usr/local/bin/app-entrypoint
RUN chmod +x /usr/local/bin/app-entrypoint

ENV APP_ENV=prod \
    SERVER_NAME=:80

EXPOSE 80
VOLUME /data

HEALTHCHECK --interval=30s --timeout=5s --start-period=40s --retries=3 \
    CMD curl -fsS http://127.0.0.1/ >/dev/null || exit 1

CMD ["app-entrypoint"]
