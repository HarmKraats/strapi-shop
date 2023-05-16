
<template>
    <div class="container">
        <div class="button" @click="showCartTotal()">Cart total = {{ cartTotal }}
        </div>
        <div class="button" @click="addToCart()">add to cart</div>
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
        async addToCart() {
            const formData = new FormData();
            formData.append('id', 1);
            formData.append('quantity', 1);

            await server
                .post('/cart/add', formData)
                .then((response) => {
                    console.log(response);
                    this.getCartTotal();
                })
                .catch((err) => {
                    console.log(err);
                });
        }

    }
}


</script>
