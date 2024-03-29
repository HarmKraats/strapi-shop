<template>
    <div class="container">
        <!-- back button -->
        <div class="goBack" @click="goBack">
            Terug
        </div>

        <div class="product-wrapper">
            <div class="image-wrapper">
                <div class="big-img selected-image" @touchstart="onTouchStart"
                    ref="imageWrapper" @touchend="onTouchEnd">
                    <div class="image-wrapper">
                        <img v-if="productImages[currentImageIndex]"
                            :src="'http://localhost:1337' + productImages[currentImageIndex].attributes.formats.large.url"
                            alt="product image">
                    </div>
                    <div v-if="productImages.length > 1" class="next"
                        @click="nextImage">&#8250;</div>
                    <div v-if="productImages.length > 1" class="prev"
                        @click="prevImage">&#8249;</div>
                </div>


                <div class="slider" v-if="productImages.length > 1">
                    <div class="imageSlider sliderTrack" data-glide-el="track">
                        <div class="sliderItems">
                            <img class="Slide" v-for="image, index in productImages"
                                :key="image.id" @click="selectImage(index)"
                                :src="'http://localhost:1337' + image.attributes.formats.small.url"
                                alt="plaatje"
                                :class="{ 'selected-image': currentImageIndex == index }">
                        </div>
                    </div>
                </div>

            </div>

            <div class="details-wrapper" ref="detailsWrapper">
                <div class="title">
                    <span class="warning" v-if="product.productQuantity <= 0">Dit
                        product is uitverkocht!</span>
                    <h3>{{ product.productName }}</h3>
                </div>
                <span class="product-price">
                    <span class="price-old" v-if="product.productOldPrice">
                        &#8364;{{ product.productOldPrice }}
                    </span>
                    <span class="price">
                        &#8364;{{ product.productPrice }}
                    </span>
                </span>
                <div class="quantity" v-if="product.productQuantity > 0">
                    <!-- quantity is stored in product -->
                    <span class="quantity__title">Aantal</span>
                    <!-- Select the amount of the product you want to buy as dropdown-->
                    <select v-model="productQuantity">
                        <option v-for="n in product.productQuantity" :key="n"
                            :value="n">{{ n }}</option>
                    </select>





                </div>
                <div class="description">
                    <p>{{ product.productDescription }}</p>
                </div>
                <div class="buttons-wrapper">
                    <!-- <div class="button button__add">
                        <button @click="addToCard"
                            :disabled="product.productQuantity <= 0">Toevoegen aan
                            winkelmandje</button>
                    </div> -->

                    <ButtonAddToCart :product_id="this.product_id"
                        :product_max_quantity="product.productQuantity"
                        :text="'Toevoegen aan winkelmandje'"
                        :selected_quantity="productQuantity" />

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
import addToCartMixin from '@/mixins/addToCartMixin.js'
import ButtonAddToCart from './blocks/ButtonAddToCart.vue'



export default {
    mixins: [addToCartMixin],

    name: 'ProductDetail',

    data() {
        return {
            slug: this.$route.params.slug,
            id: this.$route.params.id,
            productImages: [],
            currentImageIndex: 0,
            touchStartX: 0,
            touchEndX: 0,
            productQuantity: 1
        }
    },
    components: {
        ButtonAddToCart
    },
    props: {
        product: {
            type: Object,
            required: true
        },
        product_id: {
            type: Number,
            required: true
        }
    },
    created() {
        this.productImages = this.product.productImage.data
    },
    computed: {
        currentImage() {
            return this.productImages[this.currentImageIndex]
        },

    },
    methods: {
        goBack() {
            // go to products view
            this.$router.push('/shop')
        },
        selectImage(index) {
            this.currentImageIndex = index
        },
        nextImage() {
            if (this.currentImageIndex < this.productImages.length - 1) {
                this.currentImageIndex++
            } else {
                this.currentImageIndex = 0
            }
        },
        prevImage() {
            if (this.currentImageIndex > 0) {
                this.currentImageIndex--
            } else {
                this.currentImageIndex = this.productImages.length - 1
            }
        },
        onTouchStart(event) {
            this.touchStartX = event.touches[0].clientX;
        },
        onTouchEnd(event) {
            this.touchEndX = event.changedTouches[0].clientX;
            this.handleSwipe();
        },
        handleSwipe() {
            const SWIPE_THRESHOLD = 50; // Adjust this value to control swipe sensitivity
            const touchDiff = this.touchEndX - this.touchStartX;

            if (touchDiff > SWIPE_THRESHOLD) {
                this.prevImage();
            } else if (touchDiff < -SWIPE_THRESHOLD) {
                this.nextImage();
            }
        },
        calculateImageWrapperHeight() {
            const imageHeights = this.productImages.map(
                image => image.attributes.formats.large.height
            )
            const smallestImageHeight = Math.min(...imageHeights)

            const imageWrapper = this.$refs.imageWrapper,
                  detailsWrapper = this.$refs.detailsWrapper

            if(!imageWrapper || !detailsWrapper) return
            
            detailsWrapper.style.height = `${smallestImageHeight}px`
            imageWrapper.style.height = `${smallestImageHeight}px`
        },
    },
    mounted() {
        this.calculateImageWrapperHeight()
    },
}


</script>


<style scoped lang="scss">
.imageSlider {

    .sliderItems {
        display: flex;
        gap: 1rem;
        justify-content: flex-start;
        margin-top: 1rem;
        overflow-x: auto;
        padding-bottom: 5px;
        scroll-snap-type: x mandatory;
        height: 20vh;

        img {
            scroll-snap-align: center;
            overflow: hidden;
            height: 100%;
            object-fit: contain;
            user-select: none;
            width: fit-content !important;
            cursor: pointer;
            flex: 0 0 auto;

            &:not(.selected-image) {
                opacity: .5;
            }
        }
    }

}


.product-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    box-sizing: border-box;
    margin-top: 20px;
    gap: 5rem;

    //flex-wrap: wrap;
    .image-wrapper {

        /* width */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: transparent;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: transparent;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: transparent;
        }


        width: 60%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        .selected-image {
            position: relative;

            .image-wrapper {
                display: flex;
                justify-content: flex-start;
                width: 100%;
                height: 100%;

                img {
                    object-fit: contain;
                    user-select: none;
                    width: min-content;
                    max-width: 100%;
                    height: 100%;

                }
            }

            .prev,
            .next {
                opacity: 0;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 50px;
                height: 50px;
                background-color: #fff;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                transition: all .2s ease-in-out;
                z-index: 1;
                user-select: none;

                &:hover {
                    background-color: #000;
                    color: #fff;
                }
            }

            .next {
                right: 10px;
            }

            .prev {
                left: 10px;
            }

            &:hover {

                .prev,
                .next {
                    opacity: 1;
                }
            }
        }


        &:hover {

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }
        }
    }

    .details-wrapper {
        width: 40%;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        justify-content: center;

        .title {
            text-align: left;

            h3 {
                font-size: 1.5rem;
                font-weight: 500;
                margin-bottom: .5rem;
            }

            .warning {
                color: #fff;
                padding: .3rem .5rem;
                border-radius: 5px;
                background-color: #e35a5a;
                font-size: 1rem;
                font-weight: 500;
                margin-bottom: .5rem;
            }
        }

        .product-price {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            gap: 1rem;

            .price {
                color: #44A859;
                font-size: 1.5rem;
                font-weight: 500;
                margin-right: .5rem;
            }

            .price-old {
                color: #C2C2C2;
                font-size: 1rem;
                font-weight: 400;
                text-decoration: line-through;
            }
        }

        .quantity {
            text-align: left;

            select {
                margin-left: 10px;
            }
        }

        .description {
            text-align: left;

            p {
                font-size: 1rem;
                font-weight: 400;
                margin-bottom: .5rem;
            }
        }

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
                    height: 100%;
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

                // &.button__add {
                //     width: max-content;

                //     button {
                //         background-color: #B8AEA0;

                //         &:hover {
                //             background-color: #968e83;
                //         }
                //     }
                // }

                &.button__love {
                    width: min-content;

                    button {
                        background-color: #A0B8A5;

                        &:hover {
                            background-color: #839788;
                        }
                    }
                }

                button {
                    &[disabled] {
                        background-color: #C2C2C2;
                        cursor: not-allowed;

                        &:hover {
                            background-color: #d6d4d4;
                        }
                    }
                }
            }
        }
    }
}

.goBack {
    text-align: left;
    cursor: pointer;
}
</style>
