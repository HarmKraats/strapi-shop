<script setup>
import server from '@/api/server.js';
</script>

<template>
    <div>
        <h2>Mandje</h2>
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
            <div class="payment-info">
                <!-- form with adress fields ect NAW gegevens-->
                <form @submit.prevent="handleSubmit">
                    <div class="field-wrapper">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" placeholder="John Doe" required />
                    </div>

                    <div class="field-wrapper">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required />
                    </div>
                    
                    <div class="field-wrapper">
                        <label for="address">Adres</label>
                        <input type="text" id="address" name="address" required />
                    </div>

                    <div class="field-wrapper">
                        <label for="city">Stad</label>
                        <input type="text" id="city" name="city" required />
                    </div>

                    <div class="field-wrapper">
                        <label for="zip">Postcode</label>
                        <input type="text" id="zip" name="zip" required />
                    </div>

                    <div class="field-wrapper">
                        <label for="country">Land</label>
                        <input type="text" id="country" name="country" required />
                    </div>

                    <div class="field-wrapper">
                        <label for="phone">Telefoonnummer</label>
                        <input type="text" id="phone" name="phone" required />
                    </div>

                    <div class="field-wrapper">
                        <label for="card">Kaartnummer</label>
                        <input type="text" id="card" name="card" required />
                    </div>



                    <button type="submit">Betalen</button>
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
                const response = await server.post('/payment/makeData', {
                    cart: this.cart,
                    amount: this.cartTotal,
                    currency: 'eur', // Replace 'usd' with your preferred currency code
                });

                const { data } = response;
                console.log(data);

                // Redirect to the payment link received from the backend\
                window.location.href = data.paymentLink;
                this.clearCart();
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
</style>
