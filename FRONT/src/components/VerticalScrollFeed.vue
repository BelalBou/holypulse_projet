<template>
    <div class="viewport" ref="viewport">
      <div class="track" :style="trackStyle" ref="track">
        <div
          v-for="verse in visibleVerses"
          :key="verse.id"
          class="verse-slide"
          :style="{ backgroundColor: verse.backgroundColor }"
        >
          <div class="verse-wrapper">
            <p class="verse-title">
              {{ verse.book }} {{ verse.chapter }}:{{ verse.verse }}
            </p>
            <p class="verse-text">
              {{ verse.text }}
            </p>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Boutons FIXES -->
    <div class="action-buttons">
      <img
        :src="isCurrentVerseLiked ? '/src/assets/img/liked.svg' : '/src/assets/img/like.svg'" alt="Like" class="action-icon" @click="toggleLike" />
      <img src="/src/assets/img/comment.svg" alt="Commenter" class="action-icon" @click="showCommentModal = true" />

    </div>
  
    <!-- Modal de connexion -->
    <div v-if="showLoginModal" class="modal-overlay" @click.self="showLoginModal = false">
      <div class="modal-content">
        <button class="modal-close" @click="showLoginModal = false">×</button>
        <h2>Connexion requise</h2>
        <p>Vous devez être connecté pour liker un verset.</p>
        <a href="/login" class="modal-button">Se connecter</a>
      </div>
    </div>

    <!-- Modal de commentaire -->
<div v-if="showCommentModal" class="modal-overlay" @click.self="showCommentModal = false">
  <div class="modal-content">
    <button class="modal-close" @click="showCommentModal = false">×</button>
    <h2>Ajouter un commentaire</h2>
    <textarea 
      v-model="commentText" 
      placeholder="Écris ton commentaire..." 
      class="comment-textarea"
      @keydown.enter.prevent="submitComment"
    ></textarea>
  </div>
</div>

  </template>
  
  <script setup>
  import api from '../api'
  import authApi from '../authApi'
  import { ref, onMounted, computed, nextTick } from 'vue'
  
  const books = {
    1: 'Genèse', 2: 'Exode', 3: 'Lévitique', 4: 'Nombres', 5: 'Deutéronome',
    6: 'Josué', 7: 'Juges', 8: 'Ruth', 9: '1 Samuel', 10: '2 Samuel',
    11: '1 Rois', 12: '2 Rois', 13: '1 Chroniques', 14: '2 Chroniques', 15: 'Esdras',
    16: 'Néhémie', 17: 'Esther', 18: 'Job', 19: 'Psaumes', 20: 'Proverbes',
    21: 'Ecclésiaste', 22: 'Cantique des Cantiques', 23: 'Ésaïe', 24: 'Jérémie', 25: 'Lamentations',
    26: 'Ézéchiel', 27: 'Daniel', 28: 'Osée', 29: 'Joël', 30: 'Amos',
    31: 'Abdias', 32: 'Jonas', 33: 'Michée', 34: 'Nahum', 35: 'Habacuc',
    36: 'Sophonie', 37: 'Aggée', 38: 'Zacharie', 39: 'Malachie', 40: 'Matthieu',
    41: 'Marc', 42: 'Luc', 43: 'Jean', 44: 'Actes', 45: 'Romains',
    46: '1 Corinthiens', 47: '2 Corinthiens', 48: 'Galates', 49: 'Éphésiens', 50: 'Philippiens',
    51: 'Colossiens', 52: '1 Thessaloniciens', 53: '2 Thessaloniciens', 54: '1 Timothée',
    55: '2 Timothée', 56: 'Tite', 57: 'Philémon', 58: 'Hébreux', 59: 'Jacques',
    60: '1 Pierre', 61: '2 Pierre', 62: '1 Jean', 63: '2 Jean', 64: '3 Jean',
    65: 'Jude', 66: 'Apocalypse'
  }
  // const pour Commentaires
  const showCommentModal = ref(false)
  const commentText = ref('')

  
  const SLIDE_HEIGHT = 640
  const currentIndex = ref(1)
  const isLocked = ref(false)
  const isTransitioning = ref(true)
  const viewport = ref(null)
  let scrollCooldown = false
  
  const likedVerses = ref([])
  const showLoginModal = ref(false)
  const errorMessage = ref('')
  
  const isCurrentVerseLiked = computed(() => {
    const verse = visibleVerses.value[1]
    return verse && likedVerses.value.includes(verse.id)
  })
  
  const visibleVerses = ref([
    { id: 0, text: 'Chargement...', backgroundColor: '#fcebea' },
    { id: 1, text: 'Chargement...', backgroundColor: '#e8f5e9' },
    { id: 2, text: 'Chargement...', backgroundColor: '#f3e5f5' }
  ])
  
  async function fetchUserLikes() {
    try {
      const res = await api.get('/likes')
      likedVerses.value = res.data
    } catch (err) {
      console.error('Erreur lors du chargement des likes :', err)
    }
  }
  
  async function toggleLike() {
    const verse = visibleVerses.value[1]
    if (!verse) return
  
    try {
      const res = await api.post(`/verses/${verse.id}/like`)
      const liked = res.data.liked
  
      if (liked) {
        if (!likedVerses.value.includes(verse.id)) {
          likedVerses.value.push(verse.id)
        }
      } else {
        likedVerses.value = likedVerses.value.filter(id => id !== verse.id)
      }
  
    } catch (err) {
      console.error('Erreur lors du like :', err)
      if (err.response?.status === 401) {
        showLoginModal.value = true
      } else {
        errorMessage.value = 'Une erreur est survenue. Veuillez réessayer.'
      }
    }
  }

  async function submitComment() {
  const verse = visibleVerses.value[1]
  if (!verse || !commentText.value.trim()) return

  try {
    await authApi.post(`/api/verses/${verse.id}/comments`, {
      content: commentText.value.trim()
    })
    commentText.value = ''
    showCommentModal.value = false
  } catch (err) {
    console.error('Erreur lors de l\'envoi du commentaire :', err)
    if (err.response?.status === 401) {
      showLoginModal.value = true
    }
  }
}

  
  async function generateVerse() {
    try {
      const res = await api.get('/verses/random')
      const data = res.data
      return {
        id: data.id,
        text: data.text,
        chapter: data.chapter,
        verse: data.verse,
        book: books[data.book] || `Livre ${data.book}`,
        backgroundColor: randomPastel()
      }
    } catch (err) {
      return {
        id: Date.now(),
        text: 'Erreur de chargement du verset',
        chapter: 0,
        verse: 0,
        book: 'Erreur',
        backgroundColor: '#ffcccc'
      }
    }
  }
  
  function randomPastel() {
    const colors = [
      '#fcebea', '#fde2e4', '#fff1e6', '#fdebd0', '#fff9db',
      '#e0f7fa', '#d1f2eb', '#e3f2fd', '#e8f5e9', '#f3e5f5',
      '#ede7f6', '#f9fbe7', '#fff3e0', '#fbe9e7', '#e1f5fe',
      '#f0f4c3', '#dcedc8', '#c8e6c9', '#ffe0b2', '#ffecb3',
      '#d7ccc8', '#cfd8dc', '#f5f5f5', '#e0f2f1', '#fce4ec',
      '#f3e5ab', '#e6ee9c', '#f8bbd0', '#d1c4e9', '#b2ebf2',
      '#b3e5fc', '#b2dfdb', '#c5cae9', '#ffcdd2', '#ffe082'
    ]
    return colors[Math.floor(Math.random() * colors.length)]
  }
  
  const trackStyle = computed(() => ({
    transform: `translateY(-${currentIndex.value * SLIDE_HEIGHT}px)`,
    transition: isTransitioning.value ? 'transform 0.5s ease' : 'none'
  }))
  
  async function scrollToNext(direction = 1) {
    if (isLocked.value) return
    isLocked.value = true
    isTransitioning.value = true
  
    currentIndex.value += direction
  
    setTimeout(async () => {
      const newVerse = await generateVerse()
  
      if (direction > 0) {
        visibleVerses.value = [
          visibleVerses.value[1],
          visibleVerses.value[2],
          newVerse
        ]
      } else {
        visibleVerses.value = [
          newVerse,
          visibleVerses.value[0],
          visibleVerses.value[1]
        ]
      }
  
      isTransitioning.value = false
      currentIndex.value = 1
      await nextTick()
      isLocked.value = false
    }, 500)
  }
  
  function onWheel(event) {
    event.preventDefault()
    if (scrollCooldown || isLocked.value) return
  
    const delta = event.deltaY
    if (Math.abs(delta) < 30) return
  
    scrollCooldown = true
    scrollToNext(delta > 0 ? 1 : -1)
  
    setTimeout(() => {
      scrollCooldown = false
    }, 600)
  }
  
  let touchStartY = 0
  function onTouchStart(e) {
    touchStartY = e.touches[0].clientY
  }
  
  function onTouchEnd(e) {
    if (scrollCooldown || isLocked.value) return
  
    const touchEndY = e.changedTouches[0].clientY
    const delta = touchStartY - touchEndY
    if (Math.abs(delta) < 50) return
  
    scrollCooldown = true
    scrollToNext(delta > 0 ? 1 : -1)
  
    setTimeout(() => {
      scrollCooldown = false
    }, 600)
  }


  
  onMounted(async () => {
    await fetchUserLikes()
    visibleVerses.value = [
      await generateVerse(),
      await generateVerse(),
      await generateVerse()
    ]
  
    const el = viewport.value
    el.addEventListener('wheel', onWheel, { passive: false })
    el.addEventListener('touchstart', onTouchStart, { passive: false })
    el.addEventListener('touchend', onTouchEnd, { passive: false })
  })
  </script>
  
  <style scoped>
  @import '../assets/css/dashboard.css';
  
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 50;
  }
  
  .modal-content {
    background: white;
    padding: 20px 24px;
    border-radius: 12px;
    text-align: center;
    position: relative;
    max-width: 300px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  }
  
  .modal-close {
    position: absolute;
    top: 8px;
    right: 12px;
    background: transparent;
    border: none;
    font-size: 24px;
    cursor: pointer;
  }
  
  .modal-button {
    display: inline-block;
    margin-top: 16px;
    padding: 10px 16px;
    background-color: #8c1c13;
    color: white;
    text-decoration: none;
    border-radius: 8px;
  }

  .comment-textarea {
  width: 100%;
  min-height: 100px;
  padding: 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 16px;
  resize: none;
}

  </style>
  