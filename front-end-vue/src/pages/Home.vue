<script>
import { store } from "../data/store";
import axios from "axios";
import ButtonVue from "../components/partials/Button.vue";
import RestaurantCard from "@/components/partials/RestaurantCard.vue";

export default {
  name: "Home",

  data() {
    return {
      types: [],

      activeButton: false,
    };
  },

  components: {
    ButtonVue,
    RestaurantCard
  },

  methods: {
    getApi() {
      axios
        .get(store.apiUrl + "type_restaurant")
        .then((result) => {
          //this.types = result.data.data;
          this.types = result.data.data.map((item) => {
            return {
              ...item,
              active: false,
            };
          });
          console.log(this.types);
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
  },
  mounted() {
    this.getApi();
  },
};
</script>

<template>
  <section
    id="restaurants"
    class="container d-flex flex-column justify-content-center"
  >
    <div class="title d-flex justify-content-center">
      <h1 class="my-4">Tipi di ristorante:</h1>
    </div>
    <div
      class="table_c d-flex justify-content-center row row-cols-3 row-cols-md-auto p-1"
    >
      <ButtonVue
        v-for="(type, index) in types"
        :key="index"
        :class="type.active === true ? 'active' : ''"
        @click="type.active = !type.active"
        :text="type.name"
        class="m-2"
      />
    </div>

    <div
      class="mt-5 d-flex justify-content-center restaurants row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4"
    >
      <!-- INSERIRE LA CARD SOTTO -->
      <div
      v-for = "(item, index) in 20"
      :key="index"
        class="col mb-4 d-flex justify-content-center"
      >
        <RestaurantCard />
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
@use "../assets/scss/main.scss" as *;

.table_c {
  border: 1px solid rgba($button-color,  .2 );
  border-radius: 10px;
}

.active {
  background-color: $button-color;
  border-radius: 10px;
  color: white;
}
</style>
