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

  <div>
    <Header/>

    <router-view></router-view>
  </div>
  
</template>


<style lang="scss" scoped>

</style>