<script setup>
import server from "@/api/server.js";
</script>

<template>
  <div class="wrapper">
    <div class="data">
      <!-- Naam, E-mailadres, Telefoonnummer, Adres, (Plaats, Postcode (Naast elkaar)), Land, Knop naar afrekenen -->
      <h2>Gegevens</h2>

      <div class="data-wrapper">
        <form @submit.prevent="handleSubmit">
          <!-- input text fields here -->
          <div class="input-wrapper">
            <label for="name">Naam</label>
            <input
              type="text"
              id="name"
              v-model="addressData.name"
              placeholder="Harm van de Kraats"
              required
            />
          </div>
          <div class="input-wrapper">
            <label for="email">E-mailadres</label>
            <input
              type="email"
              id="email"
              v-model="addressData.email"
              placeholder="contact@harmvandekraats.nl"
              required
            />
          </div>
          <div class="input-wrapper">
            <label for="phone">Telefoonnummer</label>
            <input
              type="tel"
              id="phone"
              v-model="addressData.phone"
              placeholder="06 12345678"
              required
            />
          </div>
          <div class="input-wrapper">
            <label for="address">Adres</label>
            <input
              type="text"
              id="address"
              v-model="addressData.address"
              placeholder="Straatnaam 123"
              required
            />
          </div>
          <div class="inner-wrapper">
            <div class="input-wrapper">
              <label for="zipcode">Postcode</label>
              <input
                type="text"
                id="zipcode"
                v-model="addressData.zipcode"
                placeholder="1234 AB"
                required
              />
            </div>

            <div class="input-wrapper">
              <label for="city">Plaats</label>
              <input
                type="text"
                id="city"
                v-model="addressData.city"
                placeholder="Amsterdam"
                required
              />
            </div>
          </div>
          <div class="input-wrapper">
            <label for="country">Land</label>
            <input
              type="text"
              id="country"
              v-model="addressData.country"
              placeholder="Nederland"
              required
            />
          </div>

          <button class="main-button" type="submit">Afrekenen</button>
        </form>
      </div>
    </div>

    <div class="cart">
      <section>
        <h2>Jouw winkelmandje</h2>
        <div v-if="cartTotalItems <= 0">
          <p>Je hebt nog geen producten in je mandje.</p>
          <p>
            Klik <router-link to="/shop">hier</router-link> om naar de shop te
            gaan.
          </p>
        </div>

        <!-- cart table -->
        <div class="cart-table" v-if="cartTotalItems > 0">
          <div class="table-head">
            <ul>
              <li class="col">Product</li>
              <li class="col">Aantal</li>
              <li class="col">Prijs</li>
              <li class="col">Totaal</li>
            </ul>
          </div>
          <div class="table-body">
            <ul class="items" v-for="item in cart" :key="item.id">
              <li>{{ item.productName }}</li>
              <li>{{ item.quantity }}</li>
              <li>{{ item.price }}</li>
              <li>{{ item.price * item.quantity }}</li>
            </ul>
            <ul>
              <li>Verzendkosten</li>
              <li></li>
              <li></li>
              <li>{{ 4.15 }}</li>
            </ul>
            <ul class="total">
              <li>TotaalBedrag</li>
              <li></li>
              <li></li>
              <li>{{ this.cartTotal }}</li>
            </ul>
          </div>
        </div>
      </section>

      <section class="extra">
        <h2>Extra</h2>
        <!-- large opmerkingen text veld -->
        
        <div class="input-wrapper">
          <label for="commentary">Opmerkingen</label>
          <textarea name="commentary" id="opmerkingen" ></textarea>

          </div>
      </section>
    </div>
  </div>
</template>

<script>
export default {
  name: "CartView",
  data() {
    return {
      cart: null,
      cartTotal: 0,
      cartTotalItems: 0,
      addressData: {
        name: "",
        email: "",
        phone: "",
        address: "",
        zipcode: "",
        city: "",
        country: "Nederland",
      },
    };
  },

  async mounted() {
    try {
      const response = await server.get("/cart/items");
      this.cart = response.data.items;
      console.log(this.cart);
    } catch (error) {
      console.log(error);
    }

    try {
      const response = await server.get("/cart/Total");
      this.cartTotal = response.data.total;
    } catch (error) {
      console.log(error);
    }

    try {
      const response = await server.get("/cart/TotalItems");
      this.cartTotalItems = response.data.totalItems;
    } catch (error) {
      console.log(error);
    }
  },

  methods: {
    clearCart() {
      server
        .post("/cart/clear")
        .then((response) => {
          this.cart = [];
          this.cartTotal = 0;
          document.dispatchEvent(new Event("cartUpdated"));
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async handleSubmit() {
      try {
        const response = await server.post("/payment/makeOrder", {
          cart: this.cart,
          amount: this.cartTotal,
          currency: "eur", // Replace 'usd' with your preferred currency code
        });

        const { data } = response;
        console.log(data);

        window.location.href = data.paymentLink;
        // this.clearCart(); // Enable this on production
      } catch (error) {
        console.error(error);
        // Handle error if needed
      }
    },
  },
};
</script>

<style lang="scss">
.wrapper {
  font-size: 16px;
  text-align: left;
  display: flex;
  flex-direction: row;
  width: var(--container-width);
  gap: 10em;

  > div {
    flex-grow: 1;
    min-width: 40%;
  }

  h2 {
    font-size: 2em;
    margin-bottom: 2em;
  }

  .input-wrapper {
    display: flex;
    flex-direction: column;
  }

  .inner-wrapper {
    display: flex;
    gap: 1em;

    > div {
      flex-grow: 1;
    }
  }

  input {
    margin-bottom: 1em;
    padding: 0.5em;
    border: none;
    color: var(--color-black);
    border-radius: 5px;
    font-size: 1rem;
  }

  label {
    margin-bottom: 0.5em;
    font-weight: bold;
  }

  .cart-table {
    margin-bottom: 2em;
    display: flex;
    flex-direction: column;
    row-gap: 0.5em;

    li {
      width: 20%;
      display: flex;
      align-items: center;
      list-style-type: none;
    }

    .table-head ul {
      display: flex;
      padding: 0 1em;
      justify-content: space-between;
      font-weight: bold;
    }

    .table-body ul {
      display: flex;
      border-radius: 5px;
      justify-content: space-between;
      margin-bottom: 0.5em;
      padding: 0 1em;

      &.items {
        padding: 0.5rem 1em;
        margin-bottom: 1em;
        background-color: var(--color-white);
      }

      &.total {
        font-weight: bold;
      }
    }
  }

  .extra {
    display: flex;
    flex-direction: column;
    h2 {
      margin-bottom: 1em;

    }
    textarea {
      font-family: var(--font-family);
      margin-bottom: 1em;
      padding: 0.5em;
      border: none;
      color: var(--color-black);
      border-radius: 5px;
      font-size: 1rem;
      resize: vertical;
      max-height: 300px;
      min-height: 100px;

    }
  }
}
</style>
