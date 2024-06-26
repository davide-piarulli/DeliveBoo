import { reactive } from "vue";

export const store = reactive({
  apiUrl: "http://127.0.0.1:8000/api/",
  cart: [],
  cartCounter: 0,
  total: 0,
  subtotal: 0,
  shipping: 4.99,
  cartSwitch: false
});
