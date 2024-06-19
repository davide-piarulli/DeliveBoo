<script>
import { store } from "../data/store";
import axios from "axios";

export default {
  name: "Home",

  data() {
    return {
      types: [],
    };
  },

  methods: {
    getApi() {
      axios
        .get(store.apiUrl + "type_restaurant")
        .then((result) => {
          this.types = result.data.data;
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
  <div class="container d-flex justify-content-center">
    <h1 class="my-4">Tipi di ristorante:</h1>
    <div>
      <ul>
        <li v-for="(type) in types" :key="type.id">
          {{ type.id }} --- {{ type.name }}
        </li>
      </ul>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
