<script>
import { store } from "./data/store";
import axios from "axios";
import Header from "./components/Header.vue";
import Jumbotron from "./components/Jumbotron.vue";
import Footer from "./components/Footer.vue";
import BottomMenu from "./components/BottomMenu.vue";

export default {
  components: {
    Header,
    Jumbotron,
    Footer,
    BottomMenu,
  },
  data() {
    return {
      formData: {
        amount: "",
        shipment_address: "",
        phone: "",
        notes: "",
      },
      errors: {},
      sending: false,
      sent: false,
    };
  },
  methods: {
    submitForm() {
      this.sending = true;
      axios
        .post(store.apiUrl + "send-order", this.formData)
        .then((res) => {
          console.log(res.data);
          this.sending = false;
          this.sent = res.data.success;
          this.errors = res.data.errors;
        })
        .catch((err) => {
          console.log(err);
          this.sending = false;
        });
    },
  },
};
</script>

<template>
  <div>
    <Header />
    <Jumbotron/>
    <main>
      <router-view></router-view>
    </main>
    <Footer />
    <BottomMenu />
    <!-- <form @submit.prevent="submitForm()" class="text-center my-3">
      <input type="number" v-model="formData.amount" name="amount" id="amount" class="mx-3">
      <input type="text" v-model="formData.shipment_address" name="shipment_address" id="shipment_address" class="mx-3">
      <input type="number" v-model="formData.phone" name="phone" id="phone" class="mx-3">
      <textarea name="notes" id="notes" rows="4" class="mx-3" v-model="formData.notes"></textarea>
      <button type="submit" class="ms-3">Invia</button>
    </form> -->
  </div>
</template>

<style lang="scss" scoped>

  main{
    height: calc(100vh - 100px - 50px);
    overflow: auto;
  }

</style>
