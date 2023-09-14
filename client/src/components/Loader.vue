<template>
  <div v-if="!pageFullLoaded" class="loader" v-bind:class="{ 'fade-out': isPageLoaded }">
    <h1 class="content">Clayco</h1>
  </div>
</template>

<script>
export default {
  name: "Loader",
  data() {
    return {
      isPageLoaded: false,
      pageFullLoaded: false,
    };
  },
  mounted() {
    this.$nextTick(function() {
      window.addEventListener('load', this.pageLoaded);
    });
  },
  methods: {
    pageLoaded() {
      setTimeout(() => {
        this.isPageLoaded = true;
        setTimeout(() => {
          this.pageFullLoaded = true;
        }, 300);
      }, 1000);

    },
  },
};
</script>

<style scoped lang="scss">
.loader {
  height: 100vh;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 9999;
  background-color: var(--color-white);
  opacity: 1;
  transition: opacity 0.3s ease-in-out;

  &.fade-out {
    opacity: 0;
  }

  .container {
    text-align: center;
    opacity: 1;
    transition: opacity 0.5s ease-in-out;

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
  }
}

</style>
