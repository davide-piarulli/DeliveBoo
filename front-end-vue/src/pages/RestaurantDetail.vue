<script>
import {store} from '../data/store';
import axios from 'axios';
export default {
  name: "restaurantDetail",
  data() {
    return {
      restaurant: {}
    }
  },
  methods:{
    getApi(apiUrl, slug){
      axios
        .get(apiUrl + 'restaurant-detail/' + slug)
        .then(res => {
          this.restaurant = res.data;
          console.log(res.data);
        })
        .catch(err => {
          console.log(err.message);
        })
    }
  },
  mounted(){
    this.getApi(store.apiUrl, this.$route.params.slug);
  }
};
</script>

<template>
  <div>
    <!-- <div class="restaurant-image">
      <img v-for="product in restaurant.products" :key="product.id" :src="'http://127.0.0.1:8000/storage/' + product.image" alt="">
    </div> -->
  </div>
</template>

<style lang="scss" scoped>
.jumbotron img {
  width: 100vw;
  height: 200px;
  object-fit: cover;
}
</style>
