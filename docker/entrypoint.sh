#!/bin/sh
set -eu

cd /app
mkdir -p /data var/cache var/log var/share

if [ -z "${APP_SECRET:-}" ]; then
    echo "APP_SECRET manquant. À définir dans Dokploy, pas dans Git." >&2
    exit 1
fi

if [ -z "${ADMIN_PASSWORD_HASH:-}" ]; then
    echo "ADMIN_PASSWORD_HASH manquant. À définir dans Dokploy, pas dans Git." >&2
    exit 1
fi

php bin/console cache:warmup --no-debug
php bin/console doctrine:migrations:migrate --no-interaction --all-or-nothing

exec frankenphp run --config /etc/frankenphp/Caddyfile --adapter caddyfile
