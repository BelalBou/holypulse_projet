<template>
<div class="mobile-frame">
  <div class="header">
    <img :src="backIcon" @click="goBack" />
    <h1>Mes Commentaires</h1>
  </div>

  <div class="scrollable-content">
    <div v-if="loading" class="loading">Chargement...</div>
    <div v-else-if="comments && comments.length === 0" class="empty">Aucun commentaires pour le moment.</div>

    <div v-else class="likes-list">
      <div v-for="comment in comments" :key="comment.comment_id" class="verse">
        <div class="verse-title">{{ comment.book }} {{ comment.chapter }}:{{ comment.verse }}</div>
        <div class="verse-text">{{ comment.text }}</div>
        <div class="separation"></div>
        <div class="verse-content">{{ comment.content }}</div>
      </div>

    </div>
  </div>
</div>

  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import api from '../../api'
  import { useRouter } from 'vue-router'
  
  // Import des images
  import backIcon from '../../assets/img/back.svg'
  

  const router = useRouter()
  // const verses = ref([])
  const comments = ref([])
  const loading = ref(true)
  
  function goBack() {
    router.push('/account')
  }
  
  onMounted(async () => {
    try {
      const { data } = await api.get('/comments/verses')
      comments.value = data
    } catch (err) {
      console.error('Erreur lors du chargement des commentaires :', err)
      if (err.response?.status === 401) {
        // Redirection vers login si non authentifié
        router.push('/login')
      }
    } finally {
      loading.value = false
    }
  })

  </script>
  
  <style scoped>
  @import url('../../assets/css/accountLike.css');
  </style>
  