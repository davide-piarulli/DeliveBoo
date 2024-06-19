
<script>
  export default {
    name: 'error404'
  }
</script>



<template>
  <div class="error d-flex justify-content-center align-items-center">
    <h1>Errore 404 - Pagina non trovata</h1>
  </div>
</template>



<style lang="scss" scoped>

@use "../assets/scss/main.scss" as *;

  .error{
   height: calc(100vh - 100px - 460px);
  }

</style>