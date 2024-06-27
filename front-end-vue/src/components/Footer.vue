<script>
export default {
  data(){
    return{
      newsletter: ''
    }
  }
}
</script>

<template>
  <footer class="footer bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="logo mb-3">
            <img src="/logo.png" alt="logo" width="50" height="50" class="rounded-5 overflow-hidden">
          </div>
          <div>
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f fs-4 pe-3"></i></a>
            <a href="https://x.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fs-4 p-3"></i></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <h3 class="text-white mb-3">Termini & Privacy</h3>
          <ul class="m-0 p-0">
            <li><a href="#">Privacy & Policy</a></li>
            <li><a href="#">Termini e condizioni</a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h3 class="text-white mb-3">Iscriviti alla nostra Newsletter</h3>
          <form @submit.prevent="newsletter = ''" action="#" method="POST">
            <div>
              <input type="email" name="email" class="form-control mb-3" placeholder="Email" v-model="newsletter">
              <button class="btn btn-primary" type="submit">Iscriviti</button>
            </div>
          </form>
          <h6 class="text-white mt-3">Metodi di pagamento:</h6>
          <div>
            <a href="#" class="me-2"><img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-08-41-2782.png" alt="VISA"></a>
            <a href="#" class="me-2"><img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-09-00-2179.png" alt="American Express"></a>
            <a href="#"><img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-11-52-9757.png" alt="Mastercard"></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<style lang="scss" scoped>
footer {
  padding: 50px;
}

footer a {
  text-decoration: none;
  color: white;

  &:hover {
    color: #3D5064;
  }
}
</style>
