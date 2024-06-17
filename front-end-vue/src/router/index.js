import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue';
import Restaurants_type from '../pages/Restaurants_type.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/type_restaurant',
      name: 'type_restaurant',
      component: Restaurants_type
    },
  ]
})

export default router
