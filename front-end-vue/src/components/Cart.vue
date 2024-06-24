<script>
import { store } from "@/data/store";
export default {
  data() {
    return {
      store,
    };
  },

  methods: {
    updatePrice() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      let subtotalPrice = 0;
      cart.forEach((product) => {
        subtotalPrice =
          subtotalPrice + parseFloat(product.price) * product.quantity;
      });
      store.subtotal = subtotalPrice.toFixed(2);
      let totalPrice = parseFloat(store.subtotal) + parseFloat(store.shipping);
      store.total = totalPrice.toFixed(2);
    },

    showCart() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      store.cart = cart;
    },

    // diminuisco quantità
    decreaseQuantity(productId) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      let existingProduct = cart.find((item) => item.id === productId);

      if (existingProduct && existingProduct.quantity > 1) {
        existingProduct.quantity -= 1;
      } else {
        // Se la quantità è 1 o minore, rimuovo il prodotto
        cart = cart.filter((item) => item.id !== productId);
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      this.showCart();
      this.updatePrice();
    },

    // aumento quantità
    increaseQuantity(productId) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      let existingProduct = cart.find((item) => item.id === productId);

      if (existingProduct) {
        existingProduct.quantity += 1;
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      this.showCart();
      this.updatePrice();
    },

    // elimino prodotto
    deleteItem(productId) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      cart = cart.filter((item) => item.id !== productId);
      localStorage.setItem("cart", JSON.stringify(cart));
      store.cart = cart;
      this.updatePrice();
    },
  },

  mounted() {
    this.updatePrice();
    // localStorage.removeItem('cart')
  },
};
</script>

<template>
  <div>
    <button
      class="cart"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasRight"
      aria-controls="offcanvasRight"
    >
      <i class="fa-solid fa-cart-shopping"></i>
    </button>

    <div
      class="offcanvas w-100 offcanvas-end"
      tabindex="-1"
      id="offcanvasRight"
      aria-labelledby="offcanvasRightLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrello</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <!-- inizio vero carrello -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-xl-8">
              <div class="square container-fluid p-4 mb-3">
                <div v-if="store.cart.length === 0">Non ci sono prodotti nel carrello</div>
                <div
                  v-for="item in store.cart"
                  :key="item.id"
                  class="row d-flex justify-content-center position-relative mb-2"
                >
                  <div class="col-4 mb-4 mb-lg-0">
                    <!-- immagine -->
                    <div
                      class="bg-image w-75 text-center item-image hover-overlay hover-zoom ripple rounded"
                      data-mdb-ripple-color="light"
                    >
                      <img
                        :src="
                          item.image == null
                            ? '/no-food.jpg'
                            : 'http://127.0.0.1:8000/storage/' + item.image
                        "
                        class="w-100 mx-auto"
                        :alt="item.name"
                      />
                      <a href="#!">
                        <div
                          class="mask"
                          style="background-color: rgba(251, 251, 251, 0.2)"
                        ></div>
                      </a>
                    </div>
                    <!-- immagine -->
                  </div>

                  <div class="col-8 mb-4 mb-lg-0">
                    <!-- Dati -->
                    <p>
                      <strong>{{ item.name }}</strong>
                    </p>
                    <p class="text-start">
                      <strong>${{ item.price }}</strong>
                    </p>
                    <button
                      type="button"
                      data-mdb-button-init
                      data-mdb-ripple-init
                      class="btn btn-danger me-1 mb-2 position-absolute top-0 end-0"
                      data-mdb-tooltip-init
                      title="Remove item"
                      @click="deleteItem(item.id)"
                    >
                      <i class="fas fa-trash"></i>
                    </button>

                    <div class="d-flex mb-4" style="max-width: 300px">
                      <button
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-primary px-3 me-2"
                        @click="decreaseQuantity(item.id)"
                      >
                        <i class="fas fa-minus"></i>
                      </button>

                      <span>{{ item.quantity }}</span>

                      <button
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-primary px-3 ms-2"
                        @click="increaseQuantity(item.id)"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>

                    <!-- Dati -->
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-xl-4">
              <div class="square mb-3">
                <h5>Riepilogo ordine</h5>
                <div v-if="store.subtotal != 0">
                  <h6>Prodotti: € {{ store.subtotal }}</h6>
                  <h6>Consegna: € {{ store.shipping }}</h6>
                  <h6>
                    Totale ordine: €
                    {{ store.total }}
                  </h6>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="square mb-3"></div>
            </div>
          </div>
        </div>
        <!-- fine vero carrello  -->
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../assets/scss/main.scss" as *;

.square {
  min-height: 300px;
  border: 1px solid black;
}

.cart {
  background-color: transparent;
  border: none;
  color: $color-10;
}

@media screen and (min-width: 992px) {
  .item-image {
    width: 100%;
  }
}
@media screen and (min-width: 1200px) {
  .offcanvas {
    width: 1200px !important;
  }
}
</style>
