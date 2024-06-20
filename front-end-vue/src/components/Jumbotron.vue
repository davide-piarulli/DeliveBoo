<script>
export default {};
</script>

<template>
  <div class="jumbotron">
    <div class="jumbotron-content">
      <img src="/logo.png" alt="logo-deliveboo" class="logo" />
      <h1>Benvenuti su DeliveBoo</h1>
      <p>Il miglior servizio di food delivery della tua città!</p>
      <!-- tasto Ordina Ora che scorre alla sezione sotto di scelta del ristorante -->
      <a href="#restaurants" class="btn btn-primary">Ordina ora</a>
      <div class="arrow">
        <a href="#restaurants"><i class="fa-solid fa-chevron-down"></i></a>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../assets/scss/main.scss" as *;
.jumbotron {
  background-image: url("/img/jumbotron-image.png");
  background-size: cover;
  background-position: center;
  color: white;
  height: 700px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  position: relative;
  padding: 20px;
}
.jumbotron::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
}
.jumbotron-content {
  position: relative;
  top: 50px;
  z-index: 1;
  max-width: 600px;
  height: 100%;
}

.jumbotron-content .logo {
  width: 50%;
  border-radius: 50%;
}

.jumbotron-content .arrow {
  position: absolute;
  bottom: 50px;
  left: 50%;
  color: white;
  a {
    color: white;
  }
}

.jumbotron h1 {
  font-size: 2rem;
  margin-top: 20px;
  margin-bottom: 20px;
}

.jumbotron p {
  font-size: 1.2rem;
  margin-bottom: 30px;
}

// in teoria il css del btn sarà da togliere, sostituire con i btn di Oltion
.btn {
  text-decoration: none;
  padding: 15px 30px;
  font-size: 1em;
  border-radius: 5px;
  transition: background 0.3s ease;
}

.btn-primary {
  background: $color-1;
  color: white;
  border: none;
}

.btn-primary:hover {
  background: $color-7;
}

// media query
@media (min-width: 768px) {
  .jumbotron h1 {
    font-size: 3rem;
  }

  .jumbotron p {
    font-size: 1.5rem;
  }

  .btn {
    padding: 20px 40px;
    font-size: 1.2rem;
  }
}
</style>
