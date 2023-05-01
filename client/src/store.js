// store.js

import Vuex from 'vuex'

// Vue.use(Vuex)

const CART_KEY = 'cart'

export default new Vuex.Store({
  state: {
    cart: []
  },
  mutations: {
    addToCart(state, product) {
      state.cart.push(product)
      localStorage.setItem(CART_KEY, JSON.stringify(state.cart))
    },
    removeFromCart(state, productId) {
      state.cart = state.cart.filter(item => item.id !== productId)
      localStorage.setItem(CART_KEY, JSON.stringify(state.cart))
    },
    clearCart(state) {
      state.cart = []
      localStorage.removeItem(CART_KEY)
    },
    initializeStore(state) {
      const cartData = localStorage.getItem(CART_KEY)
      if (cartData) {
        state.cart = JSON.parse(cartData)
      }
    }
  },
  actions: {
    addToCart(context, product) {
      context.commit('addToCart', product)
    },
    removeFromCart(context, productId) {
      context.commit('removeFromCart', productId)
    },
    clearCart(context) {
      context.commit('clearCart')
    },
    initializeStore(context) {
      context.commit('initializeStore')
    }
  },
  getters: {
    cartItemCount(state) {
      return state.cart.length
    },
    cartTotalPrice(state) {
      return state.cart.reduce((total, item) => total + item.attributes.productPrice, 0)
    }
  },
  created() {
    this.$store.dispatch('initializeStore')
  }
})
