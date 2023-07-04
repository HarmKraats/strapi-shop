import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue';
import store from '@/store';
import VueKinesis from "vue-kinesis";

const app = createApp(App);
app.use(VueKinesis);
app.use(router).use(autoAnimatePlugin).mount('#app');
