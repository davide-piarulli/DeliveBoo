<script>
  export default {
    name: 'Carousel',
    props: {
        restaurants: Array
    }
  }
</script>

<template>
  <div>
    <div id="carouselExampleCaptions" class="carousel slide my_slider d-none d-lg-block">
      <div class="carousel-indicators">
        <button
          v-for="(restaurant, index) in restaurants"
          :key="'indicator-' + restaurant.id"
          type="button"
          :data-bs-target="'#carouselExampleCaptions'"
          :data-bs-slide-to="index"
          :class="{ active: index === 0 }"
          :aria-current="index === 0 ? 'true' : false"
          :aria-label="'Slide ' + (index + 1)"
        ></button>
      </div>
      <div class="carousel-inner">
        <div
          v-for="(restaurant, index) in restaurants"
          :key="restaurant.id"
          :class="['carousel-item', { active: index === 0 }]"
        >
          <router-link
            :to="{ name: 'restaurantDetail', params: { slug: restaurant.slug } }"
            class="my_slider text-decoration-none"
          >
            <img
              :src="restaurant.logo ? 'http://127.0.0.1:8000/storage/' +  restaurant.logo : '/default-logo.png'"
              class="d-block w-100"
              :class="{'six-fingers' : restaurant.name == 'Trattoria da Luigi'}"
              onerror="this.src = '/default-logo.png'"
              :alt="restaurant.name">
            <div class="carousel-caption d-none d-md-block">
              <h5 class="name_resto">{{ restaurant.name }}</h5>
            </div>
          </router-link>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</template>



<style lang="scss" scoped>
@use '../../assets/scss/main.scss' as*;
.my_slider{
  cursor: pointer;
  border-radius: 15px;
  overflow: hidden;
  .name_resto{
    font-size: 3rem;
    text-shadow: 2px 2px $color-8;
    background: rgba($color-10, $alpha: 0.2);
    border-radius: 15px;
  }
}
</style>