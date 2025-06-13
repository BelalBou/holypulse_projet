<template>
  <div class="register mobile-frame">
    <img src="../assets/img/logo-holypulse.png" alt="Logo HolyPulse" class="logo" />
    <h2>Inscription</h2>
    <form class="login-form" @submit.prevent="handleRegister">
      <input type="text" placeholder="Pseudo" v-model="name" class="input-field" />
      <input type="email" placeholder="Adresse e-mail" v-model="email" class="input-field" />
      <input type="password" placeholder="Mot de passe" v-model="password" class="input-field" />
      <input type="password" placeholder="Confirmer mot de passe" v-model="password_confirmation" class="input-field" />
      <button type="submit" class="btn-primary">S'enregistrer</button>
    </form>

    <div class="return-button">
      <img src="../assets/img/back.svg" @click="goBack" />
    </div>
  </div>
</template>

<style scoped src="../assets/css/register.css"></style>

<script>
import authApi from '../authApi'

export default {
  name: 'Register',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }
  },
  methods: {
    async handleRegister() {
      try {
        const response = await authApi.post('/api/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation
        })

        // Stocker le token et les données utilisateur avec les bonnes clés
        if (response.data.token) {
          localStorage.setItem('holypulse_token', response.data.token)
          localStorage.setItem('holypulse_user', JSON.stringify(response.data.user))
        }

        alert("Inscription réussie !")
        this.$router.push('/dashboard') // redirection vers le dashboard après inscription

      } catch (err) {
        alert("Erreur lors de l'inscription")
        console.error(err)
      }
    },
    goBack() {
      this.$router.push('/') // redirection au clic sur back
    }
  }
}
</script>
