import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import RestaurantsType from "../pages/RestaurantsType.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: Home,
    },
    {
      path: "/type_restaurant",
      name: "type_restaurant",
      component: RestaurantsType,
    },
  ],
});

export default router;
