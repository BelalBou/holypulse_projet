import axios from 'axios'
import Cookies from 'js-cookie' // ← Assure-toi d’avoir fait : npm install js-cookie


const api = axios.create({
  baseURL: 'http://localhost:8000/api', // pour /api/... (ex: verses, likes, etc.)
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
