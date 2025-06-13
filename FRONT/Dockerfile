FROM node:18-alpine

# Installer les dépendances système
RUN apk add --no-cache git

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers package
COPY package*.json ./

# Installation des dépendances
RUN npm install

# Copier le code source
COPY . .

# Construire l'application pour la production
RUN npm run build

# Installer un serveur HTTP simple pour servir les fichiers statiques
RUN npm install -g serve

# Exposer le port
EXPOSE 3000

# Commande pour démarrer l'application
CMD ["serve", "-s", "dist", "-l", "3000"]
