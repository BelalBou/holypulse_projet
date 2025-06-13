FROM php:8.2-fpm

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm

# Installation des extensions PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers composer
COPY composer.json composer.lock ./

# Installation des dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copier le code source
COPY . .

# Copier le fichier .env d'exemple
COPY .env.example .env

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Générer la clé d'application
RUN php artisan key:generate

# Créer un script de démarrage
RUN echo '#!/bin/bash\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
php artisan migrate --force\n\
php artisan serve --host=0.0.0.0 --port=8000' > /start.sh

RUN chmod +x /start.sh

EXPOSE 8000

CMD ["/start.sh"]
