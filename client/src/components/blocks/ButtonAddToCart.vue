<template>
    <div class="button button__add" :class="{ 'button__adding': adding }">
        <button @click="addToCard">
            <ShoppingCartSvg />
            <div class="button__content" v-if="text">
                <span v-if="this.text">{{ buttonText }}</span>
            </div>
        </button>
    </div>
    <!-- <div class="button button__add" :class="{ 'button__adding': adding }">
        <button @click="animate">
            <ShoppingCartSvg />
            <div class="button__content" v-if="text">
                <span>{{ buttonText }}</span>
            </div>
        </button>
    </div> -->


    <!-- <div class="button button_add" :class="{ 'button__adding': adding }">
        <button @click="animate">
            <svg></svg>
            <span>Add to cart</span>
        </button>
    </div> -->
</template>

<script>
import server from '@/api/server.js';
import ShoppingCartSvg from '@/components/blocks/ShoppingCartSvg.vue';

export default {
    name: 'ButtonAddToCart',

    data() {
        return {
            adding: false,
            buttonText: this.text,
        }
    },

    props: {
        product_id: Number,
        product_max_quantity: Number,
        text: String,
        selected_quantity: {
            type: Number,
            default: 1
        },
    },

    components: {
        ShoppingCartSvg,
    },

    created() {


    },

    methods: {
        // animate() {
        //     this.adding = true
        //     setTimeout(() => {
        //         this.adding = false
        //         // this.buttonText = 'Toegevoegd'
        //     }, 3000)
        //     setTimeout(() => {
        //         // this.adding = false
        //         this.buttonText = 'Koop er nog een!'
        //     }, 1500)


        // },
        addToCard(event) {
            event.stopPropagation()
            this.adding = true
            setTimeout(() => {
                this.adding = false
                // this.buttonText = 'Toegevoegd'
            }, 3000)
            setTimeout(() => {
                // this.adding = false
                this.buttonText = 'Koop er nog een!'
            }, 1500)
            if (this.product_max_quantity <= 0) {
                // mesage box
                alert('Product is niet meer op voorraad')
                return
            }

            const formData = new FormData();
            formData.append('id', this.product_id);
            formData.append('quantity', this.selected_quantity);
            // add product to cart
            server.post('/cart/add', formData)
                .then((response) => {
                    // this.product_quantity -= this.productQuantity
                    document.dispatchEvent(new Event('cartUpdated'));
                    // alert('Product is toegevoegd aan de winkelwagen')
                    console.log(response);

                }).catch((error) => {
                    console.log(error)
                })
                .finally(() => {
                    if (this.product_max_quantity <= 0) {
                        this.$router.push({ name: 'shop' })
                    }
                })
        },
    }

}

</script>

<style lang="scss">
$color-primary: #B8AEA0;
$color-primary-dark: #968e83;
$svg-color: #fff;
$gap: 10px;


.button {
    &__add {
        button {
            width: auto;
            height: 3rem;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            padding: .7rem;
            cursor: pointer;
            // transition: all .2s ease-in-out;
            background-color: $color-primary;
            display: flex;
            align-items: center;
            gap: $gap;




            svg {
                path {
                    fill: #ffffff;
                }
            }

            &:hover {
                background-color: $color-primary-dark;
            }

            .button__content {
                display: grid;
                grid-template-columns: 1fr;
                transition: all .2s ease-in-out;

            }


        }
    }

    &__adding {
        button {
            $time: 3s;
            animation: hideGap $time ease;

            .button__content {
                // grid-template-columns: 0fr;
                animation: hideGrid $time ease;

                span {
                    overflow: hidden;
                    animation: hideSpan $time ease;
                }
            }

            svg {
                animation: rotateSvg $time ease;
            }

            @keyframes hideSpan {
                0% {
                    opacity: 1;
                }

                25% {
                    opacity: 0;
                }

                50% {
                    opacity: 0;
                }

                75% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            @keyframes hideGrid {
                0% {
                    grid-template-columns: 1fr;
                }

                25% {
                    grid-template-columns: 1fr;
                }

                50% {
                    grid-template-columns: 0fr;
                }

                75% {
                    grid-template-columns: 1fr;
                }

                100% {
                    grid-template-columns: 1fr;
                }
            }

            @keyframes hideGap {
                0% {
                    gap: $gap;
                }

                25% {
                    gap: $gap;
                }

                50% {
                    gap: 0;
                }

                75% {
                    gap: $gap;
                }

                100% {
                    gap: $gap;
                }
            }

            @keyframes rotateSvg {
                0% {
                    transform: rotate(0deg);
                }

                25% {
                    transform: rotate(0deg);
                }

                50% {
                    transform: rotate(360deg);
                }

                75% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(0deg);
                }
            }
        }
    }
}
</style>
