<script>
  import {store} from '../data/store';
  import axios from 'axios';

  export default {

    name: 'Restaurants_type',

    data(){
      return {
        types: []
      }
    },

    methods:{
      getApi(){
        axios.get(store.apiUrl)
        .then(result => {
          this.types = result.data;
          console.log(this.types);
        })
        .catch(error=>{
          console.log(error.message)
        })
      }
    },
    mounted(){
      this.getApi()
    }
  }
</script>

<template>
  <div class="container d.flex justify-content-center">
    <div class="blog">
      <h1 class="my-4">Tipi di ristorante:</h1>
      <div>
        <ul>
          <li v-for="type in types" :key="type.id">
            {{ type.id }} -:- {{ type.name }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>

</style>