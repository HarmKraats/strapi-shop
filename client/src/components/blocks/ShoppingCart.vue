<template>
    <div class="shoppingCart">
        <ShoppingCartSvg class="test"> </ShoppingCartSvg>

        <span class="cart-total">{{ cartTotal }}</span>
    </div>
</template>

<script>
import server from '@/api/server.js';
import ShoppingCartSvg from './ShoppingCartSvg.vue';


export default {
    name: 'ShoppingCart',

    data() {
        return {
            cartTotal: 0,
        }
    },

    components: {
        ShoppingCartSvg,
    },

    created() {
        this.fetchCartTotal();
        this.setupCartUpdates();
    },

    methods: {
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
        setupCartUpdates() {
            // Add an event listener to listen for cart update events
            document.addEventListener('cartUpdated', this.handleCartUpdate);
        },
        removeCartUpdates() {
            // Remove the event listener when the component is about to be destroyed
            document.removeEventListener('cartUpdated', this.handleCartUpdate);
        },
        handleCartUpdate(event) {
            // Handle the cart update event
            this.fetchCartTotal();
        },
    }
}



</script>

<style lang="scss">
.shoppingCart {
    position: relative;
    display: flex;
    align-items: center;

    .cart-total {
        $cart-size: 20px;
        position: absolute;
        top: -15px;
        right: -20px;
        background-color: #A0B8A5;
        color: white;
        border-radius: 50%;
        padding: 5px;
        font-size: .8rem;

        width: $cart-size;
        height: $cart-size;
    }
}
</style>
