import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";
import Error404 from "../pages/Error404.vue";
import RestaurantDetail from "@/pages/RestaurantDetail.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: Home,
    },
    {
      path: "/restaurant-detail",
      name: "RestaurantDetail",
      component: RestaurantDetail,
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
