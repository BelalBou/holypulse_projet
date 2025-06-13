import axios from 'axios'

// Utilise les variables d'environnement
const baseURL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000'

const api = axios.create({
  baseURL: `${baseURL}/api`, // pour /api/... (ex: verses, likes, etc.)
  timeout: 30000, // Augmenté pour les cold starts de Render
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  }
})

// Interceptor pour ajouter le token Bearer aux requêtes
api.interceptors.request.use(config => {
  const token = localStorage.getItem('holypulse_token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

// Interceptor pour gérer les erreurs d'authentification
api.interceptors.response.use(
  response => response,
  error => {
    if (error.response?.status === 401) {
      // Token expiré ou invalide
      localStorage.removeItem('holypulse_token')
      localStorage.removeItem('holypulse_user')
      window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

export default api
