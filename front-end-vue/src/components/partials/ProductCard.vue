<script>
import { store } from "@/data/store";
export default {
  data() {
    return {
      isHovered: false,
      isClicked: false,
    };
  },

  props: {
    product: Object,
  },

  methods: {
    updatePrice() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];

      let subtotalPrice = 0;
      let totalQuantity = 0;
      cart.forEach((product) => {
        subtotalPrice = subtotalPrice + parseFloat(product.price) * product.quantity;
        totalQuantity = totalQuantity + product.quantity;
      });
      store.subtotal = subtotalPrice.toFixed(2);
      store.cartCounter = totalQuantity;

      let totalPrice = parseFloat(store.subtotal) + parseFloat(store.shipping);
      store.total = totalPrice.toFixed(2);
    },
    async addToCart(product) {

      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      if (
        cart.length === 0 ||
        product.restaurant_id === cart[0]?.restaurant_id
      ) {
        let existingProduct = cart.find((item) => item.id === product.id);

        if (existingProduct) {
          // Se il prodotto è già nel carrello, incrementa la quantità
          existingProduct.quantity += 1;
        } else {
          // Se il prodotto non è nel carrello, aggiungilo
          product.quantity = 1;
          cart.push(product);
        }
        // Salva il carrello aggiornato nel localStorage
        localStorage.setItem("cart", JSON.stringify(cart));
        this.showCart();
        this.updatePrice();
      } else {
        this.$emit('openModal');
        while (!store.cartSwitch) {
          await new Promise(resolve => setTimeout(resolve, 100));
        }
        if (store.cartSwitch) {
          store.cart = [];
          cart = [];
          localStorage.setItem("cart", JSON.stringify(cart));
          store.cartSwitch = false;

          product.quantity = 1;
          cart.push(product);

          localStorage.setItem("cart", JSON.stringify(cart));
          this.showCart();
          this.updatePrice();
        }
      }
      store.cart = JSON.parse(localStorage.getItem("cart"));
    },

    showCart() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      store.cart = cart;
    },
    clickTimer() {
      this.isClicked = true;
      setTimeout(() => {
        this.isClicked = false;
      }, 1000)
    }
  },

  mounted() {
    this.showCart();
  },
};
</script>

<template>
  <div class="col-lg-4 col-md-6 col-xs-12 d-flex justify-content-center">
    <div class="my-card small">
      <article class="recipe h-100">
        <div class="d-flex justify-content-between flex-column">
          <div class="overflow-hidden position-relative">
           <img
              class="card-image img-fluid"
              :class="{'rotate' : product.name == 'Burger Ranchero', 'zoomed' : isHovered}"
              :src="product.image ? 'http://127.0.0.1:8000/storage/' + product.image : '/no-food.jpg'"
              onerror="this.src = '/no-food.jpg'"
              :alt="product.name" 
              @mouseover="isHovered = true"
              @mouseleave="isHovered = false"
            />
            <div class="overlay" v-if="isHovered"></div>
          </div>
          <div class="recipe-content h-100">
            <p class="recipe-tags">
              <span class="recipe-tag">{{ product.product_type.name }}</span>
            </p>

            <h1 class="recipe-title">
              <span>{{ product.name }}</span>
            </h1>

            <p class="recipe-desc">
              {{ product.description }}
            </p>
            <p class="recipe-price">
              &euro; {{ product.price.replace('.', ',') }}
            </p>

          </div>
        </div>
        <button @click="addToCart(product); clickTimer()" class="recipe-save mx-auto mb-4"
          :class="{ 'active': isClicked }" type="button" id="add-to-cart" :disabled="isClicked">
          <i class="fa-solid fa-cart-shopping d-sm-none"></i>
          <i class="fa-solid fa-plus mx-2 d-none d-sm-inline"></i>
          <span class="d-none d-sm-inline">Aggiungi al Carrello</span>
        </button>
      </article>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../../assets/scss/main.scss" as *;

.recipe,
.pizza-box {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.recipe {
  border: 2px solid #f2f2f2;
  border-radius: 8px;
  overflow: hidden;

  .card-image{
    width: 268px;
    aspect-ratio: 1;
    object-fit: cover;
  }

  &-price {

    font-weight: bold;
    font-size: 20px;
    color: $color-4;
  }

  &-content {
    padding: 16px 32px;
    flex: 4 1 40ch;
  }

  &-tags {
    margin: 0 -8px;
  }

  &-tag {
    display: inline-block;
    margin: 8px;
    font-size: 0.875em;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.02em;
    color: $color-6;
  }

  &-title {
    margin: 0;
    font-size: clamp(1.4em, 2.1vw, 2.1em);
    font-family: "Roboto Slab", Helvetica, Arial, sans-serif;

    a {
      text-decoration: none;
      color: inherit;
    }
  }

  &-rating {
    font-size: 1.2em;
    letter-spacing: 0.05em;
    color: var(--primary);

    span {
      color: var(--grey);
    }
  }

  &-votes {
    font-size: 0.825em;
    font-style: italic;
    color: var(--lightgrey);
  }

  &-save {
    display: flex;
    align-items: center;
    padding: 6px 14px 6px 12px;
    border-radius: 4px;
    border: 2px solid $color-2;
    color: var(--primary);
    background: none;
    cursor: pointer;
    font-weight: bold;

    &.active {
      scale: .95;
    }

    &:hover,
    &.active {
      background-color: $color-2;
      color: white;
    }

    i {
      color: $color-6;
    }

    svg {
      margin-right: 6px;
    }
  }
}

.big {
  width: clamp(320px, 65%, 65%);
  padding: 24px;
}

.small {
  width: clamp(320px, 35%, 480px);
  padding: 24px;
}

.rotate{
  rotate: -90deg;
}

</style>
