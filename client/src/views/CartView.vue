<script setup>
import server from "@/api/server.js";
</script>

<template>
  <div class="container space-top">
    <h2>Jouw winkelmandje</h2>
    <div v-if="cartTotal <= 0">
      <p>Je hebt nog geen producten in je mandje.</p>
      <p>
        Klik <router-link to="/shop">hier</router-link> om naar de shop te gaan.
      </p>
    </div>


    <div class="cart">
      <table class="cart-table" v-if="cartTotal > 0">
        <thead>
          <tr>
            <th>Product</th>
            <th>Aantal</th>
            <th>Prijs</th>
            <th>Totaal</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in cart" :key="item.id">
            <td>{{ item.productName }}</td>
            <td>{{ item.quantity }}</td>
            <td>&euro; {{ item.price }}</td>
            <td>&euro; {{ item.price * item.quantity }}</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="cart-total">
              <strong>Total: &euro; {{ cartTotal }}</strong>
            </td>
          </tr>
        </tfoot>
      </table>
      <router-link v-if="cartTotal > 0" class="main-button" to="/checkout">Naar checkout</router-link>
      <!-- checkout button -->
      <button v-if="cartTotal > 0" @click="clearCart" class="clear-button">Clear cart</button>
    </div>


  </div>
</template>
<script>
export default {
  name: "CartView",
  data() {
    return {
      cart: null,
      cartTotal: 0,
    };
  },

  async mounted() {
    try {
      const response = await server.get("/cart/items");
      this.cart = response.data.items;
    } catch (error) {
      console.log(error);
    }

    try {
      const response = await server.get("/cart/Total");
      this.cartTotal = response.data.total;
    } catch (error) {
      console.log(error);
    }
  },

  methods: {
    clearCart() {
      server
        .post("/cart/clear")
        .then((response) => {
          this.cart = [];
          this.cartTotal = 0;
          document.dispatchEvent(new Event("cartUpdated"));
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async handleSubmit() {
      try {
        const response = await server.post("/payment/makeData", {
          cart: this.cart,
          amount: this.cartTotal,
          currency: "eur", // Replace 'usd' with your preferred currency code
        });

        const { data } = response;
        console.log(data);

        // Redirect to the payment link received from the backend\
        window.location.href = data.paymentLink;
        // this.clearCart();
      } catch (error) {
        console.error(error);
        // Handle error if needed
      }
    },
  },
};
</script>
<style lang="scss">

.clear-button{
  background-color: transparent;
  color: var(--primary-color);
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
  text-align: left;

  &:hover{
    background-color: var(--primary-color);
    color: var(--primary-color);
  }
}

.cart{
  margin: 0 auto;
  width: 1000px;
  display: flex;
  flex-direction: column;
  gap: 2rem;

}
.cart-table {
  width: 100%;
  border-collapse: collapse;

  th,
  td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ccc;
  }

  th {
    background-color: #f2f2f2;
  }

  td {
    vertical-align: middle;
  }

  .cart-total {
    text-align: right;
    font-weight: bold;
  }
}

button {
  margin-top: 16px;
}
</style>
