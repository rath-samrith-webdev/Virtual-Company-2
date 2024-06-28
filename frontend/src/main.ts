import 'bootstrap/dist/css/bootstrap.min.css' // Import Bootstrap CSS
import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import axios from './plugins/axios'
import 'uno.css'
import { configure } from 'vee-validate'
import 'bootstrap/dist/css/bootstrap.css'

const app = createApp(App)

configure({
  validateOnInput: true
})

app.use(createPinia()).use(router.router).use(router.simpleAcl).use(ElementPlus)

app.config.globalProperties.$axios = axios
app.mount('#app')
