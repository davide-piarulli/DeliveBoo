<script>
import { store } from "../data/store";
import axios from "axios";
import Jumbotron from "../components/Jumbotron.vue";
import Button from "../components/partials/Button.vue";
import RestaurantCard from "../components/partials/RestaurantCard.vue";
import Loader from "../components/partials/Loader.vue";
import Carousel from "../components/partials/Carousel.vue";

export default {
  name: "Home",

  data() {
    return {
      types: [],
      restaurants: [],
      filters: [],
      carouselRestaurants: [],
      activeButton: false,
      isLoading: true,
    };
  },

  components: {
    Button,
    RestaurantCard,
    Jumbotron,
    Loader,
    Carousel,
  },

  methods: {
    filterRestaurants(type) {
      !this.filters.includes(type)
        ? this.filters.push(type)
        : this.filters.splice(this.filters.indexOf(type), 1);

      if (this.filters.length > 0) {
        this.getApi(store.apiUrl, "filter");
      } else {
        this.getApi(store.apiUrl, "restaurants");
      }
    },
    getApi(apiUrl, endpoint = "") {
      axios
        .get(apiUrl + endpoint, {
          params: {
            filters: this.filters,
          },
        })
        .then((result) => {
          this.isLoading = false;
          if (endpoint == "types" || endpoint == "") {
            this.types = result.data.map((item) => {
              return {
                ...item,
                active: false,
              };
            });
          } else if (endpoint == "restaurants") {
            this.restaurants = result.data;
            this.carouselRestaurants = result.data;
          } else if (endpoint == "filter") {
            this.restaurants = result.data;
          }
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
  },
  mounted() {
    window.scrollTo(0, 0);
    this.getApi(store.apiUrl, "types");
    this.getApi(store.apiUrl, "restaurants");
  },
};
</script>

<template>
  <div>
    <Jumbotron v-if="!isLoading" />

    <div class="container mt-5 w-50" v-if="!isLoading">
      <Carousel :restaurants="carouselRestaurants" />
    </div>

    <Loader v-if="isLoading" />
    <section
      v-if="!isLoading"
      id="restaurants"
      class="container d-flex flex-column justify-content-center py-5"
    >
      <div class="title d-flex justify-content-center">
        <h1 class="mb-4">Tipi di ristorante:</h1>
      </div>
      <div
        class="table_c d-flex justify-content-center row row-cols-3 row-cols-md-auto"
      >
        <Button
          v-for="(type, index) in types"
          :key="index"
          class="m-2"
          :class="type.active === true ? 'active' : ''"
          :text="type.name"
          @click="
            type.active = !type.active;
            filterRestaurants(type);
          "
        />
      </div>

      <div
        class="mt-5 d-flex justify-content-center restaurants row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4"
      >
        <!-- Cards -->
        <div
          v-for="(restaurant, index) in restaurants"
          :key="index"
          class="col mb-4 d-flex justify-content-center"
        >
          <RestaurantCard :restaurant="restaurant" />
        </div>
      </div>
    </section>
    <!-- <BottomMenu /> -->
  </div>
</template>

<style lang="scss" scoped>
@use "../assets/scss/main.scss" as *;

.table_c {
  border: 1px solid rgba($button-color, 0.2);
  border-radius: 10px;
}

.active {
  background-color: $button-color;
  border-radius: 10px;
  color: white;
}
</style>
