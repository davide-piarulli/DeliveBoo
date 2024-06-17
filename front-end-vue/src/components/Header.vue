<script>
  export default {
    name: 'Header'
  }
</script>

<template>
  <nav class="container justify-content-center">
    <ul class="d-flex justify-content-around">
      <li>
        <router-link :to="{name: 'home'}">Home</router-link>
      </li>
      <li>
        <router-link :to="{name: 'type_restaurant'}">Tipologia di ristoranti</router-link>
      </li>
    </ul>
  </nav>
</template>


<style lang="scss" scoped>

</style>