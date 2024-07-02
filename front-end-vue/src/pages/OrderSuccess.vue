<script>
export default {
  name: "orderSuccess",
  data() {
    return {
      reloadExecuted: localStorage.getItem("reloadExecuted"),
    };
  },
  mounted() {
    window.scrollTo(0, 0);
    if (!localStorage.getItem('orderConfirmed')) {
      this.$router.replace({ name: 'home' });
    } else {
      localStorage.setItem('orderConfirmed', 'true');
      if (!this.reloadExecuted) {
        localStorage.setItem("reloadExecuted", "true");
        location.reload();
      } else {
        localStorage.removeItem("reloadExecuted");
      }
    }
  },
  beforeUnmount() {
    localStorage.removeItem("reloadExecuted");
    localStorage.removeItem("orderConfirmed");
  },
};
</script>

<template>
  <div class="confirmation-container">
    <div class="success text-center p-5">
      <h1>L'ordine è stato inviato correttamente!</h1>
      <h2>A breve riceverai un'email di conferma.</h2>
      <router-link class="btn btn-primary" :to="{ name: 'home' }">
        Torna alla home
      </router-link>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.confirmation-container {
  display: flex;
  justify-content: center;
  align-items: center;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.success {
  background: white;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 40px;
  margin: 25px 0;
  max-width: 500px;
  width: 100%;
  height: calc(100vh - 100px - 50px);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

h1 {
  color: #2c3e50;
  font-size: 2rem;
  margin-bottom: 1rem;
}

h2 {
  color: #34495e;
  font-size: 1.25rem;
  margin-bottom: 2rem;
}

.btn-primary {
  background-color: #95ADCD;
  border-color: #95ADCD;
  padding: 0.75rem 1.25rem;
  font-size: 1rem;
  border-radius: 5px;
  color: #fff;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #7288A3;
  border-color: #7288A3;
}
</style>
