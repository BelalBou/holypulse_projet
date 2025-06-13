#!/bin/bash
set -e

# Attendre que la base de données soit prête
echo "Waiting for database..."
while ! nc -z $DB_HOST $DB_PORT; do
  sleep 1
done
echo "Database is ready!"

# Générer la clé d'application si elle n'existe pas
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:YOUR_GENERATED_KEY_HERE" ]; then
    php artisan key:generate --force
fi

# Exécuter les migrations
php artisan migrate --force

# Nettoyer et reconstruire le cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrer le serveur
exec php artisan serve --host=0.0.0.0 --port=8000
