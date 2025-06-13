#!/bin/bash

if [ $# -ne 2 ]; then
    echo "Usage: $0 <username> <repository>"
    echo "Exemple: $0 belal holypulse"
    exit 1
fi

USERNAME=$1
REPO=$2

echo "🔗 Configuration du dépôt distant GitHub..."

# Ajouter le remote origin
git remote add origin https://github.com/$USERNAME/$REPO.git

# Renommer la branche en main
git branch -M main

# Pousser vers GitHub
echo "📤 Push vers GitHub..."
git push -u origin main

echo "✅ Projet poussé vers https://github.com/$USERNAME/$REPO"
echo ""
echo "🚀 Prochaines étapes pour Render :"
echo "1. Connectez votre repository GitHub à Render"
echo "2. Utilisez le fichier render.yaml pour le déploiement automatique"
echo "3. Ou créez manuellement :"
echo "   - Un Web Service pour le backend (utilise Dockerfile.render.backend)"
echo "   - Un Static Site pour le frontend"
echo "   - Une base de données PostgreSQL"
