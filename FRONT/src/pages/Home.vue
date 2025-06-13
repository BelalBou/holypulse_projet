<template>
  <div class="mobile-frame">
    <!-- <div class="gif-wrapper">
      <img src="../assets/img/gif-holypulse.gif" alt="Intro gif" class="intro-gif" />
    </div>
     -->
    <div class="content">
      <router-link to="/login">
        <button class="btn-primary">Connexion</button>
      </router-link>
      <router-link to="/register" class="link-register">S’inscrire</router-link>
    </div>
  </div>
</template>
  
  <script>
  export default {
    name: 'Home',
  };
  </script>
  
  <style scoped src="../assets/css/home.css"></style>

  