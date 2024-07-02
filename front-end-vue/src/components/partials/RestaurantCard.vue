<script>
export default {
  name: "RestaurantCard",
  props: {
    restaurant: Object
  },
  data() {
    return {
      isHovered: false,
    };
  },
};
</script>



<template>
  <div class="container mt-5">
    <router-link :to="{name: 'restaurantDetail', params: {slug: restaurant.slug}}" class="text-decoration-none">
      <div class="card card-size rounded-4 overflow-hidden">
        <div class="card-img-container">
          <img
            :src="restaurant.logo ? 'http://127.0.0.1:8000/storage/' + restaurant.logo : '/default-logo.png'"
            onerror="this.src = '/default-logo.png'"
            :alt="restaurant.name + ' logo'"
            class="card-img-top my-img"
            :class="{ zoomed: isHovered, 'six-fingers' : restaurant.name == 'Trattoria da Luigi'}"
            @mouseover="isHovered = true"
            @mouseleave="isHovered = false"
          />
          <div class="overlay" v-if="isHovered"></div>
        </div>
        <div class="card-body card_body_h p-0">
          <h4 class="card-title text-center p-2">{{ restaurant.name }}</h4>
          <div class="d-flex flex-wrap">
            <h5 class="d-inline-block m-2" v-for="(type) in restaurant.types" :key="type.id"><span class="badge-type badge rounded-2">{{type.name}}</span></h5>
          </div>
        </div>
      </div>
    </router-link>
  </div>
</template>



<style lang="scss" scoped>

@use "../../assets/scss/main.scss" as *;

.card-img-container {
  position: relative;
  overflow: hidden;
}

.my-img {
  transition: transform 0.3s ease-out;
  height: 250px;
  width: 100%;
  object-fit: cover;
}

.card-size{
  height: 450px;
  box-shadow: 0 0 10px 2px $color-9;
}

.card_body_h{
  height: 200px;
  background-color: $color-4;
  overflow-y: auto;
}

.card-title{
  font-weight: bold;
  background-color: $color-6;
  color: $color-2;
}

::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track { 
  box-shadow: inset 0 0 5px #FFFFFF; 
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  background: #95ADCD; 
  border-radius: 10px; 
}

::-webkit-scrollbar-thumb:hover {
  background: #3D5064; 
}

.badge-type{
  color:  $color-1 !important;
  background-color: $color-9;
}

</style>
