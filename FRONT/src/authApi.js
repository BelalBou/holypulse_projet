import axios from 'axios'
import Cookies from 'js-cookie' // ← Assure-toi d'avoir fait : npm install js-cookie

// Utilise la variable d'environnement ou localhost en développement
const baseURL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000'

const api = axios.create({
  baseURL: baseURL, // pour les routes auth directes
  timeout: 5000,
  withCredentials: true,
})


// Injecte automatiquement le token CSRF dans les requêtes
api.interceptors.request.use(config => {
  const token = Cookies.get('XSRF-TOKEN')
  if (token) {
    config.headers['X-XSRF-TOKEN'] = decodeURIComponent(token)
  }
  return config
})

export default api
