<template>
    <div class="container">
        <h1>
            Alle oorbellen
        </h1>

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
import api from '@/api.js'

export default {
    name: 'ShopView',
    components: {
        Product,
        ProductSkeleton
    },
    data() {
        return {
            products: [],
            loading: true
        }
    },
    created() {
        this.getProducts()
    },
    methods: {
        async getProducts() {
            this.loading = true;
            await api.get('/api/products?populate=productImage')
                .then((response) => {
                    this.products = response.data.data
                    // console.log(response)
                })
                .catch((error) => {
                    console.log(error)
                })
                .finally(() => {
                    this.loading = false;
                });
        }
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
