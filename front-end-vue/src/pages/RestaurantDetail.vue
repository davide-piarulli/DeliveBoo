<script>
import {store} from '../data/store';
import axios from 'axios';
import ProductCard from '../components/partials/ProductCard.vue';
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
          console.log(this.restaurant);
        })
        .catch(err => {
          console.log(err.message);
        })
    }
  },
  mounted(){
    this.getApi(store.apiUrl, this.$route.params.slug);
  },

  components:{
    ProductCard
  }
};
</script>

<template>
  <div>
    <!-- <div class="restaurant-image">
      <img v-for="product in restaurant.products" :key="product.id" :src="'http://127.0.0.1:8000/storage/' + product.image" alt="">
    </div> -->
    <!-- è solo una prova -->
    <div class="container">
      <div class=" d-flex row row-cols-3">
    
         <ProductCard v-for="product in restaurant.products" :key ="product.id" :product = product />
    
     
    </div>
    </div>
    
  </div>
</template>

<style lang="scss" scoped>
.jumbotron img {
  width: 100vw;
  height: 200px;
  object-fit: cover;
}
</style>
