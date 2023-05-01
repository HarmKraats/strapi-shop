// store.js


import Vuex from 'vuex'


// Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    cart: []
  },
  mutations: {
    addToCart(state, product) {
      state.cart.push(product)
    },
    removeFromCart(state, productId) {
      state.cart = state.cart.filter(item => item.id !== productId)
    },
    clearCart(state) {
      state.cart = []
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
    }
  },
  getters: {
    cartItemCount(state) {
      return state.cart.length
    },
    cartTotalPrice(state) {
      return state.cart.reduce((total, item) => total + item.attributes.productPrice, 0)
    },
    cartTotalQuantity(state) {
      return state.cart.reduce((total, item) => total + item.attributes.productQuantity, 0)
    },
    cartItems(state) {
      return state.cart
    }
  }
})
