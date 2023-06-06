<template>
    <div class="container" v-auto-animate>
        <h1>
            Alle oorbellen
        </h1>
        <div class="error" v-if="error">
            <h2>Error bij het laden van de producten...</h2>
            <p>Neem contact op met de website beheerder om dit probleem op te lossen.</p>
        </div>

        <div class="products-list" v-auto-animate>
            <ProductSkeleton v-if="loading" v-for="index in 4" :key="index" />
            <Product v-else v-for="product in products" :key="product.id"
                :product="product" />
        </div>
    </div>
</template>
  
<script>
// @ is an alias to /src
import Product from '@/components/Product.vue'
import ProductSkeleton from '@/components/skeletons/ProductSkeleton.vue'
// get the api var from main,js
import api from '@/api/api.js'
import server from '@/api/server'

export default {
    name: 'ShopView',
    components: {
        Product,
        ProductSkeleton,
    },
    data() {
        return {
            products: [],
            loading: true,
            error: false,
        }
    },

    async mounted(){
        try {
            const response = await api.get('/api/products?populate=productImage')
            this.products = response.data.data
            this.loading = false;
        } catch (error) {
            console.log(error)
            this.loading = false;
            this.error = true;
        }
    },
    methods: {
    },
}
</script>


<style scoped lang="scss">
.products-list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-column-gap: 2rem;
    grid-row-gap: 2rem;
}


// make container responsive
@media screen and (max-width: 768px) {
    .container {
        max-width: 90vw;
    }

    .products-list {
        grid-template-columns: repeat(auto-fit, minmax(12rem, 1fr));
        width: 90vw;
    }
}
</style>  
