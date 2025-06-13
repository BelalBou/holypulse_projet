<template>
  <div class="mobile-frame">
    <!-- UI FIXE -->
    <div class="dashboard-header">
      <img src="../assets/img/logo_vector.png" alt="Logo HolyPulse" class="logo-top-left" />
      <img
      src="../assets/img/account.svg"
      alt="Mon compte"
      class="icon-top-right"
      @click="goToAccount"
    />
    </div>

    <!-- ZONE SCROLLABLE -->
    <VerticalScrollFeed />

    <!-- ACTIONS FIXES -->
    <!-- <div class="action-buttons">
      <img src="../assets/img/like.svg" alt="Like" class="action-icon" />
      <img src="../assets/img/comment.svg" alt="Comment" class="action-icon" />
    </div> -->
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import VerticalScrollFeed from '../components/VerticalScrollFeed.vue'

const router = useRouter()

function goToAccount() {
  router.push('/account')
}
</script>

<style scoped>
@import '../assets/css/dashboard.css';
</style>
