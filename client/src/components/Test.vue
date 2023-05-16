
<template>
    <div class="container">
        <div class="button" @click="showCartTotal()">Click me</div>
    </div>
</template>



<script>
import server from '@/server.js'


export default {

    name: 'test',

    data() {
        return {
            cartTotal: 0,
        }
    },
    created() {
        this.getCartTotal()

        console.log(this.cartTotal)
    },

    methods: {
        async getCartTotal() {
            await server.get('/cart/total')
                .then((response) => {
                    this.cartTotal = response.data.total
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        showCartTotal() {
            console.log(this.cartTotal)
        }

    }
}


</script>
