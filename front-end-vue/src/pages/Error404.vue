
<script>
  export default {
    name: 'error404',
    mounted(){
      document.body.classList.add('overflow-hidden')
    },
    beforeUnmount() {
      document.body.classList.remove('overflow-hidden');
    }
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
   height: calc(100vh - 100px);
  }

</style>