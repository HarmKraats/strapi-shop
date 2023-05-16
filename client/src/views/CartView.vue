<template>
  <div>
    <h2>Mandje</h2>
    <ul>
      <li v-for="item in cart" :key="item.id">
        {{ item.productName }} - {{ item.quantity }}
      </li>
    </ul>

    <button v-if="cartTotal > 0" @click="clearCart">
      Clear cart
    </button>

  </div>
</template>

<script>
import server from '@/api/server.js';

export default {
  name: 'CartView',
  data() {
    return {
      cart: [],
      cartTotal: 0,
    }
  },
  created() {
    this.fetchCartTotal();
    this.getCartItems();
  },
  methods: {
    async getCartItems() {
      await server.get('/cart/items')
        .then((response) => {
          this.cart = response.data.items;
          console.log(response);

        })
        .catch((error) => {
          console.log(error);
        })
    },
    clearCart() {
      server.post('/cart/clear')
        .then((response) => {
          console.log(response);
          this.cart = [];
          this.cartTotal = 0;
          document.dispatchEvent(new Event('cartUpdated'));

        })
        .catch((error) => {
          console.log(error);
        })
    },

    fetchCartTotal() {
      server.get('/cart/totalItems')
        .then((response) => {
          // console.log(response)
          this.cartTotal = response.data.totalItems          
        })
        .catch((error) => {
          console.log(error)
        })
    },


  },
}
</script>
