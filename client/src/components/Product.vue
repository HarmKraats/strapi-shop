<script setup >
import addToCartMixin from '@/mixins/addToCartMixin.js'
import ButtonAddToCart from './blocks/ButtonAddToCart.vue'
</script>

<template>
    <div class="product" @click="navigateToProductDetails"
        v-if="product.attributes.productQuantity > 0">
        <div class="image-wrapper">
            <img :src="'http://localhost:1337' + this.productImage"
                alt="product image">
        </div>

        <div class="product-inner">
            <h3>{{ product.attributes.productName }}</h3>
            <div class="product-inner-inner">
                <span class="product-price">
                    Prijs: <span class="price">&#8364;{{
                        product.attributes.productPrice }}</span>
                </span>
                <div class="buttons-wrapper">
                    <!-- <div class="button button__add">
                        <button @click="addToCard">In mandje</button>
                    </div> -->

                    <ButtonAddToCart :product_id="product_id"
                        :product_quantity="product.attributes.productQuantity" />


                    <div class="button button__love">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                height="23" viewBox="0 0 25 23">
                                <g id="heart-fill" transform="translate(-0.001 0)">
                                    <path id="Path_30" data-name="Path 30"
                                        d="M12.5,2.015c6.935-7,24.272,5.245,0,20.985C-11.772,7.262,5.566-4.98,12.5,2.015Z"
                                        transform="translate(0 0)" fill="#fff"
                                        fill-rule="evenodd" />
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
export default {
    mixins: [addToCartMixin],
    name: 'Product',
    props: {
        product: Object,
    },
    data() {
        return {
            slug: '',
            productQuantity: 1,
            product_id: this.product.id,
            productImages: this.product.attributes.productImage.data,
            productImage: ''
        }
    },
    created() {
        this.slug = this.product.attributes.Slug
        console.log(this.productImages);

    },
    methods: {
        navigateToProductDetails() {
            this.$router.push({ name: 'productDetails', params: { slug: this.slug } })
        },
        calculateImageWrapperHeight() {
            const imageHeights = this.productImages.map(image => image.attributes.formats.small.height)
            const smallestImageIndex = imageHeights.indexOf(Math.min(...imageHeights))
            this.productImage = this.productImages[smallestImageIndex].attributes.formats.small.url
        },
        
    },
    mounted() {
        this.calculateImageWrapperHeight()
    },
}

</script>

<style scoped lang="scss">
.product {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.08);
    transition: .2s ease-in-out;
    overflow: hidden;
    height: min-content;

    &:hover {
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;

        img {
            transform: scale(1.1);
        }
    }

    img {
        transition: .2s ease-in-out;
        border-radius: 10px 10px 0 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-inner {
        padding: 1rem;

        .product-inner-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;

            .buttons-wrapper {
                display: flex;
                flex-direction: row;
                justify-content: flex-start;
                align-items: center;
                gap: .7rem;

                // button__add and button__love
                .button {
                    width: 100%;
                    height: 100%;

                    button {
                        width: 100%;
                        height: 3rem;
                        border: none;
                        border-radius: 5px;
                        color: #fff;
                        font-size: 1rem;
                        font-weight: 500;
                        padding: .7rem;
                        cursor: pointer;
                        transition: all .2s ease-in-out;

                        &:hover {
                            background-color: #2E7A3F;
                        }
                    }

                    &.button__add {
                        width: max-content;

                        button {
                            background-color: #B8AEA0;

                            &:hover {
                                background-color: #968e83;
                            }
                        }
                    }

                    &.button__love {
                        width: min-content;

                        button {
                            background-color: #A0B8A5;

                            &:hover {
                                background-color: #839788;
                            }
                        }
                    }

                }
            }
        }
    }

    h3 {
        width: 100%;
        display: block;
        text-align: start;
        font-size: 1.5rem;
    }

    .product-price {
        display: block;
        text-align: start;

        .price {
            font-weight: bold;
            color: #A0B8A5;
        }
    }
}

// make container responsive
@media screen and (max-width: 1100px) {
    .product {
        width: 12rem;
    }
}
</style>
