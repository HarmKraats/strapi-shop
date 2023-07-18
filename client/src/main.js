import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue';
import store from '@/store';


const app = createApp(App);
app.use(store);
app.use(router);
app.use(autoAnimatePlugin);
app.mount('#app');
