<template>
  <div>
    <h2>Cart</h2>
    <ul>
      <li v-for="item in cart" :key="item.id">
        {{ item.attributes.productName }} - {{ item.attributes.productPrice }}
      </li>
    </ul>
    <p>Total: {{ total }}</p>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters(['cartTotalPrice']),
    cart() {
      return this.$store.state.cart
    },
    total() {
      return this.cartTotalPrice
    }
  },
  created() {
    this.cart = this.$store.state.cart
  }
}
</script>
