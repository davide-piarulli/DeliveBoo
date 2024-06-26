import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import Error404 from "../pages/Error404.vue";
import RestaurantDetail from "../pages/RestaurantDetail.vue";
import OrderSuccess from "../pages/OrderSuccess.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: Home,
    },
    {
      path: "/restaurant-detail/:slug",
      name: "restaurantDetail",
      component: RestaurantDetail,
    },
    {
      path: "/order-success",
      name: "orderSuccess",
      component: OrderSuccess,
      beforeEnter: (to, from, next) => {
        if (localStorage.getItem('orderConfirmed')) {
          next();
        } else {
          next({ name: 'home' });
        }
      },
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
