# 🚀 Guide de Déploiement - Backend Render + Frontend Vercel

## 🔴 BACKEND LARAVEL SUR RENDER

### Configuration sur Render Dashboard :

1. **Nouveau Web Service** depuis votre repo GitHub
2. **Configuration :**
   ```
   Name: holypulse-backend
   Region: Europe (Frankfurt)
   Branch: master
   Root Directory: BACK
   Runtime: Docker
   ```

3. **Variables d'environnement :**
   ```bash
   APP_NAME=HolyPulse
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://holypulse-backend.onrender.com
   APP_KEY=base64:QmF0dGVyeUJlYXV0aWZ1bEVuZXJneTIwMjUhSG9seVB1bHNl
   
   # Base de données PostgreSQL
   DATABASE_URL=postgresql://holy_user:0j3VsaVte2QSzolSgEfxdQnMN1Q2KFxu@dpg-d15p3h2dbo4c73c2gsf0-a.frankfurt-postgres.render.com/holy
   DB_CONNECTION=pgsql
   DB_HOST=dpg-d15p3h2dbo4c73c2gsf0-a.frankfurt-postgres.render.com
   DB_PORT=5432
   DB_DATABASE=holy
   DB_USERNAME=holy_user
   DB_PASSWORD=0j3VsaVte2QSzolSgEfxdQnMN1Q2KFxu
   
   # CORS pour Vercel
   FRONTEND_URL=https://holypulse-front.vercel.app
   SANCTUM_STATEFUL_DOMAINS=holypulse-front.vercel.app
   SESSION_DOMAIN=.vercel.app
   ```

## 🔵 FRONTEND VUE.JS SUR VERCEL

### Configuration sur Vercel Dashboard :

1. **Nouveau projet** depuis votre repo GitHub
2. **Configuration :**
   ```
   Framework Preset: Vue.js
   Root Directory: FRONT
   Build Command: npm run build
   Output Directory: dist
   Install Command: npm install
   ```

3. **Variables d'environnement :**
   ```bash
   VITE_API_BASE_URL=https://holypulse-backend.onrender.com
   VITE_APP_URL=https://holypulse-front.vercel.app
   ```

## ✅ CE QUI A ÉTÉ CONFIGURÉ

### Backend (Laravel) :
- ✅ Dockerfile optimisé avec Apache
- ✅ Migrations automatiques au démarrage
- ✅ Configuration PostgreSQL
- ✅ CORS configuré pour Vercel (*.vercel.app)
- ✅ APP_KEY générée
- ✅ Cache Laravel optimisé

### Frontend (Vue.js) :
- ✅ Configuration Vercel (vercel.json)
- ✅ Script de build pour Vercel
- ✅ Variables d'environnement configurées
- ✅ Routing SPA géré

## 🎯 URLS FINALES

- **Backend API :** https://holypulse-backend.onrender.com
- **Frontend :** https://holypulse-front.vercel.app

## 🚀 DÉPLOIEMENT

1. **Pusher le code :**
   ```bash
   git add .
   git commit -m "Configuration séparée: Backend Render + Frontend Vercel"
   git push origin master
   ```

2. **Déployer le backend sur Render** avec la configuration ci-dessus
3. **Déployer le frontend sur Vercel** avec la configuration ci-dessus

## 🔧 VÉRIFICATIONS

- Backend : `https://holypulse-backend.onrender.com/api/health`
- Frontend : `https://holypulse-front.vercel.app`
- CORS : Testez une requête API depuis le frontend

---

**Note :** Les migrations s'exécutent automatiquement au démarrage du backend !
