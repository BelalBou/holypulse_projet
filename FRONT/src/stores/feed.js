import { defineStore } from 'pinia'

export const useFeedStore = defineStore('feed', {
  state: () => ({
    currentIndex: 0
  }),
  actions: {
    setIndex(index) {
      this.currentIndex = index
    }
  }
})
