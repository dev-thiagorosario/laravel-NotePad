#!/bin/sh

set -e

# Run database migrations to ensure required tables (sessions, jobs, etc.) exist.
php artisan migrate --force --no-interaction

exec "$@"
