<script>
import { store } from "../data/store";
import axios from "axios";
import Jumbotron from "../components/Jumbotron.vue";
import Button from "../components/partials/Button.vue";
import RestaurantCard from "../components/partials/RestaurantCard.vue";

export default {
  name: "Home",

  data() {
    return {
      types: [],
      filters: [],
      activeButton: false,
      restaurants: [],
    };
  },

  components: {
    Button,
    RestaurantCard,
    Jumbotron,
  },

  methods: {
    filterRestaurants(typeId) {
      this.filters.push(typeId);
      console.log(this.filters);
      this.getApi(store.apiUrl, "filter-restaurants");
    },
    getApi(apiUrl, endpoint = "") {
      axios
        .get(apiUrl + endpoint, {
          params: { filters: this.filters },
        })
        .then((result) => {
          if (endpoint == "types" || endpoint == "") {
            //this.types = result.data.data;
            this.types = result.data.map((item) => {
              return {
                ...item,
                active: false,
              };
            });
          } else if (endpoint == "restaurants") {
            this.restaurants = result.data;
            console.log(this.restaurants);
          }

          console.log(this.types);
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
  },
  mounted() {
    this.getApi(store.apiUrl, "types");
    this.getApi(store.apiUrl, "restaurants");
  },
};
</script>

<template>
  <div>
    <Jumbotron />
    <section
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
            filterRestaurants(type.id);
          "
        />
      </div>

      <div
        class="mt-5 d-flex justify-content-center restaurants row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4"
      >
        <!-- Cards -->
        <div
          v-for="(item, index) in 8"
          :key="index"
          class="col mb-4 d-flex justify-content-center"
        >
          <RestaurantCard />
        </div>
      </div>
    </section>
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
