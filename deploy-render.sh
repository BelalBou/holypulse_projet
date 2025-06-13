#!/bin/bash

# Script pour préparer le déploiement sur Render

echo "🚀 Préparation du déploiement Render pour HolyPulse"

# Vérifier si nous sommes dans le bon répertoire
if [ ! -f "docker-compose.yml" ]; then
    echo "❌ Erreur: Ce script doit être exécuté depuis la racine du projet"
    exit 1
fi

# Créer le répertoire de build s'il n'existe pas
mkdir -p build

echo "📦 Construction des images Docker..."

# Construire l'image backend
echo "🔧 Construction de l'image backend..."
docker build -f Dockerfile.render.backend -t holypulse-backend ./BACK

# Construire l'image frontend
echo "🎨 Construction de l'image frontend..."
docker build -f Dockerfile.render.frontend -t holypulse-frontend ./FRONT

echo "✅ Images Docker construites avec succès!"

# Générer une clé Laravel si nécessaire
echo "🔑 Génération de la clé Laravel..."
cd BACK
if [ ! -f ".env" ]; then
    cp .env.production .env
fi

# Installer les dépendances si nécessaire
if [ ! -d "vendor" ]; then
    echo "📥 Installation des dépendances Laravel..."
    composer install --no-dev --optimize-autoloader
fi

# Générer la clé
php artisan key:generate --force

# Afficher la clé générée
echo "🔑 Clé Laravel générée:"
grep APP_KEY .env

cd ..

echo "✅ Préparation terminée!"
echo ""
echo "📋 Prochaines étapes pour Render:"
echo "1. Créer un service Web pour le backend avec Dockerfile.render.backend"
echo "2. Créer un site statique pour le frontend avec Dockerfile.render.frontend"
echo "3. Créer une base de données PostgreSQL"
echo "4. Configurer les variables d'environnement (voir README-RENDER.md)"
echo "5. Mettre à jour les URLs dans les fichiers de configuration"
echo ""
echo "📖 Consultez README-RENDER.md pour plus de détails"
