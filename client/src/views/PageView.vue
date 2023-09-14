<script setup>
import strapiService from "../api/strapiService";

// Page templates
import Home from "@/components/templates/Home.vue";
import Shop from "@/components/templates/Shop.vue";

import Pagebuilder from "@/components/templates/Pagebuilder.vue";
</script>

<template>
  <Pagebuilder
    v-if="template == 'Pagebuilder' && page.Pagebuilder"
    :page="page"
  />

  <Home v-else-if="template == 'Home page'" :page="page" />

  <Shop v-else-if="template == 'Shop page'" :page="page" />

  <h1 v-else >404</h1>
</template>

<script>
export default {
  name: "PageView",
  data() {
    return {
      page: null,
      pageId: 0,
      template: null,
      pageSlug: this.$route.params.slug,
    };
  },
  mounted() {
    this.fetchPage();
  },
  methods: {
    fetchPage() {
      this.pageSlug = this.$route.params.slug;
      strapiService
        .getPageBySlug(this.pageSlug)
        .then((page) => {
          this.page = page.attributes;
          this.pageId = page.id;
          this.template = this.page.Template;
        })
        .finally(() => {});
    },
  },
  watch: {
    "$route.params.slug": function (newSlug, oldSlug) {
      this.fetchPage();
    },
  },
};
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Suranna&display=swap");

header {
  height: 70vh;
  display: flex;
  align-items: center;
  position: relative;
  justify-content: center;
  width: 100%;

  h1 {
    font-size: 9rem;
    text-transform: lowercase;
    position: relative;
    font-family: "Suranna", serif;
    // space between letters
    letter-spacing: 0.1em;

    > svg {
      position: absolute;
      top: -20px;
      right: 10px;
      z-index: -1;
      width: 50px;
    }
  }

  // Elements
  .green_blob {
    bottom: -410px;
    position: absolute;
    right: -100px;
    width: 540px;
    z-index: -1;
  }

  .dots_bottom {
    position: absolute;
    left: 240px;
    bottom: 50px;
  }
}
</style>
