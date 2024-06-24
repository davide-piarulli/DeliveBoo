<script>
import { store } from "@/data/store";
export default {
  data() {
    return {};
  },

  props: {
    product: Object,
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
    addToCart(product) {
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
        alert("Non puoi aggiungere un prodotto da un altro ristorante");
      }

      store.cart = JSON.parse(localStorage.getItem("cart"));
    },

    showCart() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      store.cart = cart;
    },
  },

  mounted() {
    this.showCart();
  },
};
</script>

<template>
  <div>
    <div class="small">
      <article class="recipe">
        <div class="pizza-box">
          <img
            :src="
              product.image == null
                ? '/no-food.jpg'
                : 'http://127.0.0.1:8000/storage/' + product.image
            "
            width="1500"
            height="1368"
            alt=""
          />
        </div>
        <div class="recipe-content">
          <p class="recipe-tags">
            <span class="recipe-tag">{{ product.product_type.name }}</span>
          </p>

          <h1 class="recipe-title">
            <a href="#">{{ product.name }}</a>
          </h1>

          <p class="recipe-metadata"></p>

          <p class="recipe-desc">
            {{ product.description }}
          </p>

          <button @click="addToCart(product)" class="recipe-save" type="button">
            <i class="fa-solid fa-plus mx-2 text-danger"></i>
            Aggiungi al Carrello
          </button>
        </div>
      </article>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.recipe,
.pizza-box {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.pizza-box {
  flex: 3 1 30ch;
  height: calc(282px + 5vw);
  overflow: hidden;

  img {
    max-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    object-fit: cover;
    object-position: 50% 50%;
  }
}

.recipe {
  border: 2px solid #f2f2f2;
  border-radius: 8px;
  overflow: hidden;

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
    color: #e05d26;
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

  &-metadata {
    margin: 0;
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
    border: 2px solid #e05d26;
    color: var(--primary);
    background: none;
    cursor: pointer;
    font-weight: bold;

    svg {
      margin-right: 6px;
    }
  }
}

/* Body Layout */
* {
  box-sizing: border-box;
}

body {
  --primary: #e05d26;
  --grey: #454545;
  --lightgrey: #666;

  color: var(--grey);
  line-height: 1.55;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  font-family: "Roboto", Helvetica, Arial, sans-serif;
}

.big {
  width: clamp(320px, 65%, 65%);
  padding: 24px;
}
.small {
  width: clamp(320px, 35%, 480px);
  padding: 24px;
}
</style>
