<script setup lang="js">
import { RouterView } from 'vue-router';

// import VerseTest from './components/VerseTest.vue';
</script>

<template>
  <div id="app">
    <RouterView />
  </div>
</template>



<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
