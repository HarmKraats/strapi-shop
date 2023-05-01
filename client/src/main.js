import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import store from '@/store'

const app = createApp(App)

app.config.globalProperties.$store = store


app.use(router).use(autoAnimatePlugin).mount('#app')
