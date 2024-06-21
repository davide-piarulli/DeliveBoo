<script>
export default {
  name: "RestaurantDetail",
  props: {
    restaurant: {
      type: Object,
      required: true,
      default: () => ({}),
    },
  },
  data() {
    return {};
  },
};
</script>

<template>
  <div>
    <div class="jumbotron">
      <img src="/default-logo.png" alt="" />
    </div>

    <div class="informzioni" v-if="restaurant.name">
      <h3>{{ restaurant.name }}</h3>
      <span>via</span>
      <span>te</span>
    </div>
    <div v-else>
      <h3>Ristorante non trovato</h3>
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
