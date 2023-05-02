<template>
  <div class="home">
    De home pagina
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'
import api from '@/api'


/*
// TODO

- Create components for the componentes we setup in strapi
- Get all the data from Pagebuilder from the api
- Loop through the data and render the components in the right order
- Create a component for the header - also in strapi
- Create a component for the footer - also in strapi
- Create a component for the navigation - also in strapi



*/

export default {
  name: 'HomeView',
  components: {
    // HelloWorld
  },
  created() {
    this.getTest()
  },
  methods: {
    async getTest() {
      const response = await api.get('/api/home?populate[Pagebuilder][populate]=*')
      console.log(response)
    }
  },
}
</script>
