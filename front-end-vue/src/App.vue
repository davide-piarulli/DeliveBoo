<script>

  import Header from './components/Header.vue';

  export default {
    components: {
      Header
    },
    data(){
      return{
        massage: 'yo'
      }
    },
  }


</script>


<template>

  <Header/>

  <router-view></router-view>
  
</template>


<style lang="scss" scoped>

</style>