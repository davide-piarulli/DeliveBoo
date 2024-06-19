<script>
export default {
  name: 'Header'
}
</script>

<template>
  <header>
    <nav class="navbar bg-body-tertiary h-100">
      <div class="container-fluid">
        <router-link :to="{ name: 'home' }" class="navbar-brand">
          <img src="/logo.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
          DELIVEBOO
        </router-link>
        <ul class="d-flex justify-content-around">
          <li class="mx-4 link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
            <router-link :to="{ name: 'home' }">Home</router-link>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>


<style lang="scss" scoped>
header {
  height: 100px;
}
</style>