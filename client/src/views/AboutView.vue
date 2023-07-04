<template>
  

<kinesis-container>
  <KinesisDistance :strength="50" :distance="100" >
    <div class="main"> </div>
  </KinesisDistance>

  </kinesis-container>
</template>

<script>
import Test from '@/components/Test.vue'

export default {
  name: 'AboutView',
  components: {
    Test
  },
  data() {
    return {
    }
  },
  created() {
  },
  methods: {
  },
}
</script>

<style scoped>
.main {
  height: 50px;
  width: 50px;
  background-color: #fff;
  position: relative;
  overflow: hidden;
}
</style>
