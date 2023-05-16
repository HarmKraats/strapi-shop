<template>
  <div>
    <h2>Cart</h2>
    <ul>
      <li v-for="item in cart" :key="item.id">
        {{ item.productName }} - {{ item.quantity }}
      </li>
    </ul>

  </div>
</template>

<script>
import server from '@/server.js';

export default {
  name: 'CartView',
  data() {
    return {
      cart: [],
    }
  },
  created() {
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
    }


  },
}
</script>
