# 🚨 CONFIGURATION VERCEL - Variables d'Environnement

## Problème Identifié :
Votre frontend fait encore des requêtes vers :
```
https://holypulse-projet.vercel.app/api/register ❌
```

Au lieu de :
```
https://holypulse-projet.onrender.com/api/register ✅
```

## 🔧 SOLUTION - Dashboard Vercel :

### 1. Aller sur le Dashboard Vercel :
https://vercel.com/dashboard

### 2. Sélectionner votre projet :
`holypulse-projet` ou `holypulse-projet-l80s01nuw-belalbous-projects`

### 3. Aller dans Settings :
`Settings` → `Environment Variables`

### 4. Ajouter ces variables :
```
Nom: VITE_API_BASE_URL
Valeur: https://holypulse-projet.onrender.com
Environnement: Production ✓
```

```
Nom: VITE_APP_URL  
Valeur: https://holypulse-projet-l80s01nuw-belalbous-projects.vercel.app
Environnement: Production ✓
```

### 5. REDÉPLOYER :
Après avoir ajouté les variables :
- Aller dans `Deployments`
- Cliquer sur `Redeploy` sur le dernier déploiement
- OU faire un nouveau commit/push

## 🧪 Vérification après redéploiement :
Dans la console du navigateur, vous devriez voir des requêtes vers :
```
https://holypulse-projet.onrender.com/api/register
```

## ⚡ Alternative Rapide :
Si ça ne marche pas, modifier directement le code en dur temporairement :

Dans `FRONT/src/api.js` et `FRONT/src/authApi.js` :
```javascript
const baseURL = 'https://holypulse-projet.onrender.com'
```
