<script>
import { store } from "../data/store";
import axios from "axios";
import braintree from "braintree-web";
import Loader from "./partials/Loader.vue";
export default {
  components:{
    Loader
  },
  data() {
    return {
      store,
      isLoading: false,

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
      this.isLoading = false;
      if (this.hostedFieldInstance) {
        this.hostedFieldInstance
        .tokenize()
        .then((payload) => {
            this.isLoading = true;
            this.formData.transaction = payload.nonce;
            this.formData.amount = store.total;
            this.formData.products = store.cart;
            this.sendOrder();
          })
          .catch((err) => {
            this.isLoading = false;
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
          this.isLoading = false;
          if (this.success) {
          store.cart = [];
          store.subtotal = 0;
          store.total = 0;
          store.cartCounter = 0;
          localStorage.setItem("cart", JSON.stringify(store.cart));
          localStorage.setItem('orderConfirmed', 'true');
          this.$refs.CloseCart.click();
          this.$router.push({ name: 'orderSuccess' });
          }
        })
        .catch(err => {
          this.isLoading = false;
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
        <Loader v-if="isLoading" />
        <!-- carrello -->
        <div v-else class="container-fluid">
          <div class="row">
            <div class="col-12 col-xl-8">
              <div class="square container-fluid p-4 mb-3">
                <div v-if="store.cart.length === 0">
                  Non ci sono prodotti nel carrello
                </div>
                <div v-for="item in store.cart" :key="item.id"
                  class="row position-relative p-2 mb-3 bg-white rounded-2">
                  <div class="col-4 mb-4 mb-lg-0 d-flex align-items-center">
                    <!-- immagine -->
                    <div class="bg-image text-center item-image hover-overlay hover-zoom ripple rounded"
                      data-mdb-ripple-color="light">
                     <img
                        :src="item.image ? 'http://127.0.0.1:8000/storage/' + item.image : '/no-food.jpg'"
                        onerror="this.src = '/no-food.jpg'"
                        class="product-image w-100 mx-auto"
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
                      <strong>&euro; {{ item.price.replace('.', ',') }}</strong>
                    </p>
                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                      class="btn btn-danger me-1 mt-1 mb-2 position-absolute top-0 end-0" data-mdb-tooltip-init
                      title="Remove item" @click="deleteItem(item.id)">
                      <i class="fas fa-trash"></i>
                    </button>

                    <div class="d-flex mb-4" style="max-width: 300px">
                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary px-3 me-2 edit-quantity"
                        @click="decreaseQuantity(item.id)">
                        <i class="fas fa-minus"></i>
                      </button>

                      <span>{{ item.quantity }}</span>

                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary px-3 ms-2 edit-quantity"
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
              <div class="square checkout mb-3 p-4" :class="{'d-none' : store.cart.length === 0}">
                <div class="bg-white rounded-1 p-2 h-100">
                  <h5 class="fs-3">Riepilogo ordine</h5>
                  <div v-if="store.subtotal != 0">
                    <h6 class="fs-5">Prodotti: &euro; {{ store.subtotal.replace('.', ',') }}</h6>
                    <h6 class="fs-5">Consegna: &euro; 4,99 </h6>
                    <h6 class="fs-5">
                      Totale ordine: &euro;
                      {{ store.total.replace('.', ',') }}
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
                      <label for="customerName" class="form-label">Nome *</label>
                      <input type="text" v-model="formData.name" class="form-control" id="customerName"
                        required="required" maxlength="20" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerSurname" class="form-label">Cognome *</label>
                      <input type="text" v-model="formData.lastname" class="form-control" id="customerSurname"
                        required="required" maxlength="20" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerMail" class="form-label">Email *</label>
                      <input type="email" v-model="formData.email" class="form-control" id="customerMail"
                        required="required" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerPhone" class="form-label">Telefono *</label>
                      <input type="text" v-model="formData.phone" class="form-control" id="customerPhone" minlength="10"
                        maxlength="10" pattern="\d{10}" title="Inserire un numero di telefono di 10 cifre"
                        required="required" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerAddress" class="form-label">Indirizzo *</label>
                      <input type="text" v-model="formData.address" class="form-control" id="customerAddress"
                        minlength="5" maxlength="255" required="required" name="address" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerCity" class="form-label">Città *</label>
                      <input type="text" v-model="formData.city" name="city" class="form-control" id="customerCity"
                        required="required" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="inputState" class="form-label">Provincia *</label>
                      <select required id="inputState" class="form-select" name="state" v-model="formData.state">
                        <option selected value="">Scegli...</option>
                        <option value="MI">Milano</option>
                        <option value="MB">Monza e Brianza</option>
                        <option value="PV">Pavia</option>
                      </select>
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                      <label for="customerZipCode" class="form-label">CAP *</label>
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
                    <h3>Totale: &euro; {{ store.total.replace('.', ',') }}</h3>
                  </div>
                  <hr />
                  <div class="form-group">
                    <h1>
                      <i class="far fa-credit-card"></i> Informazioni di Pagamento
                    </h1>
                    <label for="creditCardNumber" class="fs_08">Numero carta di credito *</label>
                    <div id="creditCardNumber" name="creditCardNumber" class="form-control"></div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="fs_08">Data di scadenza *</label>
                        <div id="expireDate" class="form-control"></div>
                      </div>
                      <div class="col-6">
                        <label class="fs_08">CVV *</label>
                        <div id="cvv" class="form-control"></div>
                      </div>
                    </div>
                  </div>

                  <div class="cards d-flex flex-wrap align-items-center">
                    <img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-08-41-2782.png"
                      alt="VISA" class="me-2 mt-2" />
                    <img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-09-00-2179.png"
                      alt="American Express" class="me-2 mt-2" />
                    <img src="https://reservq.minionionbd.com/uploads/custom-images/-2023-10-26-06-11-52-9757.png"
                      alt="Mastercard" class="me-2 mt-2" />
                    <span class="fs-6 mt-2">Campi obbligatori *</span>
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
                    Acquista ora
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
  &.checkout{
    height: 300px;
  }
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

.product-image{
  aspect-ratio: 1;
  object-fit: cover;
}

.edit-quantity{
  background-color: $color-1 !important;
  border: none;
  &:hover{
    background-color: rgba($color-1, .85) !important;
  }
}

.fs_08{
  font-size: .8rem;
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
  .fs_08{
    font-size: 1.5rem !important;
  }
}

@media screen and (min-width: 1200px) {
  .offcanvas {
    width: 1200px !important;
  }
}
</style>
