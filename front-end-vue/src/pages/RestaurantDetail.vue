<script>
import {store} from '../data/store';
import axios from 'axios';
import ProductCard from '../components/partials/ProductCard.vue';
import Loader from '../components/partials/Loader.vue';
export default {
  name: "restaurantDetail",
  components:{
    ProductCard,
    Loader
  },
  data() {
    return {
      restaurant: {},
      isLoading: true
    }
  },
  methods:{
    getApi(apiUrl, slug){
      axios
        .get(apiUrl + 'restaurant-detail/' + slug)
        .then(res => {
          this.isLoading = false;
          this.restaurant = res.data;
        })
        .catch(err => {
          console.log(err.message);
        })
    }
  },
  mounted(){
    window.scrollTo(0, 0);
    this.getApi(store.apiUrl, this.$route.params.slug);
  }
};
</script>

<template>
  <div class="p-5">
    <Loader v-if="isLoading" :height1="107" :height2="0"/>
    <div v-else class="container">
      <h1 class="text-center">{{ restaurant.name }}</h1>
      <div class=" d-flex row">
        <ProductCard v-for="product in restaurant.products" :key ="product.id" :product = product />   
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>

</style>
