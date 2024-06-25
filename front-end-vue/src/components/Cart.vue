<script>
import { store } from "@/data/store";
export default {
  data() {
    return {
      store,
    };
  },

  methods: {
    updatePrice() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      let subtotalPrice = 0;
      cart.forEach((product) => {
        subtotalPrice =
          subtotalPrice + parseFloat(product.price) * product.quantity;
      });
      store.subtotal = subtotalPrice.toFixed(2);
      let totalPrice = parseFloat(store.subtotal) + parseFloat(store.shipping);
      store.total = totalPrice.toFixed(2);
      store.counter = cart.length;
    },

    showCart() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      store.cart = cart;
    },

    // diminuisco quantità
    decreaseQuantity(productId) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      let existingProduct = cart.find((item) => item.id === productId);

      if (existingProduct && existingProduct.quantity > 1) {
        existingProduct.quantity -= 1;
      } else {
        // Se la quantità è 1 o minore, rimuovo il prodotto
        cart = cart.filter((item) => item.id !== productId);
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      this.showCart();
      this.updatePrice();
    },

    // aumento quantità
    increaseQuantity(productId) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      let existingProduct = cart.find((item) => item.id === productId);

      if (existingProduct) {
        existingProduct.quantity += 1;
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      this.showCart();
      this.updatePrice();
    },

    // elimino prodotto
    deleteItem(productId) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      cart = cart.filter((item) => item.id !== productId);
      localStorage.setItem("cart", JSON.stringify(cart));
      store.cart = cart;
      this.updatePrice();
    },
  },
  computed: {
    hasItemsInCart() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      return cart.length > 0;
    },
    // itemQuantity() {
    //   let cart = JSON.parse(localStorage.getItem("cart")) || [];
    //   let quantity = 0;
    //   cart.forEach((item) => {
    //     quantity = quantity + parseInt(item.quantity);
    //     console.log(quantity);
    //   });
    //   return quantity;
    // },
  },
  mounted() {
    this.updatePrice();
    // localStorage.removeItem('cart')
  },
};
</script>

<template>
  <div>
    <button
      class="cart position-relative"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasRight"
      aria-controls="offcanvasRight"
    >
      <i class="fa-solid fa-cart-shopping"></i>
      <span v-if="hasItemsInCart" class="cart-badge">{{
        store.cart.length
      }}</span>
    </button>

    <div
      class="offcanvas w-100 offcanvas-end"
      tabindex="-1"
      id="offcanvasRight"
      aria-labelledby="offcanvasRightLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrello</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <!-- inizio vero carrello -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-xl-8">
              <div class="square container-fluid p-4 mb-3">
                <div v-if="store.cart.length === 0">
                  Non ci sono prodotti nel carrello
                </div>
                <div
                  v-for="item in store.cart"
                  :key="item.id"
                  class="row d-flex justify-content-center position-relative mb-2 bg-white rounded-2 p-2"
                >
                  <div class="col-4 mb-4 mb-lg-0">
                    <!-- immagine -->
                    <div
                      class="bg-image w-75 text-center item-image hover-overlay hover-zoom ripple rounded"
                      data-mdb-ripple-color="light"
                    >
                      <img
                        :src="
                          item.image == null
                            ? '/no-food.jpg'
                            : 'http://127.0.0.1:8000/storage/' + item.image
                        "
                        class="w-100 mx-auto"
                        :alt="item.name"
                      />
                      <a href="#!">
                        <div
                          class="mask"
                          style="background-color: rgba(251, 251, 251, 0.2)"
                        ></div>
                      </a>
                    </div>
                    <!-- immagine -->
                  </div>

                  <div class="col-8 mb-4 mb-lg-0">
                    <!-- Dati -->
                    <p>
                      <strong>{{ item.name }}</strong>
                    </p>
                    <p class="text-start">
                      <strong>${{ item.price }}</strong>
                    </p>
                    <button
                      type="button"
                      data-mdb-button-init
                      data-mdb-ripple-init
                      class="btn btn-danger me-1 mt-1 mb-2 position-absolute top-0 end-0"
                      data-mdb-tooltip-init
                      title="Remove item"
                      @click="deleteItem(item.id)"
                    >
                      <i class="fas fa-trash"></i>
                    </button>

                    <div class="d-flex mb-4" style="max-width: 300px">
                      <button
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-primary px-3 me-2"
                        @click="decreaseQuantity(item.id)"
                      >
                        <i class="fas fa-minus"></i>
                      </button>

                      <span>{{ item.quantity }}</span>

                      <button
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-primary px-3 ms-2"
                        @click="increaseQuantity(item.id)"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>

                    <!-- Dati -->
                  </div>
                </div>
              </div>
            </div>

            <!-- Riepilogo Ordine -->
            <div class="col-12 col-xl-4">
              <div class="square mb-3 p-4">
                <div class="bg-white rounded-1 p-2">
                  <h5>Riepilogo ordine</h5>
                  <div v-if="store.subtotal != 0">
                    <h6>Prodotti: € {{ store.subtotal }}</h6>
                    <h6>Consegna: € {{ store.shipping }}</h6>
                    <h6>
                      Totale ordine: €
                      {{ store.total }}
                    </h6>
                  </div>
                </div>
              </div>
            </div>

            <!-- Dati di consegna -->
            <div class="col-12">
              <div class="square mb-3 p-4">
                <h4>Dettagli per la consegna</h4>
                <form class="row g-3">
                  <div class="col-md-6">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" />
                  </div>
                  <div class="col-md-6">
                    <label for="lastName" class="form-label">Cognome</label>
                    <input type="text" class="form-control" id="lastName" />
                  </div>
                  <div class="col-12">
                    <label for="inputAddress" class="form-label"
                      >Indirizzo</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="inputAddress"
                      placeholder="Via Roma 14..."
                    />
                  </div>
                  <div class="col-md-6">
                    <label for="inputAddress2" class="form-label"
                      >Indirizzo aggiuntivo</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="inputAddress2"
                      placeholder="Citofono e altri dettagli utili"
                    />
                  </div>
                  <div class="col-md-6">
                    <label for="inputTelephone" class="form-label"
                      >Numero di telefono</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="inputTelephone"
                      placeholder="+39..."
                    />
                  </div>
                  <div class="col-md-6">
                    <label for="inputCity" class="form-label">Città</label>
                    <input type="text" class="form-control" id="inputCity" />
                  </div>
                  <div class="col-md-4">
                    <label for="inputState" class="form-label">Provincia</label>
                    <select id="inputState" class="form-select">
                      <option selected>Scegli...</option>
                      <option value="AG">Agrigento</option>
                      <option value="AL">Alessandria</option>
                      <option value="AN">Ancona</option>
                      <option value="AO">Aosta</option>
                      <option value="AR">Arezzo</option>
                      <option value="AP">Ascoli Piceno</option>
                      <option value="AT">Asti</option>
                      <option value="AV">Avellino</option>
                      <option value="BA">Bari</option>
                      <option value="BT">Barletta-Andria-Trani</option>
                      <option value="BL">Belluno</option>
                      <option value="BN">Benevento</option>
                      <option value="BG">Bergamo</option>
                      <option value="BI">Biella</option>
                      <option value="BO">Bologna</option>
                      <option value="BZ">Bolzano</option>
                      <option value="BS">Brescia</option>
                      <option value="BR">Brindisi</option>
                      <option value="CA">Cagliari</option>
                      <option value="CL">Caltanissetta</option>
                      <option value="CB">Campobasso</option>
                      <option value="CI">Carbonia-Iglesias</option>
                      <option value="CE">Caserta</option>
                      <option value="CT">Catania</option>
                      <option value="CZ">Catanzaro</option>
                      <option value="CH">Chieti</option>
                      <option value="CO">Como</option>
                      <option value="CS">Cosenza</option>
                      <option value="CR">Cremona</option>
                      <option value="KR">Crotone</option>
                      <option value="CN">Cuneo</option>
                      <option value="EN">Enna</option>
                      <option value="FM">Fermo</option>
                      <option value="FE">Ferrara</option>
                      <option value="FI">Firenze</option>
                      <option value="FG">Foggia</option>
                      <option value="FC">Forlì-Cesena</option>
                      <option value="FR">Frosinone</option>
                      <option value="GE">Genova</option>
                      <option value="GO">Gorizia</option>
                      <option value="GR">Grosseto</option>
                      <option value="IM">Imperia</option>
                      <option value="IS">Isernia</option>
                      <option value="SP">La Spezia</option>
                      <option value="AQ">L'Aquila</option>
                      <option value="LT">Latina</option>
                      <option value="LE">Lecce</option>
                      <option value="LC">Lecco</option>
                      <option value="LI">Livorno</option>
                      <option value="LO">Lodi</option>
                      <option value="LU">Lucca</option>
                      <option value="MC">Macerata</option>
                      <option value="MN">Mantova</option>
                      <option value="MS">Massa-Carrara</option>
                      <option value="MT">Matera</option>
                      <option value="VS">Medio Campidano</option>
                      <option value="ME">Messina</option>
                      <option value="MI">Milano</option>
                      <option value="MO">Modena</option>
                      <option value="MB">Monza e Brianza</option>
                      <option value="NA">Napoli</option>
                      <option value="NO">Novara</option>
                      <option value="NU">Nuoro</option>
                      <option value="OG">Ogliastra</option>
                      <option value="OT">Olbia-Tempio</option>
                      <option value="OR">Oristano</option>
                      <option value="PD">Padova</option>
                      <option value="PA">Palermo</option>
                      <option value="PR">Parma</option>
                      <option value="PV">Pavia</option>
                      <option value="PG">Perugia</option>
                      <option value="PU">Pesaro e Urbino</option>
                      <option value="PE">Pescara</option>
                      <option value="PC">Piacenza</option>
                      <option value="PI">Pisa</option>
                      <option value="PT">Pistoia</option>
                      <option value="PN">Pordenone</option>
                      <option value="PZ">Potenza</option>
                      <option value="PO">Prato</option>
                      <option value="RG">Ragusa</option>
                      <option value="RA">Ravenna</option>
                      <option value="RC">Reggio Calabria</option>
                      <option value="RE">Reggio Emilia</option>
                      <option value="RI">Rieti</option>
                      <option value="RN">Rimini</option>
                      <option value="RM">Roma</option>
                      <option value="RO">Rovigo</option>
                      <option value="SA">Salerno</option>
                      <option value="SS">Sassari</option>
                      <option value="SV">Savona</option>
                      <option value="SI">Siena</option>
                      <option value="SR">Siracusa</option>
                      <option value="SO">Sondrio</option>
                      <option value="TA">Taranto</option>
                      <option value="TE">Teramo</option>
                      <option value="TR">Terni</option>
                      <option value="TO">Torino</option>
                      <option value="TP">Trapani</option>
                      <option value="TN">Trento</option>
                      <option value="TV">Treviso</option>
                      <option value="TS">Trieste</option>
                      <option value="UD">Udine</option>
                      <option value="VA">Varese</option>
                      <option value="VE">Venezia</option>
                      <option value="VB">Verbania</option>
                      <option value="VC">Vercelli</option>
                      <option value="VR">Verona</option>
                      <option value="VV">Vibo Valentia</option>
                      <option value="VI">Vicenza</option>
                      <option value="VT">Viterbo</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="inputCap" class="form-label">CAP</label>
                    <input type="text" class="form-control" id="inputCap" />
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                      Procedi all'ordine
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- fine vero carrello  -->
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../assets/scss/main.scss" as *;

.square {
  min-height: 300px;
  // border: 1px solid black;
  background-color: $color-7;
  border-radius: 2%;
}

.cart {
  background-color: transparent;
  border: none;
  color: $color-10;
  .cart-badge {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 5px 10px;
    font-size: 10px;
  }
}

@media screen and (min-width: 992px) {
  .item-image {
    width: 100%;
  }
}
@media screen and (min-width: 1200px) {
  .offcanvas {
    width: 1200px !important;
  }
}
</style>
