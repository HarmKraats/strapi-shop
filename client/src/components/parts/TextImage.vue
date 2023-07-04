<script setup >
// import strapiService from '../api/strapiService';
import simpleButton from '@/components/blocks/Button.vue';

// Elements
import Blob_brown from '@/components/elements/Blob_brown.vue';
import Blob_blue from '@/components/elements/Blob_blue.vue';

</script>

<template>
    <div class="container" :class="{ 'swap': getImagePos() }">
        <div data-scroll data-scroll-speed="3" class="image">
            <img :src="'http://localhost:1337' + this.image" alt="plaatje">
            <Blob_brown :class="'brown_blob'" v-if="!getImagePos()" />
            <Blob_blue :class="'blue_blob'" v-if="getImagePos()" />

        </div>
        <div data-scroll data-scroll-speed="-3.75" data-scroll-offset="-100%"
            class="text">
            <span v-html="this.text">

            </span>

            <simpleButton :url="this.button.ButtonUrl"
                :target="this.button.ButtonTarget">
                {{ this.button.ButtonText }}
            </simpleButton>
        </div>
    </div>
</template>
  
<script>

export default {
    name: 'TextImage',
    props: {
        data: Object
    },
    data() {
        return {
            text: this.data.Text,
            image: this.data.Image.data.attributes.formats.medium.url,
            // buttons
            button: this.data.Button[0],
            imagePosition: this.data.View,
        };
    },
    mounted() {
        // console.log(this.data)
        console.log(this.imagePosition);
    },
    methods: {
        getImagePos() {
            console.log(this.imagePosition)
            if (this.imagePosition === 'Plaatje links') {
                return true;
            } else {
                return false;
            }
        }
    },

};
</script>

<style scoped lang="scss">
.container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;


    &.swap {
        flex-direction: row-reverse;
    }

    .text {
        width: calc(100% / 12 * 6);
        font-size: 20px;
        line-height: 1.5;
        text-align: left;
    }

    .image {
        width: calc(100% / 12 * 5);
        position: relative;

        img {
            width: 100%;
            height: 700px;
            object-fit: cover;
        }
    }
}


// Elements
.brown_blob {
    position: absolute;
    bottom: -300px;
    left: -250px;
    z-index: -1;
    width: 90%;
}

.blue_blob {
    position: absolute;
    bottom: -100px;
    right: -310px;
    z-index: -1;
    width: 90%;
}
</style>
  