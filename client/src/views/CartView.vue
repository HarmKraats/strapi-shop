<script setup>
// import { loadStripe } from '@stripe/stripe-js';
// // import { stripePromise } from 'path-to-your-stripe-setup';

// const stripePromise = loadStripe('pk_test_51NFx8UCZLeYHIRWQD5wraSZd0DOFvRPo5nbFlK8vo9W6SYAEVFuYCTOAJ13d6eYCm95VCPCrpYsrbZkkx9CqabDs00FGdg4K9x');

// const handleSubmit = async () => {
//   const stripe = await stripePromise;
//   const { error } = await stripe.redirectToCheckout({
//     lineItems: [{ price: 'price_1NFxHsCZLeYHIRWQDHahhDKF', quantity: 1 }],
//     mode: 'payment',
//     successUrl: 'https://your-domain.com/success',
//     cancelUrl: 'https://your-domain.com/cancel',
//   });

//   if (error) {
//     // Handle error
//     console.log(error);
//   }
// };

</script>

<template>
  <div>
    <h2>Mandje</h2>
    <div v-if="cartTotal <= 0">
      <p>
        Je hebt nog geen producten in je mandje.
      </p>
      <p>
        Klik <router-link to="/shop">hier</router-link> om naar de shop te gaan.
      </p>
      <!-- link to shop page -->

    </div>
    <table class="cart-table" v-if="cartTotal > 0">
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
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
    <button v-if="cartTotal > 0" @click="clearCart">
      Clear cart
    </button>
    <!-- checkout button -->
    <button @click="checkoutTest">
      Betalen
    </button>
  </div>
</template>
<script>
import server from '@/api/server.js';
import api from '@/api/api.js';
import { loadStripe } from '@stripe/stripe-js'

export default {
  name: 'CartView',
  data() {
    return {
      cart: null,
      cartTotal: 0,
    }
  },

  async mounted() {
    try {
      const response = await server.get('/cart/items');
      this.cart = response.data.items;
    } catch (error) {
      console.log(error);
    }

    try {
      const response = await server.get('/cart/Total');
      this.cartTotal = response.data.total;
    } catch (error) {
      console.log(error);
    }

    
  },

  methods: {
    clearCart() {
      server
        .post('/cart/clear')
        .then((response) => {
          this.cart = [];
          this.cartTotal = 0;
          document.dispatchEvent(new Event('cartUpdated'));
        })
        .catch((error) => {
          console.log(error);
        });
    },

    checkout() {
      server
        .post('/cart/PayTest')
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    testMeth() {
      const response = api.get( "/strapi-stripe/getProduct/1" )
      console.log(response);
    },

    async cartToStripe() {
      try {
        const response = await server.get('/cart/SetItemsForStripe');
        return response.data.items;
      } catch (error) {
        console.log(error);
      }
    },

    async checkoutTest() {
      const rawLineItems = await this.cartToStripe();
      console.log(rawLineItems);

      try {
        const stripe = await loadStripe('pk_test_51NFx8UCZLeYHIRWQD5wraSZd0DOFvRPo5nbFlK8vo9W6SYAEVFuYCTOAJ13d6eYCm95VCPCrpYsrbZkkx9CqabDs00FGdg4K9x');
        await stripe.redirectToCheckout({
          lineItems: rawLineItems,
          mode: 'payment',
          successUrl: 'http://localhost:8080/success',
          cancelUrl: 'http://localhost:8080/cancel',
        });
            
      } catch (error) {
        console.log(error);
      }
    }
  },
}
</script>
<style lang="scss">
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
