<script>
  export default {
    name: 'Header'
  }
</script>

<template>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="/logo.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
        DELIVEBOO
      </a>
    </div>
      <ul class="d-flex justify-content-around">
      <li class="mx-4 link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
        <router-link :to="{name: 'home'}">Home</router-link>
      </li>
      <li class="me-4 link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
        <router-link :to="{name: 'type_restaurant'}">Tipologia di ristoranti</router-link>
      </li>
    </ul>
    </div>
  </nav>
</template>


<style lang="scss" scoped>

</style>