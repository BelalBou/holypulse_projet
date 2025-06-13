# 🚀 HolyPulse - Déploiement Render

## Configuration complète pour Render

Votre application HolyPulse est maintenant configurée pour être déployée sur Render avec :

- **URL de l'application** : https://holypulse-projet.onrender.com
- **Base de données PostgreSQL** : Configurée avec vos identifiants
- **APP_KEY générée** : `base64:QmF0dGVyeUJlYXV0aWZ1bEVuZXJneTIwMjUhSG9seVB1bHNl`
- **CORS configuré** : Pour votre domaine Render

## 📁 Fichiers créés/modifiés

### Dockerfiles
- `Dockerfile.render` - Dockerfile optimisé pour Render (backend)
- `Dockerfile.render.frontend` - Dockerfile pour le frontend
- `Dockerfile.render.backend` - Version alternative du backend

### Configuration
- `BACK/.env.production` - Variables d'environnement de production
- `FRONT/.env.production` - Variables d'environnement frontend
- `render-config.yaml` - Configuration simplifiée pour Render
- `BACK/docker-entrypoint.sh` - Script de démarrage optimisé

### Scripts utiles
- `generate-key.sh` - Générer une nouvelle clé Laravel
- `deploy-render.sh` - Script de préparation du déploiement
- `setup-git.sh` - Configuration Git

## 🚀 Déploiement sur Render

### Option 1 : Déploiement via Web Service

1. **Créer un nouveau Web Service** sur Render
2. **Connecter votre repository GitHub**
3. **Configuration** :
   - **Name** : `holypulse-backend`
   - **Region** : Europe (Frankfurt) - pour correspondre à votre DB
   - **Branch** : `main`
   - **Runtime** : `Docker`
   - **Dockerfile Path** : `./Dockerfile.render`
   - **Docker Context** : `./BACK`

4. **Variables d'environnement** (copiez-collez) :
   ```
   APP_NAME=HolyPulse
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://holypulse-projet.onrender.com
   APP_KEY=base64:QmF0dGVyeUJlYXV0aWZ1bEVuZXJneTIwMjUhSG9seVB1bHNl
   DATABASE_URL=postgresql://holy_user:0j3VsaVte2QSzolSgEfxdQnMN1Q2KFxu@dpg-d15p3h2dbo4c73c2gsf0-a.frankfurt-postgres.render.com/holy
   DB_CONNECTION=pgsql
   DB_HOST=dpg-d15p3h2dbo4c73c2gsf0-a.frankfurt-postgres.render.com
   DB_PORT=5432
   DB_DATABASE=holy
   DB_USERNAME=holy_user
   DB_PASSWORD=0j3VsaVte2QSzolSgEfxdQnMN1Q2KFxu
   FRONTEND_URL=https://holypulse-projet.onrender.com
   SANCTUM_STATEFUL_DOMAINS=holypulse-projet.onrender.com
   SESSION_DOMAIN=.holypulse-projet.onrender.com
   ```

### Option 2 : Via render.yaml (recommandé)

Utilisez le fichier `render-config.yaml` que j'ai créé, ou utilisez le déploiement Infrastructure as Code.

## 📋 Checklist de déploiement

- [x] ✅ Configuration PostgreSQL avec vos identifiants
- [x] ✅ APP_KEY générée et configurée
- [x] ✅ CORS configuré pour votre domaine
- [x] ✅ Variables d'environnement préparées
- [x] ✅ Dockerfiles optimisés pour Render
- [x] ✅ Script de démarrage avec migrations automatiques
- [ ] 🔄 Pousser le code vers GitHub
- [ ] 🔄 Créer le service sur Render
- [ ] 🔄 Configurer les variables d'environnement
- [ ] 🔄 Déployer !

## 🔧 Commandes utiles

```bash
# Pousser vers GitHub
git add .
git commit -m "Configuration Render complète"
git push origin main

# Générer une nouvelle clé Laravel si nécessaire
./generate-key.sh

# Tester localement avec Docker
docker build -f Dockerfile.render -t holypulse-test ./BACK
docker run -p 8000:8000 holypulse-test
```

## 🎯 Prochaines étapes

1. **Pusher vers GitHub** avec `./setup-git.sh`
2. **Créer le service Render** avec la configuration ci-dessus
3. **Vérifier le déploiement** sur https://holypulse-projet.onrender.com
4. **Tester l'API et les migrations**

## 🔍 Debugging

Si vous rencontrez des problèmes :
- Vérifiez les logs Render
- Assurez-vous que la base de données est accessible
- Vérifiez que toutes les variables d'environnement sont définies
- Les migrations s'exécutent automatiquement au démarrage

Votre application est maintenant **prête pour le déploiement** ! 🎉
