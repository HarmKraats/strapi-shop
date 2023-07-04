<script setup >
import ShoppingCart from '@/components/blocks/ShoppingCart.vue';

</script>

<template>
  <nav :class="{ 'scrolled': showFullNav }">
    <div class="container">
      <div class="logo">
        <router-link to="/">
          <img src="@/assets/logo.svg" alt="logo" />
        </router-link>

      </div>
      <div class="links">
        <router-link to="/shop">Shop</router-link>
        <router-link to="/over">Over</router-link>
        <router-link to="/blog">Blog</router-link>
        <router-link to="/cart">
          <ShoppingCart />
        </router-link>
        <!-- <router-link to="/">Mandje</router-link> -->
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
  name: 'App',

  data() {
    return {
      showFullNav: false
    }
  },

  components: {
    ShoppingCart,
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
        // Additional logic for scrolling up
      } else {
        this.showFullNav = true;
        // Additional logic for scrolling down
      }

      this.scrollPosition = currentScrollPosition;
    }
  },

  destroyed() {
    window.removeEventListener("scroll", this.handleScroll);
  },
}

</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');


:root {
  --container-width: 70vw;

  --main-color: #A0B8A5;
  --color-white: #fff;
  --main-color-dark: #76897a;

  --color-black: #1e1e1e;
}

main {
  width: 100%;
}

body {
  background-color: #F8F7F5;
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
}

.container {
  width: var(--container-width);
  margin: 0 auto;
}

a {
  text-decoration: none;
  color: var(--main-color);
  transition: .2s;

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
  padding: .7rem;
  cursor: pointer;
  transition: all .2s ease-in-out;
  background-color: var(--main-color);

  &:hover {
    background-color: var(--main-color-dark);
  }
}

nav {
  z-index: 10;
  width: 100%;
  transition: background-color .3s ease-in-out, padding .2s ease-in-out;
  padding: 2rem 0;

  &.scrolled {
    position: sticky;
    padding: 1.1rem 0;
    top: 0;
    background-color: var(--color-white);
  }

  .container {
    font-family: 'IBM Plex Serif', serif;
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
