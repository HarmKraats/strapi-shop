<script setup>
import { onMounted } from 'vue';
import Glide from '@glidejs/glide';

onMounted(() => {
    var glide = new Glide('.slider', {
        type: 'carousel',
        autoplay: 3000,
        startAt: 0,
        perView: 5,

        breakpoints: {
            1024: {
                perView: 3
            },
            600: {
                perView: 2
            }
        }

    });
    glide.mount()
});
</script>


<template>
    <div class="slider">
        <div class="imageSlider sliderTrack" v-auto-animate data-glide-el="track">
            <div class="sliderItems">
                <img class="Slide" v-for="image in this.data.Images.data"
                    :key="image.id"
                    :src="'http://localhost:1337' + image.attributes.formats.small.url"
                    alt="plaatje">
            </div>
        </div>
    </div>
</template>
  
<script>


export default {
    name: 'ImageSlider',
    props: {
        data: Object
    },

    data() {
        return {
            images: [],
            test: this.data.Images.data,
            imageSize: 'attributes.formats.small.url',
        };
    },

};
</script>


<style scoped lang="scss">
@import "../../../node_modules/@glidejs/glide/src/assets/sass/glide.theme";

.imageSlider {
    margin-bottom: var(--section-spacing);
    width: 100vw;

    .sliderItems {
        display: flex;
        gap: 2rem;
        height: 35vh;

        img {
            overflow: hidden;
            height: 100%;
            object-fit: contain;
            user-select: none;
        }

        .Slide {
            width: fit-content !important;
        }
    }

}
</style>

  