import './assets/scss/main.scss'
import 'bootstrap/dist/css/bootstrap.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index'

import 'bootstrap/dist/js/bootstrap.js'
const app = createApp(App)

app.use(router)

app.mount('#app')
