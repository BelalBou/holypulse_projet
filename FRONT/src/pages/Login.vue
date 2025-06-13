<template>
  <div class="mobile-frame">

    <div class="login-container">

      <img src="../assets/img/logo-holypulse.png" alt="Logo HolyPulse" class="logo" />

      <form class="login-form" @submit.prevent="handleLogin">
        <h2>Connexion</h2>

        <input
          v-model="email"
          type="email"
          placeholder="Adresse e-mail"
          class="input-field"
          required
        />

        <input
          v-model="password"
          type="password"
          placeholder="Mot de passe"
          class="input-field"
          required
        />

        <button type="submit" class="btn-primary">Se connecter</button>

        <p v-if="error" class="error-msg">{{ error }}</p>
      </form>
          <div class="return-button">
      <img src="../assets/img/back.svg" @click="goBack" />
    </div>
    </div>
    
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import authApi from '../authApi' // ← doit être bien configuré avec baseURL

const email = ref('')
const password = ref('')
const error = ref(null)
const router = useRouter()

const handleLogin = async () => {
  error.value = null

  try {
    // 1. Init CSRF
    await authApi.get('/sanctum/csrf-cookie')

    // 2. Login
    await authApi.post('/login', {
      email: email.value,
      password: password.value
    })

    // 3. Redirige
    router.push('/dashboard')
  } catch (err) {
    error.value = 'Identifiants invalides. Vérifie ton e-mail et mot de passe.'
    // console.error(err)
  }
}

function goBack() {
    router.push('/') // ou selon ton nom de route
  }
</script>

<style scoped src="../assets/css/login.css"></style>
