#!/bin/bash

echo "🚀 DÉPLOIEMENT IMMÉDIAT - HolyPulse"
echo "=================================="
echo ""

echo "✅ PROBLÈME APP_KEY RÉSOLU!"
echo "🔑 Clé corrigée: base64:sTg0GqM5zrvI3duSC+VsTRi2L6o2weGfNW3BM6Mriqo="
echo ""

echo "📋 ÉTAPES POUR DÉPLOYER:"
echo "========================"
echo ""

echo "1️⃣ COMMIT & PUSH:"
echo "   git add ."
echo "   git commit -m 'Fix: APP_KEY format corrected for Laravel'"
echo "   git push"
echo ""

echo "2️⃣ RENDER DEPLOYMENT:"
echo "   • Aller sur https://dashboard.render.com"
echo "   • Créer un nouveau Web Service"
echo "   • Connecter votre repo GitHub"
echo "   • Configuration:"
echo "     - Name: holypulse-backend"
echo "     - Branch: main (ou master)"
echo "     - Runtime: Docker"
echo "     - Root Directory: (laisser vide)"
echo ""

echo "3️⃣ VARIABLES D'ENVIRONNEMENT RENDER:"
echo "====================================="
echo "COPIEZ-COLLEZ CES VARIABLES UNE PAR UNE:"
echo ""
echo "APP_NAME=HolyPulse"
echo "APP_ENV=production"
echo "APP_DEBUG=true"
echo "APP_URL=https://holypulse-projet.onrender.com"
echo "APP_KEY=base64:sTg0GqM5zrvI3duSC+VsTRi2L6o2weGfNW3BM6Mriqo="
echo ""
echo "DATABASE_URL=postgresql://holy_user:0j3VsaVte2QSzolSgEfxdQnMN1Q2KFxu@dpg-d15p3h2dbo4c73c2gsf0-a.frankfurt-postgres.render.com/holy"
echo ""
echo "DB_CONNECTION=pgsql"
echo "DB_HOST=dpg-d15p3h2dbo4c73c2gsf0-a.frankfurt-postgres.render.com"
echo "DB_PORT=5432"
echo "DB_DATABASE=holy"
echo "DB_USERNAME=holy_user"
echo "DB_PASSWORD=0j3VsaVte2QSzolSgEfxdQnMN1Q2KFxu"
echo ""
echo "FRONTEND_URL=https://holypulse-projet-l80s01nuw-belalbous-projects.vercel.app"
echo ""

echo "4️⃣ TESTS APRÈS DÉPLOIEMENT:"
echo "============================"
echo "✓ https://holypulse-projet.onrender.com/"
echo "  ➜ Doit retourner: {'message':'HolyPulse API is running!','status':'success'}"
echo ""
echo "✓ https://holypulse-projet.onrender.com/health"
echo "  ➜ Doit retourner: {'status':'ok'}"
echo ""
echo "✓ https://holypulse-projet.onrender.com/api/test"
echo "  ➜ Doit retourner: {'message':'API is working!'}"
echo ""

echo "🔥 PRÊT À DÉPLOYER!"
echo "==================="
echo "Tout est configuré avec la bonne clé APP_KEY."
echo "Plus d'erreur 'Unsupported cipher'!"
