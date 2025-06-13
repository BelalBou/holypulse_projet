# Dockerfile optimisé pour Render
FROM php:8.2-fpm

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

# Installation des extensions PHP nécessaires
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers composer et installer les dépendances
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copier tout le code source
COPY . .

# Copier le fichier .env de production
COPY .env.production .env

# Définir les permissions appropriées
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Créer les répertoires de cache Laravel
RUN mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views

# Générer une clé d'application avec la clé pré-configurée
RUN echo 'APP_KEY=base64:QmF0dGVyeUJlYXV0aWZ1bEVuZXJneTIwMjUhSG9seVB1bHNl' >> .env

# Optimisations Laravel (ignorer les erreurs)
RUN php artisan config:cache || true

# Copier et rendre exécutable le script d'entrée
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Exposer le port
EXPOSE 8000

# Utiliser le script d'entrée
ENTRYPOINT ["docker-entrypoint.sh"]
