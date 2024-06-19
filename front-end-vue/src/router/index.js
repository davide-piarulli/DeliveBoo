import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";
import Error404 from "../pages/Error404.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: Home,
    },
    // Questa rotta è sempre l'ultima
    {
      path: '/:pathMatch(.*)*',
      name: 'error404',
      component: Error404
    },
  ],
});

export default router;
