<script>
import { store } from "../data/store";
import axios from "axios";
import braintree from "braintree-web";
export default {
  data() {
    return {
      store,

      hostedFieldInstance: false,
      clientToken: '',
      success: "",
      error: "",
      order: {},
      
      formData: {
        name: "",
        lastname: "",
        email: "",
        amount: 0,
        address: "",
        city: "",
        state: "",
        postal_code: "",
        phone: "",
        notes: "",
        transaction: "",
        products: [],
      },
    };
  },

  methods: {
    /////////////////////////////// Braintree ///////////////////////////////
    getClientToken() {
      axios.get(store.apiUrl + "orders/generate").then((res) => {
        this.clientToken = res.data.token;
        this.braintreeSystem();
      });
    },

    payWithCreditCard() {
      if (this.hostedFieldInstance) {
        this.hostedFieldInstance
          .tokenize()
          .then((payload) => {
            this.formData.transaction = payload.nonce;
            this.formData.amount = store.total;
            this.formData.products = store.cart;
            this.sendOrder();
          })
          .catch((err) => {
            console.log(err.message);
          });
      }
    },

    braintreeSystem() {
      if (this.initializing) return;

      this.initializing = true;

      braintree.client
        .create({
          authorization: this.clientToken,
        })
        .then((clientInstance) => {

          let options = {
            client: clientInstance,
            styles: {
              input: {
                "font-size": "16px",
                "font-family": "sans-serif",
              },
            },
            fields: {
              number: {
                maxCardLength: 16,
                selector: "#creditCardNumber",
                placeholder: "Inserisci la carta di credito",
              },
              cvv: {
                selector: "#cvv",
                placeholder: "Inserisci il CVV",
              },
              expirationDate: {
                selector: "#expireDate",
                placeholder: "00 / 0000",
              },
            },
          };

          return braintree.hostedFields.create(options);
        })
        .then((hostedFieldInstance) => {
          this.hostedFieldInstance = hostedFieldInstance;
          this.initializing = false;
        })
        .catch((error) => {
          console.error('Error initializing Braintree Hosted Fields:', error);
          this.initializing = false;
        });
    },


    sendOrder() {
      axios
        .get(store.apiUrl + "orders/get", {
          params: this.formData
        })
        .then(res => {
          this.success = res.data.success;
          this.order = res.data.data;
          console.log(this.success, this.order);
          if (this.success) {
          store.cart = [];
          store.subtotal = 0;
          store.total = 0;
          store.cartCounter = 0;
          localStorage.setItem("cart", JSON.stringify(store.cart));
          this.$refs.CloseCart.click();
          this.$router.push({ name: 'orderSuccess' });
          }
        })
        .catch(err => {
          this.error = err.message;
          console.log(this.error);
        })
    },

    /////////////////////////////// Carrello ///////////////////////////////
    updatePrice() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];

      let subtotalPrice = 0;
      let totalQuantity = 0;
      cart.forEach((product) => {
        subtotalPrice = subtotalPrice + parseFloat(product.price) * product.quantity;
        totalQuantity = totalQuantity + product.quantity;
      });
      store.subtotal = subtotalPrice.toFixed(2);
      store.cartCounter = totalQuantity;

      let totalPrice = parseFloat(store.subtotal) + parseFloat(store.shipping);
      store.total = totalPrice.toFixed(2);
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

    locationReload(){
      location.reload();
    },
  },
  

  created() {
    this.getClientToken();
  },

  mounted() {
    this.showCart();
    this.updatePrice();
  },
};
</script>

<template>
  <div class="my-body">
    <button class="cart position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
      aria-controls="offcanvasRight">
      <i class="fa-solid fa-cart-shopping"></i>
      <span v-if="store.cartCounter > 0" class="cart-badge">
        {{ store.cartCounter }}
      </span>
    </button>

    <div class="offcanvas w-100 offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title ps-3" id="offcanvasRightLabel">Carrello</h5>
        <button ref="CloseCart" type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <!-- carrello -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-xl-8">
              <div class="square container-fluid p-4 mb-3">
                <div v-if="store.cart.length === 0">
                  Non ci sono prodotti nel carrello
                </div>
                <div v-for="item in store.cart" :key="item.id"
                  class="row d-flex justify-content-center position-relative mb-2 bg-white rounded-2 p-2">
                  <div class="col-4 mb-4 mb-lg-0">
                    <!-- immagine -->
                    <div class="bg-image w-75 text-center item-image hover-overlay hover-zoom ripple rounded"
                      data-mdb-ripple-color="light">
                     <img
                        :src="item.image ? 'http://127.0.0.1:8000/storage/' + item.image : '/no-food.jpg'"
                        onerror="this.src = '/no-food.jpg'"
                        class="w-100 mx-auto"
                        :alt="item.name" />
                      <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
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
                      <strong>&euro; {{ item.price }}</strong>
                    </p>
                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                      class="btn btn-danger me-1 mt-1 mb-2 position-absolute top-0 end-0" data-mdb-tooltip-init
                      title="Remove item" @click="deleteItem(item.id)">
                      <i class="fas fa-trash"></i>
                    </button>

                    <div class="d-flex mb-4" style="max-width: 300px">
                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary px-3 me-2"
                        @click="decreaseQuantity(item.id)">
                        <i class="fas fa-minus"></i>
                      </button>

                      <span>{{ item.quantity }}</span>

                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary px-3 ms-2"
                        @click="increaseQuantity(item.id)">
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
              <!-- square -->
              <div class="square mb-3 p-4" :class="{'d-none' : store.cart.length === 0}">
                <div class="bg-white rounded-1 p-2">
                  <h5>Riepilogo ordine</h5>
                  <div v-if="store.subtotal != 0">
                    <h6>Prodotti: &euro; {{ store.subtotal }}</h6>
                    <h6>Consegna: &euro; {{ store.shipping }}</h6>
                    <h6>
                      Totale ordine: &euro;
                      {{ store.total }}
                    </h6>
                  </div>
                </div>
              </div>
              <!-- square -->
            </div>

            <!-- Dati di consegna -->
            <div class="col-12">
              <!-- square -->
              <div class="square mb-3 p-4" v-if="clientToken" :class="{'d-none' : store.cart.length === 0}">
                <form @submit.prevent="payWithCreditCard()">
                  <input type="hidden" name="amount" v-model="formData.amount">
                  <input type="hidden" name="products[]" v-model="formData.products">
                  <div class="row">
                    <h1>
                      <i class="fas fa-shipping-fast"></i> Dettagli Spedizione
                    </h1>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerName" class="form-label">Nome</label>
                      <input type="text" v-model="formData.name" class="form-control" id="customerName"
                        required="required" maxlength="20" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerSurname" class="form-label">Cognome</label>
                      <input type="text" v-model="formData.lastname" class="form-control" id="customerSurname"
                        required="required" maxlength="20" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerMail" class="form-label">Email</label>
                      <input type="email" v-model="formData.email" class="form-control" id="customerMail"
                        required="required" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerPhone" class="form-label">Telefono</label>
                      <input type="text" v-model="formData.phone" class="form-control" id="customerPhone" minlength="10"
                        maxlength="10" pattern="\d{10}" title="Inserire un numero di telefono di 10 cifre"
                        required="required" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerAddress" class="form-label">Indirizzo</label>
                      <input type="text" v-model="formData.address" class="form-control" id="customerAddress"
                        minlength="5" maxlength="255" required="required" name="address" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerCity" class="form-label">Città</label>
                      <input type="text" v-model="formData.city" name="city" class="form-control" id="customerCity"
                        required="required" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="inputState" class="form-label">Provincia</label>
                      <select required id="inputState" class="form-select" name="state" v-model="formData.state">
                        <option selected value="">Scegli...</option>
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
                        <option value="FC">ForlÃ¬-Cesena</option>
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
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerZipCode" class="form-label">CAP</label>
                      <input type="text" v-model="formData.postal_code" class="form-control" id="customerZipCode"
                        minlength="5" maxlength="5" pattern="\d{5}" title="Inserire un CAP valido (5 cifre)"
                        required="required" name="postal_code" />
                    </div>
                    <div class="mb-3">
                      <label for="note" class="form-label">Note sull'ordine</label>
                      <textarea rows="5" class="form-control" name="notes" v-model="formData.notes"></textarea>
                    </div>
                  </div>
                  <div class="form-group" v-if="store.subtotal != 0">
                    <h3>Totale: &euro; {{ store.total }}</h3>
                  </div>
                  <hr />
                  <div class="form-group">
                    <h1>
                      <i class="far fa-credit-card"></i> Informazioni di Pagamento
                    </h1>
                    <label for="creditCardNumber">Numero carta di credito</label>
                    <div id="creditCardNumber" name="creditCardNumber" class="form-control"></div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label>Data di scadenza</label>
                        <div id="expireDate" class="form-control"></div>
                      </div>
                      <div class="col-6">
                        <label>CVV</label>
                        <div id="cvv" class="form-control"></div>
                      </div>
                    </div>
                  </div>

                  <div class="cards mt-2">
                    <img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-08-41-2782.png"
                      alt="VISA" class="me-2" />
                    <img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-09-00-2179.png"
                      alt="American Express" class="me-2" />
                    <img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-11-52-9757.png"
                      alt="Mastercard" class="me-2" />
                  </div>

                  <div v-if="formData.transaction || error" class="advises mt-3">
                    <div class="alert alert-success m-0" v-if="formData.transaction != '' && success">
                      Il pagamento è andato a buon fine.
                    </div>
                    <div class="alert alert-danger m-0" v-if="formData.transaction != '' && error != ''">
                      Il pagamento è stato respinto. <span class="cp hov-underline" @click="locationReload()">Riprova.</span>
                    </div>
                  </div>
                  <button v-if="formData.transaction == ''" class="btn btn-warning mt-3" type="submit">
                    Acquista
                  </button>
                </form>
              </div>
              <!-- square -->
            </div>
            <!-- /dati consegna -->
          </div>
        </div>
        <!-- /carrello  -->
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../assets/scss/main.scss" as *;

.square {
  min-height: 300px;
  background-color: $color-7;
  border-radius: 10px;
}

.cart {
  background-color: transparent;
  border: none;
  color: $color-10;

  .cart-badge {
    width: 20px;
    height: 20px;
    position: absolute;
    top: -8px;
    right: -8px;
    text-align: center;
    line-height: 20px;
    border-radius: 50%;
    font-size: 12px;
    background-color: red;
    color: white;
  }
}

#creditCardNumber,
#expireDate,
#cvv {
  height: 38px;
  margin: 10px 0 20px;
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
