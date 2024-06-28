<script>
  export default {
    name: "orderSuccess",
    mounted(){
      window.scrollTo(0, 0);
      const reloadExecuted = localStorage.getItem('reloadExecuted');
      if (!reloadExecuted) {
        localStorage.setItem('reloadExecuted', 'true');
        location.reload();
      } else {
        localStorage.removeItem('reloadExecuted');
      }
      document.body.classList.add('overflow-hidden');
    },
    beforeUnmount() {
      localStorage.removeItem('reloadExecuted');
      document.body.classList.remove('overflow-hidden');
    }
  }
</script>



<template>
  <div class="success text-center p-5">
    <h1>L'ordine è avvenuto correttamente!</h1>
    <h2>A breve dovrebbe arrivarti un'email di conferma!</h2>
    <router-link class="btn btn-primary" :to="{ name: 'home' }">Torna alla home</router-link>
  </div>
</template>



<style lang="scss" scoped>

.success{
  height: calc(100vh - 100px);
}

</style>