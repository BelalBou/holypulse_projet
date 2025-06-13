import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'               // ⬅️ Import Pinia
import './assets/css/style.css'

const app = createApp(App)

app.use(createPinia())                            // ⬅️ Utilise Pinia
app.use(router)
app.mount('#app')
