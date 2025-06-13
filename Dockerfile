# Dockerfile pour HolyPulse - Backend Laravel avec PHP built-in server
FROM php:8.2-cli

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Installation des extensions PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration du répertoire de travail
WORKDIR /var/www/html

# Copier tout le code Laravel d'abord
COPY BACK/ ./

# Installer les dépendances avec --no-scripts pour éviter les erreurs
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# Permissions Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Créer les répertoires Laravel nécessaires
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views

# Copier et configurer le script d'entrée
RUN cp docker-entrypoint.sh /usr/local/bin/ && chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["docker-entrypoint.sh"]
