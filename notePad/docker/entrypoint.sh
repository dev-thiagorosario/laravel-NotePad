#!/bin/sh

set -e

DB_HOST=${DB_HOST:-db}
DB_PORT=${DB_PORT:-5432}
DB_DATABASE=${DB_DATABASE:-notepad}
DB_USERNAME=${DB_USERNAME:-notepad}
DB_PASSWORD=${DB_PASSWORD:-secret}

echo "Waiting for PostgreSQL at ${DB_HOST}:${DB_PORT}..."

cat <<'PHP' >/tmp/wait-for-db.php
<?php
$host = getenv('DB_HOST') ?: 'db';
$port = getenv('DB_PORT') ?: '5432';
$database = getenv('DB_DATABASE') ?: 'notepad';
$username = getenv('DB_USERNAME') ?: 'notepad';
$password = getenv('DB_PASSWORD') ?: 'secret';
$dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $database);
try {
    new PDO($dsn, $username, $password, [PDO::ATTR_TIMEOUT => 1, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    exit(0);
} catch (Throwable $e) {
    usleep(500000);
    exit(1);
}
PHP

until DB_HOST="$DB_HOST" DB_PORT="$DB_PORT" DB_DATABASE="$DB_DATABASE" DB_USERNAME="$DB_USERNAME" DB_PASSWORD="$DB_PASSWORD" php /tmp/wait-for-db.php; do
    echo "PostgreSQL ainda não está respondendo..."
    sleep 1
done

rm /tmp/wait-for-db.php

if [ "${SKIP_AUTOMIGRATE:-0}" != "1" ]; then
    set +e
    php artisan migrate --force --no-interaction
    MIGRATION_EXIT=$?
    set -e

    if [ "$MIGRATION_EXIT" -ne 0 ]; then
# shellcheck disable=SC2016
        echo "WARNING: automatic migrations failed (exit ${MIGRATION_EXIT}). Review the stack trace above."
    fi
else
    echo "Skipping automatic migrations because SKIP_AUTOMIGRATE=${SKIP_AUTOMIGRATE}."
fi

exec "$@"
