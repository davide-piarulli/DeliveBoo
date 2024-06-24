<script>
  export default {

  }
</script>

<template>
  <footer class="footer bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-logo">
                    <div class="logo mb-3">
                        <img src="/logo.png" alt="logo" width="50" height="50" class="d-inline-block align-text-top">
                    </div>
                </div>
                <div class="footer-icon">
                    <div class="icon">
                        <a href="" target="_blank"><i class="fab fa-facebook-f fs-4 pe-3"></i></a>
                        <a href="" target="_blank"><i class="fab fa-twitter fs-4 p-3"></i></a>
                        <a href="" target="_blank"><i class="fab fa-linkedin fs-4 p-3"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row justify-content-between">
                  
                    <div class="col-lg-3">
                        <div class="quick-line-item">
                            <div class="quick-line-menu">
                                <ul>
                                    <h3 class="text-white mb-3">Termini & Privacy</h3>
                                    <li><a href="">Privacy & Politica</a></li>
                                    <li><a href="">Termini di Servizio</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="quick-line-item">
                            <div class="quick-line-item-head">
                                <h3 class="text-white mb-3 ">Iscriviti alla nostra Newsletter</h3>
                            </div>
                            <form action="" method="POST">
                                <input type="hidden" name="_token" value="">
                                <div class="quick-line-btn">
                                    <input type="email" name="email" class="form-control" id="" placeholder="Email">
                                    <button class="btn btn-primary" type="submit">Iscriviti</button>
                                </div>
                            </form>
                            <div class="quick-line-btn-text">
                                <h6 class="text-white mt-3">Accettiamo metodi di pagamento:</h6>
                            </div>
                            <div class="quick-line-btn-img">
                                <a href="#"><img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-08-41-2782.png" alt="Metodo di pagamento"></a>
                                <a href="#"><img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-09-00-2179.png" alt="Metodo di pagamento"></a>
                                <a href="#"><img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-09-29-6264.png" alt="Metodo di pagamento"></a>
                                <a href="#"><img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-11-52-9757.png" alt="Metodo di pagamento"></a>
                            </div>
                        </div>
                    </div>
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

  @media screen and (max-width: 568px) {
    footer{
      margin-bottom: 70px;
    }
  }
</style>