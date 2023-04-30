<template>
  <nav>
    <div class="logo">
      <router-link to="/">LOGO</router-link>

    </div>
    <div class="links">
      <router-link to="/shop">Shop</router-link>
      <router-link to="/over">Over</router-link>
      <router-link to="/blog">Blog</router-link>
      <!-- <router-link to="/">Mandje</router-link> -->
    </div>
  </nav>
  <router-view />
</template>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');

body {
  background-color: #F8F7F5;
  // font-family: 'Baskervville', serif;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  display: flex;
  flex-direction: column;
  align-items: center;
}

// nav {
//   padding: 30px;

//   a {
//     font-weight: bold;
//     color: #2c3e50;

//     &.router-link-exact-active {
//       color: #42b983;
//     }
//   }
// }
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

nav {
  font-family: 'IBM Plex Serif', serif;
  display: flex;
  justify-content: space-between;
  width: 60vw;
  padding: 2rem 0;

  .logo {}

  .links {
    display: flex;
    gap: 3rem;

    .router-link-active {
      font-weight: bold;
    }

    a {
      text-decoration: none;
      color: #000;
    }

  }

}
</style>
