<script>
import { store } from '../data/store';
import axios from 'axios';
import ProductCard from '../components/partials/ProductCard.vue';
import Loader from '../components/partials/Loader.vue';
export default {
  name: "restaurantDetail",
  components: {
    ProductCard,
    Loader
  },
  data() {
    return {
      restaurant: {},
      isLoading: true,
    }
  },
  methods: {
    getApi(apiUrl, slug) {
      axios
        .get(apiUrl + 'restaurant-detail/' + slug)
        .then(res => {
          this.isLoading = false;
          this.restaurant = res.data;
        })
        .catch(err => {
          console.log(err.message);
        })
    },
    openModal() {
      this.$refs.openModal.click();
    },
    modalResult(result) {
      store.cartSwitch = result;
    }
  },
  mounted() {
    window.scrollTo(0, 0);
    this.getApi(store.apiUrl, this.$route.params.slug);
    
  }
};
</script>

<template>
  <div class="p-5" :class="restaurant.products?.length == 0 ? 'vh-100' : '' ">

    <!-- Modal -->
    <button ref="openModal" type="button" class="btn btn-primary d-none" data-bs-toggle="modal"
      data-bs-target="#staticBackdrop"></button>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">DeliveBoo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
              @click="modalResult(false)"></button>
          </div>
          <div class="modal-body">
            Non puoi ordinare da più ristoranti contemporaneamente. <br>
            Vuoi svuotare il carrello e ordinare da questo
            ristorante?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
              @click="modalResult(false)">Annulla</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="modalResult(true)">Cambia
              Ristorante</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /Modal -->

    <Loader v-if="isLoading" :height1="107" :height2="0" />
    <div class="container h-100" v-else-if="restaurant.products?.length == 0 ">

      <div class="w-100 h-100 d-flex justify-content-center align-items-center">
        <h1 class="text-center">Il ristorante <span class="text-danger">{{ restaurant.name }}</span> non ha ancora prodotti</h1>
      </div>

    </div>
    <div v-else class="container">
      <div class="restaurant-data d-flex justify-content-center justify-content-lg-start align-items-center flex-wrap rounded-5 p-3 p-xl-5">
        <div class="restaurant-logo mb-3 mb-md-0 rounded-5 overflow-hidden">
          <img
            :src="restaurant.logo ? 'http://127.0.0.1:8000/storage/' + restaurant.logo : '/default-logo.png'"
            onerror="this.src = '/default-logo.png'"
            :alt="restaurant.name + ' logo'"
            class="img-fluid"
            :class="{'six-fingers' : restaurant.name == 'Trattoria da Luigi'}"
          />
        </div>
        <div class="ps-3 ps-lg-5">
          <h1>{{ restaurant.name }}</h1>
          <h4>{{ restaurant.address }}</h4>
          <h4>Tel: <a class="text-black text-decoration-none" :href="`tel:+39${restaurant.phone}`">{{ restaurant.phone }}</a></h4>
        </div>
      </div>
      <div class=" d-flex row">
        <ProductCard @openModal="openModal()" v-for="product in restaurant.products" :key="product.id"
          :product=product />
      </div>
    </div>

  </div>
</template>

<style lang="scss" scoped>

.modal-content {
  background-color: #2B3D4F;
  color: white;
  .modal-header, .modal-footer{
    border: 0;
  }

  .btn.btn-primary, .btn-close {
    border: 0;
    background-color: #A7C0E2 !important;
    color: black;
  }

  .btn.btn-secondary {
    border: 0;
    background-color: #60758E !important;
  }
}

.restaurant-data{
  background-color: #B9D3F7;
  .restaurant-logo{
    width: 200px;
  }
}

</style>
