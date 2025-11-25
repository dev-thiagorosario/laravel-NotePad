# ===============================
# Dockerfile - Laravel NotePad
# Ambiente: PHP 8.3-FPM (Alpine) + PostgreSQL + Composer
# ===============================

FROM php:8.3-fpm-alpine

# Argumentos de usuário/grupo para evitar problemas de permissão
ARG PUID=1000
ARG PGID=1000

# Instala pacotes e dependências necessárias
RUN apk add --no-cache \
    bash git curl unzip nano icu-dev libzip-dev oniguruma-dev postgresql-dev \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    linux-headers build-base $PHPIZE_DEPS netcat-openbsd

# Extensões PHP com suporte a GD, Intl, PostgreSQL etc.
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) \
    intl mbstring pdo pdo_pgsql bcmath exif pcntl gd opcache zip

# Instala e ativa Redis (opcional, mas útil)
RUN pecl install redis \
 && docker-php-ext-enable redis

# (Opcional) remove ferramentas de build para reduzir tamanho final
RUN apk del --no-network $PHPIZE_DEPS build-base linux-headers || true

# Copia o Composer da imagem oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia apenas manifestos para cachear dependências
COPY composer.json composer.lock* ./

# Copia o entrypoint responsável por executar tarefas antes do PHP-FPM
COPY docker/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Instala dependências do PHP
RUN composer install --no-interaction --prefer-dist --no-scripts

# Copia todo o projeto
COPY . .

# Ajusta permissões e cria usuário sem root
RUN addgroup -g ${PGID} appgroup \
 && adduser -D -G appgroup -u ${PUID} appuser \
 && mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
 && chown -R appuser:appgroup /var/www/html

USER appuser

# Expõe a porta do PHP-FPM
EXPOSE 9000

# Executa migrações antes de iniciar o PHP-FPM
ENTRYPOINT ["docker-entrypoint.sh"]

# Comando de inicialização
CMD ["php-fpm", "-F"]
