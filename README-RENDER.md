# Guide de déploiement sur Render

## Configuration pour Render

### 1. Backend (Laravel)

1. **Créer un nouveau Web Service sur Render**
   - Connect your GitHub repository
   - Build Command: `docker build -f Dockerfile.render.backend -t holypulse-backend .`
   - Start Command: `docker run -p 8000:8000 holypulse-backend`

2. **Variables d'environnement à configurer sur Render :**
   ```
   APP_NAME=HolyPulse
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-backend-url.onrender.com
   
   DB_CONNECTION=postgresql
   DB_HOST=your-postgres-host
   DB_PORT=5432
   DB_DATABASE=your-database-name
   DB_USERNAME=your-username
   DB_PASSWORD=your-password
   
   FRONTEND_URL=https://your-frontend-url.onrender.com
   ```

### 2. Frontend (Vue.js)

1. **Créer un nouveau Static Site sur Render**
   - Build Command: `npm install && npm run build`
   - Publish directory: `dist`

2. **Variables d'environnement :**
   ```
   VITE_API_BASE_URL=https://your-backend-url.onrender.com
   ```

### 3. Base de données PostgreSQL

1. **Créer une base de données PostgreSQL sur Render**
   - Utiliser les informations de connexion dans votre backend

### 4. Configuration CORS

Le fichier `config/cors.php` est déjà configuré pour accepter les requêtes de votre frontend.

## Commandes utiles

### Pour tester localement avec Docker :
```bash
# Construire et lancer avec docker-compose
docker-compose -f docker-compose.render.yml up --build

# Ou individuellement :
# Backend
docker build -f Dockerfile.render.backend -t holypulse-backend ./BACK
docker run -p 8000:8000 holypulse-backend

# Frontend
docker build -f Dockerfile.render.frontend -t holypulse-frontend ./FRONT
docker run -p 80:80 holypulse-frontend
```

### Migrations et optimisations Laravel :
```bash
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Structure des fichiers Docker

- `docker-compose.yml` : Configuration locale avec MySQL
- `docker-compose.render.yml` : Configuration optimisée pour Render avec PostgreSQL
- `Dockerfile.render.backend` : Dockerfile optimisé pour le backend sur Render
- `Dockerfile.render.frontend` : Dockerfile optimisé pour le frontend sur Render
- `BACK/.env.production` : Variables d'environnement pour la production
- `FRONT/.env.production` : Variables d'environnement pour le frontend

## Notes importantes

1. **Remplacez les URLs** dans les fichiers de configuration par vos vraies URLs Render
2. **Générez une vraie APP_KEY** avec `php artisan key:generate`
3. **Configurez vos variables d'environnement** sur Render Dashboard
4. **La base de données PostgreSQL** est recommandée pour Render (plus stable que MySQL)
5. **Le volume de base de données** sera géré automatiquement par Render PostgreSQL service
