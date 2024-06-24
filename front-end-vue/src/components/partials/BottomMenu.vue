<!-- <script>
export default {
  data(){
    return{
      isSearching: false,
      toSearch: ''
    }
  },
  methods:{
    changeScroll(){
      if(this.isSearching){
        document.body.classList.add('overflow-hidden')
      } else {
        document.body.classList.remove('overflow-hidden')
      }
    }
  }
}
</script>

<template>
  <div class="bottom-menu d-sm-none bg-black">
    <div class="layer d-flex flex-column" :class="{'layer-active' : isSearching}">
      <div class="text-end" :class="{'d-none' : !isSearching}">
        <span @click="isSearching = false; changeScroll()" class="text-danger d-inline-block p-2"><i class="fa-solid fa-xmark"></i></span>
      </div>
      <div class="searchbar my-auto d-flex justify-content-center px-3 py-5" :class="{'d-none' : !isSearching}">
        <input type="text" class="form-control w-75 mx-2" v-model="toSearch">
        <button @click="toSearch = ''; isSearching = false; changeScroll()" class="btn btn-light mx-2">Cerca</button>
      </div>
    </div>
    <nav>
      <ul class="d-flex justify-content-around align-items-center m-0 p-0">
        <li>
          <router-link class="d-flex flex-column align-items-center text-white text-decoration-none cp">
            <span class="fs-5"><i class="fa-solid fa-utensils"></i></span>
            <span class="fs-5">Ristoranti</span>
          </router-link>
        </li>
        <li>
          <a @click="this.isSearching = !this.isSearching; changeScroll()" class="d-flex flex-column align-items-center text-white text-decoration-none cp">
            <span class="fs-5"><i class="fa-solid fa-magnifying-glass"></i></span>
            <span class="fs-5">Cerca</span>
          </a>
        </li>
        <li>
          <router-link class="d-flex flex-column align-items-center text-white text-decoration-none cp">
            <span class="fs-5"><i class="fa-solid fa-cart-shopping"></i></span>
            <span class="fs-5">Carrello</span>
          </router-link>
        </li>
      </ul>
    </nav>
  </div>
</template> 

<style lang="scss" scoped>

  .bottom-menu{
    width: 100%;
    height: 70px;
    padding: 5px;
    position: fixed;
    bottom: 0;
    left: 0;
    z-index: 998;
    .layer{
      width: 100%;
      height: 0;
      position: absolute;
      bottom: 100%;
      left: 0;
      transition: all .5s;
      background-color: rgba(black, .85);
    }
    .layer-active{
      height: calc(100vh - 70px) !important;
    }
  }

</style> -->