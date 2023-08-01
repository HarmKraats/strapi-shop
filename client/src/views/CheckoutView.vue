<script setup>
import server from '@/api/server.js';
</script>

<template>
    <div>

        <div v-if="cartTotal <= 0">
            <p>
                Er zit helemaal niks in je mandje.. Hoe ben je hier gekomen?
            </p>
            <p>
                Klik <router-link to="/cart">hier</router-link> om je mandje te
                bekijken.
            </p>
        </div>
        <div class="wrapper">
            <div class="table">
                <h2>Mandje</h2>
                <table class="cart-table" v-if="cartTotal > 0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Aantal</th>
                            <th>Prijs</th>
                            <th>Totaal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in cart" :key="item.id">
                            <td>{{ item.productName }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>&euro; {{ item.price }}</td>
                            <td>&euro; {{ item.price * item.quantity }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="cart-total">
                                <strong>Total: &euro; {{ cartTotal }}</strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="payment-info">
                <h2>Adresgegevens</h2>
                <form @submit.prevent="handleSubmit">
                    <div class="input-wrapper">
                        <label for="name">Naam</label>
                        <input placeholder="John Doe" type="text" id="name"
                            v-model="addressData.name" required />
                    </div>
                    <div class="input-wrapper">
                        <label for="address">Adres</label>
                        <input placeholder="Entrada" type="text" id="address"
                            v-model="addressData.address" required />

                    </div>
                    <div class="input-wrapper">
                        <label for="zipcode">Postcode</label>
                        <input placeholder="1114AA" type="text" id="zipcode"
                            v-model="addressData.zipcode" required />

                    </div>
                    <div class="input-wrapper">
                        <label for="city">Plaats</label>
                        <input placeholder="Amsterdam" type="text" id="city"
                            v-model="addressData.city" required />
                    </div>
                    <div class="input-wrapper">
                        <label for="country">Land</label>
                        <input placeholder="Nederland" type="text" id="country"
                            v-model="addressData.country" required />
                    </div>
                    <button type="submit">Naar betalen</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'CartView',
    data() {
        return {
            cart: null,
            cartTotal: 0,
            addressData: {
                name: '',
                address: '',
                zipcode: '',
                city: '',
                country: '',
            },
        }
    },

    async mounted() {
        try {
            const response = await server.get('/cart/items');
            this.cart = response.data.items;
        } catch (error) {
            console.log(error);
        }

        try {
            const response = await server.get('/cart/Total');
            this.cartTotal = response.data.total;
        } catch (error) {
            console.log(error);
        }
    },

    methods: {
        clearCart() {
            server
                .post('/cart/clear')
                .then((response) => {
                    this.cart = [];
                    this.cartTotal = 0;
                    document.dispatchEvent(new Event('cartUpdated'));
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async handleSubmit() {
            try {
                const response = await server.post('/payment/makeOrder', {
                    cart: this.cart,
                    amount: this.cartTotal,
                    currency: 'eur', // Replace 'usd' with your preferred currency code
                });

                const { data } = response;
                console.log(data);

                // Redirect to the payment link received from the backend\
                // window.location.href = data.paymentLink;
                // this.clearCart();
            } catch (error) {
                console.error(error);
                // Handle error if needed
            }
        },
    },
}
</script>
<style lang="scss">
.wrapper {
    display: flex;
    flex-direction: row-reverse;
    width: var(--container-width);
    gap: 10rem;

    .table,
    .payment-info {
        width: 50%;
    }
}





.cart-table {
    width: 100%;
    border-collapse: collapse;

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    th {
        background-color: #f2f2f2;
    }

    td {
        vertical-align: middle;
    }

    .cart-total {
        text-align: right;
        font-weight: bold;
    }
}

button {
    margin-top: 16px;
}

form {
    display: flex;
    flex-direction: column;
    text-align: left;

    .input-wrapper {
        display: flex;
        flex-direction: column;
        margin-bottom: 16px;

        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;

            &:focus {
                outline: none;
                border-color: var(--primary-color);
            }
        }
    }
}
</style>
