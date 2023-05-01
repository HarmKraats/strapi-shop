<template>
    
        <ProductDetailSkeleton v-if="loading" />
        <ProductDetail v-else :product="product" />
 
</template>



<script>
import api from '@/api.js'
import ProductDetail from '@/components/ProductDetail.vue'
import ProductDetailSkeleton from '@/components/skeletons/ProductDetailSkeleton.vue'



export default {


    name: 'ProductDetailView',
    data() {
        return {
            product: [],
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
