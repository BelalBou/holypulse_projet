# Dockerfile pour Frontend Vue.js
FROM node:18-alpine as build-stage

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers package
COPY package*.json ./

# Installation des dépendances
RUN npm ci --only=production

# Copier le code source
COPY . .

# Copier le fichier d'environnement de production
COPY .env.production .env

# Construire l'application pour la production
RUN npm run build

# Stage de production avec Nginx
FROM nginx:alpine

# Copier les fichiers buildés
COPY --from=build-stage /app/dist /usr/share/nginx/html

# Configuration Nginx pour Vue.js SPA
RUN echo 'server { \
    listen 80; \
    server_name localhost; \
    root /usr/share/nginx/html; \
    index index.html; \
    \
    # Gérer les routes Vue.js (SPA) \
    location / { \
        try_files $uri $uri/ /index.html; \
    } \
    \
    # Cache des assets \
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ { \
        expires 1y; \
        add_header Cache-Control "public, immutable"; \
    } \
    \
    # Headers de sécurité \
    add_header X-Frame-Options "SAMEORIGIN" always; \
    add_header X-Content-Type-Options "nosniff" always; \
    add_header X-XSS-Protection "1; mode=block" always; \
}' > /etc/nginx/conf.d/default.conf

# Exposer le port
EXPOSE 80

# Démarrer Nginx
CMD ["nginx", "-g", "daemon off;"]
