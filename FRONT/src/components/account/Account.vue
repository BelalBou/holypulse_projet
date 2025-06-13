<template>
    <div class="mobile-frame">
      <!-- Header avec bouton retour -->
      <div class="header">
        <img src="/src/assets/img/back.svg" alt="Retour" @click="goBack" />
      </div>

      <div class="logo">
        <img src="../../assets/img/logo_vector.png" alt="Logo HolyPulse" class="logo"/>
      </div>
  
      <!-- Menu -->
      <div class="menu">
        <button @click="goToLikes">Mes Likes</button>
        <button @click="goToComments">Mes Commentaires</button>
      </div>
  
      <!-- Déconnexion -->
      <div class="logout" @click="logout">
        <img src="/src/assets/img/logout.svg" alt="Logout" />
        <span>Déconnexion</span>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useRouter } from 'vue-router'
  import authApi from '../../authApi'

  
  const router = useRouter()
  
  function goBack() {
    router.push('/dashboard') // ou selon ton nom de route
  }
  
  function goToLikes() {
    router.push('/account/likes')
  }
  
  function goToComments() {
    router.push('/account/comments')
  }
  
  async function logout() {
    try {
      await authApi.post('/api/logout')
      
      // Supprimer le token et les données utilisateur du localStorage
      localStorage.removeItem('holypulse_token')
      localStorage.removeItem('holypulse_user')
      
      router.push('/')
    } catch (error) {
      console.error('Erreur de déconnexion', error)
      // Même en cas d'erreur, on nettoie le localStorage et on redirige
      localStorage.removeItem('holypulse_token')
      localStorage.removeItem('holypulse_user')
      router.push('/')
    }
  }
  </script>
  
  <style scoped>
@import url('../../assets/css/account.css');
  </style>
  