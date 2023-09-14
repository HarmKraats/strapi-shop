<script setup>
import ShoppingCart from "@/components/blocks/ShoppingCart.vue";
import strapiService from "./api/strapiService";
import Loader from "@/components/Loader.vue";
</script>

<template>
  <Loader />
  <nav :class="{ scrolled: showFullNav }">
    <div class="container">
      <div class="logo">
        <router-link to="/">
          <img src="@/assets/logo.svg" alt="logo" />
        </router-link>
      </div>
      <div class="links">
        <router-link
          v-for="menuItem in menuItems"
          :key="menuItem.id"
          :to="'/' + menuItem.attributes.Slug"
        >
          {{ menuItem.attributes.Title }}
        </router-link>

        <router-link to="/cart">
          <ShoppingCart />
        </router-link>
      </div>
    </div>
  </nav>

  <router-view />

  <footer class="footer">
    <ul class="container">
      <li>Copyright © 2023 CLAYCO</li>
      <li>Met liefde & zorg handgemaakt</li>
      <li>wenlivandieren@gmail.com</li>
    </ul>
  </footer>
</template>

<script>
export default {
  name: "App",

  data() {
    return {
      showFullNav: false,
      scrollPosition: 0,
      menuItems: [],
    };
  },

  components: {
    ShoppingCart,
    Loader,
  },

  mounted() {
    // Fetch API response using strapiService
    strapiService.getMenuItems().then((response) => {
      const menuItems = response.map((page) => ({
        id: page.id,
        attributes: {
          Title: page.MenuItemTitle,
          Slug: page.page.data.attributes.Slug,
        },
      }));
      this.menuItems = menuItems;
    });
  },

  created() {
    window.addEventListener("scroll", this.handleScroll);
  },

  methods: {
    handleScroll() {
      var currentScrollPosition = window.scrollY;

      if (currentScrollPosition < this.scrollPosition) {
        if (currentScrollPosition === 0) {
          this.showFullNav = false;
        }
      } else {
        this.showFullNav = true;
      }
      this.scrollPosition = currentScrollPosition;
    },
  },

  destroyed() {
    window.removeEventListener("scroll", this.handleScroll);
  },
};
</script>


<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap");

:root {
  --container-width: 70vw;
  --section-spacing: 5rem;

  --main-color: #a0b8a5;
  --color-white: #fff;
  --main-color-dark: #76897a;

  --color-black: #1e1e1e;
}

main {
  width: 100%;
}

*:not(p) {
  margin: 0;
  padding: 0;
}

body {
  line-height: 1.5;
  background-color: #f8f7f5;
  // font-family: 'Baskervville', serif;
  margin: 0;
  overflow-x: hidden;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: var(--color-black);
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  position: relative;
  overflow: hidden;
}

.container {
  width: var(--container-width);
  margin: 0 auto;
}

a {
  text-decoration: none;
  color: var(--main-color);
  transition: 0.2s;

  &:hover {
    color: var(--main-color-dark);
  }
}

button {
  width: 100%;
  height: 100%;
  border: none;
  border-radius: 5px;
  color: #fff;
  font-size: 1rem;
  font-weight: 500;
  padding: 0.7rem;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
  background-color: var(--main-color);

  &:hover {
    background-color: var(--main-color-dark);
  }
}

h2 {
  margin-bottom: 2rem;
}

nav {
  z-index: 10;
  width: 100%;
  transition: background-color 0.3s ease-in-out, padding 0.2s ease-in-out,
    font-weight 0s ease-in-out;
  padding: 2rem 0;

  &.scrolled {
    position: sticky;
    padding: 1.1rem 0;
    top: 0;
    background-color: var(--color-white);
  }

  .container {
    font-family: "IBM Plex Serif", serif;
    display: flex;
    justify-content: space-between;
  }

  .logo {
    img {
      width: 8rem;
    }
  }

  .links {
    display: flex;
    gap: 3rem;

    .router-link-active {
      font-weight: bold;
    }

    a {
      color: var(--color-black);
      display: flex;
      gap: 5px;
      align-items: center;
    }
  }
}

header {
  width: 100%;
  height: 30vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: var(--main-color);
  color: var(--color-white);
  font-family: "IBM Plex Serif", serif;
  font-size: 2rem;
  font-weight: 400;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 2px;
  text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);

  h1 {
    font-size: 4rem;
    font-weight: 700;
    text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  }

  p {
    font-size: 1.5rem;
    font-weight: 400;
    text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  }

  margin-bottom: 5rem;
}

footer {
  width: 100%;
  margin-top: 5rem;
  padding: 2rem 0;
  display: flex;
  align-items: center;
  background-color: var(--color-white);

  ul {
    display: flex;
    justify-content: space-between;

    li {
      list-style-type: none;
    }
  }
}
</style>