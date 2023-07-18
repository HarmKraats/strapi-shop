<script setup >
// import strapiService from '../api/strapiService';

</script>

<template>
    <div class="container">
        <div class="image">
            <img :src="'http://localhost:1337' + this.image" alt="plaatje">
        </div>
    </div>
</template>
  
<script>

export default {
    name: 'LargeImage',
    props: {
        data: Object
    },

    data() {
        return {
            image: this.data.Image.data.attributes.formats.large.url,
        };
    },
};
</script>


<style scoped lang="scss">
.container{
    margin-bottom: var(--section-spacing);
}
.image {
    width: 100%;
    max-height: 70vh;

    overflow: hidden;
}

.image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
  