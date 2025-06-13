#!/bin/bash

echo "🔧 Génération de la clé Laravel..."

cd BACK

# S'assurer que le fichier .env existe
if [ ! -f ".env" ]; then
    cp .env.production .env
fi

# Installer les dépendances si nécessaire
if [ ! -d "vendor" ]; then
    echo "📦 Installation des dépendances..."
    composer install --no-dev
fi

# Générer une nouvelle clé
echo "🔑 Génération d'une nouvelle clé..."
php artisan key:generate --show

# Mettre à jour le fichier .env.production avec la nouvelle clé
NEW_KEY=$(php artisan key:generate --show)
echo "✅ Nouvelle clé générée: $NEW_KEY"

# Remplacer dans .env.production
sed -i "s|APP_KEY=.*|APP_KEY=$NEW_KEY|g" .env.production

echo "✅ Fichier .env.production mis à jour!"
echo "📋 N'oubliez pas de mettre à jour cette clé dans vos variables d'environnement Render"

cd ..

echo "🚀 Prêt pour le déploiement!"
