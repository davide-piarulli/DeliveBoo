<script>
export default {
  name: 'Header'
}
</script>

<template>
  <header>
    <nav class="navbar h-100">
      <div class="container">
        <router-link :to="{ name: 'home' }" class="navbar-brand">
          <img src="/logo.png" alt="Logo" width="80" height="80" class="d-inline-block align-text-top">
        </router-link>

        <ul class="m-0 p-0">
          <li class="mx-4 link-info link-offset-2 d-none d-md-inline-block fs-6">
            <router-link class="text-white text-decoration-none" :to="{ name: 'home' }">Home</router-link>
          </li>
          <li class="mx-4 link-info link-offset-2 d-none d-md-inline-block fs-6">
            <router-link class="text-white text-decoration-none" href="#">Ristoranti</router-link>
          </li>
          <li class="me-4 fs-2 d-md-none">
            <i class="fa-solid fa-bars"></i>
          </li>
        </ul>

      </div>
    </nav>
  </header>
</template>


<style lang="scss" scoped>

@use '../assets/scss/main.scss' as*;

header {
  position: fixed;
  width: 100%;
  z-index: 997;
  top: 0;
  nav{
    background-color: $color-1;
    li{
      color: $color-10 !important;
    }
  }
}

</style>