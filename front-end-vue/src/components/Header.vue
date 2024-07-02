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

  components: {

    Cart

  }
};
</script>

<template>
  <header>
    <nav class="navbar h-100">
      <div class="container">

        <router-link :to="{ name: 'home' }" class="navbar-brand m-0">
          <img src="/logo-text.png" alt="Logo" width="200px" height="80px" class="d-inline-block align-text-top" />
        </router-link>

        <ul class="m-0 p-0 d-flex align-items-center">
          <li class="me-3 link-info link-offset-2 fs-5">
            <router-link class="text-white text-decoration-none" :to="{ name: 'home' }">
              <i class="fa-solid fa-house"></i><span class="d-none d-md-inline"> Home</span>
            </router-link>
          </li>

          <li class="fs-4">
            <Cart />
          </li>

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
