import axios from 'axios'

// TEMPORAIRE : Hard-codé pour éviter les problèmes Vercel
const baseURL = 'https://holypulse-projet.onrender.com'
// const baseURL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000'

const api = axios.create({
  baseURL: baseURL,
  timeout: 30000, // Augmenté à 30 secondes pour les cold starts de Render
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
