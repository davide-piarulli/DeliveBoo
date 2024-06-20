<script>
export default {
  name: "RestaurantCard",
  props: {
    name: {
      type: String,
      required: true,
    },
    slug: {
      type: String,
      required: true,
    },
    address: {
      type: String,
      required: true,
    },
    phone: {
      type: String,
      required: true,
    },
    logo: {
      type: String,
      required: true,
      default: "default-logo.png",
      validator: (value) => /\.(jpg|jpeg|png|gif|svg)$/.test(value),
    },
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
    <div class="card">
      <div class="card-img-container">
        <img
          :src="logo"
          :alt="name + ' logo'"
          class="card-img-top my-img"
          :class="{ zoomed: isHovered }"
          @mouseover="isHovered = true"
          @mouseleave="isHovered = false"
        />
        <div class="overlay" v-if="isHovered"></div>
      </div>
      <div class="card-body">
        <h5 class="card-title">{{ name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">
          <a
            :href="`https://reservq.minionionbd.com/menu/${slug}`"
            class="text-decoration-none text-dark"
            >{{ name }}</a
          >
        </h6>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex align-items-center">
            <i class="bi bi-check-circle-fill text-warning me-2"></i>
            <span>{{ address }}</span>
          </li>
          <li class="list-group-item d-flex align-items-center">
            <i class="bi bi-check-circle-fill text-warning me-2"></i>
            <span>{{ phone }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>
.card-img-container {
  position: relative;
  overflow: hidden;
}

.my-img {
  transition: transform 0.3s ease-out;
  height: 100%;
  width: 100%;
  object-fit: cover;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.1);
  transition: opacity 0.3s ease-out;
  pointer-events: none;
}

.zoomed {
  transform: scale(1.1);
}
</style>
