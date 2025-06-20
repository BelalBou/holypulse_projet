import { createRouter, createWebHistory } from 'vue-router';

import Home from '../pages/Home.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Dashboard from '../pages/Dashboard.vue';
import authApi from '../authApi';
import Account from '../components/account/Account.vue'; // adapte le chemin si nécessaire
import AccountLikes from '../components/account/AccountLikes.vue'; // adapte le chemin si nécessaire
import AccountComments from '../components/account/AccountComments.vue'; // adapte le chemin si nécessaire




const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/login', name: 'Login', component: Login, meta: { requiresAuth: false } },
  { path: '/register', name: 'Register', component: Register },
  { path: '/dashboard', name: 'Dashboard', component: Dashboard, meta: { requiresAuth: true }  }, // ⬅ Protégé
  { path: '/account', name: 'Account', component: Account,},
  { path: '/account/likes', name: 'AccountLikes', component: AccountLikes,},
  { path: '/account/comments', name: 'AccountComments', component: AccountComments,}
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// ✅ Vérification globale avant chaque navigation
router.beforeEach(async (to, from, next) => {
  if (to.meta.requiresAuth) {
    // Vérifier d'abord si on a un token
    const token = localStorage.getItem('holypulse_token')
    if (!token) {
      next('/login')
      return
    }
    
    try {
      await authApi.get('/api/user') // ← Laravel renvoie 401 si non connecté
      next()
    } catch (err) {
      // Token invalide ou expiré
      localStorage.removeItem('holypulse_token')
      localStorage.removeItem('holypulse_user')
      next('/login') // Redirection vers login
    }
  } else {
    next() // Laisse passer si la route ne nécessite pas l'auth
  }
})




export default router;
