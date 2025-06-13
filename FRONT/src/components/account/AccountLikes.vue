<template>
<div class="mobile-frame">
  <div class="header">
    <img src="../../assets/img/back.svg" @click="goBack" />
    <h1>Mes Likes</h1>
  </div>

  <div class="scrollable-content">
    <div v-if="loading" class="loading">Chargement...</div>
    <div v-else-if="verses && verses.length === 0" class="empty">Aucun like pour le moment.</div>

    <div v-else class="likes-list">
      <div v-for="verse in verses" :key="verse.id" class="verse">
        <div class="verse-title">{{ verse.book }} {{ verse.chapter }}:{{ verse.verse }}</div>
        <div class="verse-text">{{ verse.text }}</div>
      </div>
    </div>
  </div>
</div>

  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import api from '../../api'
  import { useRouter } from 'vue-router'
  

  const router = useRouter()
  const verses = ref([])
  const loading = ref(true)
  
  function goBack() {
    router.push('/account')
  }
  
  onMounted(async () => {
  try {
    const { data } = await api.get('/likes/verses')
    verses.value = data
  } catch (err) {
    console.error('Erreur lors du chargement des likes :', err)
  } finally {
    loading.value = false
  }
})

  </script>
  
  <style scoped>
  @import url('../../assets/css/accountLike.css');
  </style>
  