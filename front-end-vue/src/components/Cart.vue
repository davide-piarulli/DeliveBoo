

<script>
import { store } from "@/data/store";
export default {
  data() {
    return {
      store,
    };
  },

  methods: {
    showCart() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      store.cart = cart;
    },

    decreaseQuantity(productId) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      let existingProduct = cart.find((item) => item.id === productId);

      if (existingProduct && existingProduct.quantity > 1) {
        existingProduct.quantity -= 1;
      } else {
        // If the quantity is 1 or less, remove the product from the cart
        cart = cart.filter((item) => item.id !== productId);
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      this.showCart();
      store.cart = JSON.parse(localStorage.getItem("cart"));
    },

    // Function to increase the quantity of a product in the cart
    increaseQuantity(productId) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      let existingProduct = cart.find((item) => item.id === productId);

      if (existingProduct) {
        existingProduct.quantity += 1;
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      this.showCart();
      store.cart = JSON.parse(localStorage.getItem("cart"));
    },

    deleteItem(item){


    }
  },

  mounted() {
    console.log(JSON.parse(localStorage.getItem("cart")));
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Carelo</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <!-- inizio vero carelo -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-xl-8">
              <div class="square container-fluid p-4">
                <div v-for="item in store.cart" :key="item.id" class="row d-flex justify-content-center position-relative">
                  <div class="col-4 mb-4 mb-lg-0">
                    <!-- Image -->
                    <div
                      class="bg-image w-75 text-center item-image hover-overlay hover-zoom ripple rounded"
                      data-mdb-ripple-color="light"
                    >
                      <img
                        src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Vertical/12a.webp"
                        class="w-100 mx-auto"
                        alt="Blue Jeans Jacket"
                      />
                      <a href="#!">
                        <div
                          class="mask"
                          style="background-color: rgba(251, 251, 251, 0.2)"
                        ></div>
                      </a>
                    </div>
                    <!-- Image -->
                  </div>

                  <div class="col-8 mb-4 mb-lg-0">
                    <!-- Data -->
                    <p><strong>{{item.name}}</strong></p>
                    <p class="text-start">
                      <strong>${{item.price}}</strong>
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

                      <span>{{item.quantity}}</span>
                      
                      <button
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-primary px-3 ms-2"
                        @click="increaseQuantity(item.id)"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    
                    <!-- Data -->
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-xl-4">
              <div class="square"></div>
            </div>

            <div class="col-12">
              <div class="square"></div>
            </div>
          </div>
        </div>
        <!-- fine vero carelo  -->
      </div>
    </div>
    <!-- fine carelo -->
  </div>
</template>

<style lang="scss" scoped>
@use "../assets/scss/main.scss" as *;

.square {
  border: 1px solid black;
}

.cart {
  background-color: transparent;
  border: none;
  color: $color-10;
}

@media screen and (min-width: 992px) {
  .item-image{
  
    width: 100%;
  }
}
@media screen and (min-width: 1200px) {
  .offcanvas {
    width: 1200px !important;

  }
}
</style>