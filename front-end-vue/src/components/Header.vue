<script>
import Cart from './Cart.vue';
export default {
  name: "Header",
  data() {
    return {
      isOpen: false,
      isMenuClicked: false,
    };
  },
  methods: {
    toggleMenu() {
      this.isOpen = !this.isOpen;
      if (this.isOpen) {
        document.body.classList.add("overflow-hidden");
      } else {
        document.body.classList.remove("overflow-hidden");
      }
    },
    handleMenuClick() {
      this.isMenuClicked = false;
      this.toggleMenu();
    },
  },

  components:{

    Cart

  }
};
</script>

<template>
  <header>
    <nav class="navbar h-100">
      <div class="container">
        <router-link :to="{ name: 'home' }" class="navbar-brand">
          <img
            src="/logo-text.png"
            alt="Logo"
            width="200px"
            height="80px"
            class="d-inline-block align-text-top"
          />
        </router-link>

        <ul class="m-0 p-0 d-flex align-items-center">
          <li
            class="mx-4 link-info link-offset-2 d-none d-lg-inline-block fs-5"
          >
            <router-link
              class="text-white text-decoration-none"
              :to="{ name: 'home' }"
              >Home</router-link
            >
          </li>
          <li
            class="mx-4 link-info link-offset-2 d-none d-lg-inline-block fs-5"
          >
            <router-link class="text-white text-decoration-none" to="#"
              >Ristoranti</router-link
            >
          </li>

          <li :class="{ 'd-none': isMenuClicked, 'me-4 fs-2 d-lg-none': true }">
            <a
              @click="handleMenuClick"
              class="d-flex text-white text-decoration-none cp"
            >
              <span class="fs-5">
                <i class="fa-solid fa-bars"></i>
              </span>
            </a>
          </li>

          <li class="d-none d-sm-inline-block fs-4">
            <Cart />
          </li>

          <div
            class="b_menu d-flex flex-column d-lg-none text-end"
            :class="{ b_menu_active: isOpen }"
          >
            <div>
              <span @click="toggleMenu" class="text-white d-inline-block p-2">
                <i class="fa-solid fa-xmark"></i>
              </span>
            </div>
            <div
              class="searchbar my-3 d-flex flex-column px-3 justify-content-around justify-content-center align-items-center"
            >
              <router-link
                class="text-white text-decoration-none"
                :to="{ name: 'home' }"
                >Home</router-link
              >
              <router-link class="text-white text-decoration-none" to="#"
                >Ristoranti</router-link
              >
            </div>
          </div>
        </ul>
      </div>
    </nav>
  </header>
</template>

<style lang="scss" scoped>
@use "../assets/scss/main.scss" as *;

header {
  position: fixed;
  width: 100%;
  z-index: 997;
  top: 0;
  nav {
    background-color: $color-1;
    li {
      color: $color-10 !important;
    }
    .b_menu {
      width: 100%;
      height: 100vh;
      position: absolute;
      top: 0;
      right: -100%;
      transition: right 0.5s;
      background-color: black;
      color: $color-10 !important;
      overflow: hidden;
    }
    .b_menu_active {
      right: 0 !important;
      font-size: 2.5rem;
      i {
        border: 1px solid white;
        padding: 10px;
        margin: 20px;
      }
    }

    .cart {
      background-color: transparent;
      border: none;
      color: $color-10;
    }

    @media screen and (min-width: 576px) {
      .offcanvas {
        width: 75% !important;
      }
    }

    @media screen and (min-width: 992px) {
      .offcanvas {
        width: 50% !important;
      }
    }
  }
}
</style>
