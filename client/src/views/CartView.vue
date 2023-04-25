// Cart.vue

<template>
  <div class="cart">
    <div class="cart-item" v-for="item in cart" :key="item.id">
      <div class="cart-item-image">
        <img :src="item.image" :alt="item.name">
      </div>
      <div class="cart-item-details">
        <div class="cart-item-name">{{ item.name }}</div>
        <div class="cart-item-price">&#8364;{{ item.price }}</div>
      </div>
      <div class="cart-item-remove">
        <button @click="removeFromCart(item.id)">Remove</button>
      </div>
    </div>
    <div class="cart-total">
      Total price: &#8364;{{ total }}
    </div>
    </div>
</template>

<script>
export default {
  name: 'Cart',
  computed: {
    cart() {
      return this.$store.state.cart
    },
    total() {
      return this.$store.getters.total
    }
  },
  methods: {
    removeFromCart(id) {
      this.$store.dispatch('removeFromCart', id)
    }
  }
}
</script>
