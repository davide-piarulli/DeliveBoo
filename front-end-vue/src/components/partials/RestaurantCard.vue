<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-img-container position-relative overflow-hidden">
        <img
          src="https://image.tmdb.org/t/p/w500/sd4xN5xi8tKRPrJOWwNiZEile7f.jpg"
          alt="Immagine Articolo in Evidenza"
          class="card-img-top my-img"
          :class="{ 'zoomed': isHovered }"
          @mouseover="isHovered = true"
          @mouseleave="isHovered = false"
        >
        <div class="overlay" v-if="isHovered"></div>
      </div>
      <div class="card-body">
        <h5 class="card-title">$90</h5>
        <h6 class="card-subtitle mb-2 text-muted">
          <a href="https://reservq.minionionbd.com/menu/bbq-pulled-pork-sandwich" class="text-decoration-none text-dark">BBQ Pulled Pork Sandwich</a>
        </h6>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex align-items-center">
            <i class="bi bi-check-circle-fill text-warning me-2"></i>
            <span>4 Pezzi di Pollo</span>
          </li>
          <li class="list-group-item d-flex align-items-center">
            <i class="bi bi-check-circle-fill text-warning me-2"></i>
            <span>Salsa Piccante</span>
          </li>
        </ul>

        <div class="btn btn-outline-dark">Aggiungi al Carrello</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "RestaurantCardVue",
  data() {
    return {
      isHovered: false,
    };
  },
};
</script>

<style scoped>
.card-img-container {
  position: relative; /* Posizione relativa per contenere l'overlay */
  overflow: hidden; /* Nasconde l'overflow dell'immagine */
}

.my-img {
  transition: transform 0.3s ease-out; /* Transizione per il cambiamento di scala */
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
  background-color: rgba(255, 255, 255, 0.1); /* Colore dell'overlay */
  transition: opacity 0.3s ease-out; /* Transizione per l'opacità */
  pointer-events: none; /* Per evitare che l'overlay interferisca con gli eventi del mouse */
}

.overlay:hover {
  opacity: 0.5; /* Opacità al passaggio del mouse */
}

.zoomed {
  transform: scale(1.1); /* Scala l'immagine al passaggio del mouse */
}
</style>
