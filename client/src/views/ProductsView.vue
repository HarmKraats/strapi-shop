<template>
    <div>
        Producten
    </div>

    <div class="products-list">
        <Product v-for="product in products" :key="product.id" :product="product" />
    </div>
</template>
  
<script>
// @ is an alias to /src
import Product from '@/components/Product.vue'
// get the api var from main,js
import api from '@/api.js'

export default {
    name: 'HomeView',
    components: {
        Product
    },
    data() {
        return {
            products: []
        }
    },
    created() {
        this.getProducts()
    },
    methods: {
        async getProducts() {

            await api.get('/api/products')
                .then((response) => {
                    this.products = response.data.data
                })
                .catch((error) => {
                    console.log(error)
                })
        }
    },
}
</script>
  