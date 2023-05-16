<template>
    
        <ProductDetailSkeleton v-if="loading" />
        <ProductDetail v-else :product="product" :product_id="product_id" />
 
</template>



<script>
import api from '@/api/api.js'
import ProductDetail from '@/components/ProductDetail.vue'
import ProductDetailSkeleton from '@/components/skeletons/ProductDetailSkeleton.vue'



export default {


    name: 'ProductDetailView',
    data() {
        return {
            product: [],
            product_id: null,
            loading: true,
            slug: this.$route.params.slug,
        }
    },
    components: {
        ProductDetail,
        ProductDetailSkeleton
    },

    created() {
        this.getProduct()
    },

    methods: {
        async getProduct() {
            this.loading = true;
            await api.get(`/api/products`, {
                params: {
                    'filters[Slug]': this.slug,
                    'populate': 'productImage'
                }
            })
                .then((response) => {
                    this.product = response.data.data[0].attributes
                    this.product_id = response.data.data[0].id
                    this.productImages = this.product.productImage.data
                })
                .catch((error) => {
                    console.log(error)
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    }
}


</script>


<style scoped lang="scss">
</style>
