<template>
    <div class="button button__add">
        <button @click="addToCard">
            <ShoppingCartSvg />
            <span v-if="this.text">{{ text }}</span>
        </button>
    </div>
</template>

<script>
import server from '@/api/server.js';
import ShoppingCartSvg from '@/components/blocks/ShoppingCartSvg.vue';

export default {
    name: 'ButtonAddToCart',

    data() {
        return {

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
        addToCard(event) {
            event.stopPropagation()
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
                    alert('Product is toegevoegd aan de winkelwagen')
                    // console.log(response);
                    
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

.button {
    &__add {
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
            background-color: $color-primary;
            display: flex;
            align-items: center;
            gap: 10px;

            svg {
                path {
                    fill: #ffffff;
                }
            }

            &:hover {
                background-color: $color-primary-dark;
            }
        }
    }
}
</style>
