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
  <div class="p-5">
    <div class="container">
      <div class=" d-flex row">
        <ProductCard v-for="product in restaurant.products" :key ="product.id" :product = product />   
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>

</style>
