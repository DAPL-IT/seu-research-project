import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

import App from './App.vue'
import router from './router/routes'

import './assets/toast.css'
import './assets/style.css'
import './assets/ionicons/css/ionicons.min.css'
import './assets/font-awesome/css/font-awesome.min.css'

const app = createApp(App)
const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

app.use(pinia)
app.use(router)

app.mount('#app')
