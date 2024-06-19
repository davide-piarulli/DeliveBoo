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
        <ul>
          <li class="mx-4 link-info link-offset-2 d-none d-md-inline-block fs-6">
            <router-link class="white_text" :to="{ name: 'home' }">Home</router-link>
          </li>
          <li class="mx-4 link-info link-offset-2 d-none d-md-inline-block fs-6">
            <a class="white_text" href="#">Ristoranti</a>
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
  position: relative;
  height: 100px;
  nav{
    background-color: $color-1;
    position: fixed;
    top: 0;
    width: 100%;
    height: 100%;
    li{
      color: $color-10 !important;
      i{
        z-index: 999;
      }
    }
  }
}

.white_text{
  color: $color-10;
}

</style>