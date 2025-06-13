#!/bin/bash

echo "🚀 Configuration Git et push vers GitHub"

# Vérifier si git est initialisé
if [ ! -d ".git" ]; then
    echo "Initialisation de Git..."
    git init
fi

echo "📝 Ajout des fichiers au commit..."
git add .

echo "💾 Création du commit..."
git commit -m "Initial commit: Laravel + Vue.js app with Docker configuration for Render"

echo "🌐 Pour pousser vers GitHub, vous devez :"
echo "1. Créer un nouveau repository sur https://github.com"
echo "2. Copier l'URL du repository"
echo "3. Exécuter les commandes suivantes :"
echo ""
echo "   git remote add origin https://github.com/VOTRE_USERNAME/VOTRE_REPO.git"
echo "   git branch -M main"
echo "   git push -u origin main"
echo ""
echo "Ou si vous préférez SSH :"
echo "   git remote add origin git@github.com:VOTRE_USERNAME/VOTRE_REPO.git"
echo "   git branch -M main" 
echo "   git push -u origin main"
echo ""
echo "📋 Après avoir créé le repository GitHub, exécutez :"
echo "   ./setup-github.sh VOTRE_USERNAME VOTRE_REPO"
