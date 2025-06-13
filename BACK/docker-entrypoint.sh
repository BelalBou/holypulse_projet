#!/bin/bash
set -e

echo "🚀 Démarrage de l'application Laravel..."

# Attendre un peu pour que la base de données soit prête
sleep 10

# Générer la clé d'application si elle n'existe pas
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:YOUR_GENERATED_KEY_HERE" ]; then
    echo "🔑 Génération de la clé Laravel..."
    php artisan key:generate --force
fi

# Exécuter les migrations
echo "📊 Exécution des migrations..."
php artisan migrate --force

# Nettoyer et reconstruire le cache
echo "🗄️ Configuration du cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Application Laravel prête!"

# Démarrer le serveur
echo "🌐 Démarrage du serveur sur le port 8000..."
exec php artisan serve --host=0.0.0.0 --port=8000
