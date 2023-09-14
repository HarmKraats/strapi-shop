<script setup>

import Categories from '@/components/parts/Categories.vue';
import ImageSlider from '@/components/parts/ImageSlider.vue';
import LargeImage from '@/components/parts/LargeImage.vue';
import Products from '@/components/parts/Products.vue';
import Text from '@/components/parts/Text.vue';
import TextImage from '@/components/parts/TextImage.vue';

// Elements
import Dots_1 from '@/components/elements/Dots_1.vue';
import Blob_green from '@/components/elements/Blob_green.vue';
import Dots_2 from '@/components/elements/Dots_2.vue';
import Blob_red from '../elements/Blob_red.vue';
</script>


<template>
    <header>
        <h1>
            {{ page.Title }}
            <Dots_1 />
        </h1>
        <Blob_green :class="'green_blob'" />
        <Dots_2 :class="'dots_bottom'" />
    </header>
    <section>
        <section v-for="(component, index) in page.Pagebuilder" :key="index"
            :class="getComponentName(component.__component)"
            :style="{ '--section-spacing': isConsecutiveTextImage[index] ? '2rem' : '' }">
            <component :is="getComponentName(component.__component)"
                :data="component" />
        </section>
        <section class="contactForm">
            <div class="container">
                <Blob_red :class="'red_blob'" />
                <h2>Contact</h2>
                <form>
                    <div class="top">
                        <div class="formfields">
                            <input type="text" placeholder="Voor en achternaam" />
                            <input type="email" placeholder="Emailadres" />
                            <textarea placeholder="Bericht"></textarea>
                        </div>
                        <div class="image-wrapper">
                            <img src="../../assets/contact.png" alt="contact" />
                        </div>
                    </div>
                    <button type="submit">Verzend</button>
                </form>
            </div>
        </section>
    </section>
</template>


<script>

export default {

    name: 'Pagebuilder',

    props: {
        page: {
            type: Object,
            required: true
        }
    },
    components: {
        Categories,
        ImageSlider,
        LargeImage,
        Products,
        Text,
        TextImage,
    },
    methods: {
        getComponentName(component) {
            const componentMapping = {
                'parts.categories': 'Categories',
                'parts.image-slider': 'ImageSlider',
                'parts.large-image': 'LargeImage',
                'parts.products': 'Products',
                'parts.large-text': 'Text',
                'parts.text-image': 'TextImage',
            };

            return componentMapping[component] || 'div';
        },
    },
    computed: {
        isConsecutiveTextImage() {
            return this.page.Pagebuilder.map((component, index) => {
                if (
                    component.__component === 'parts.text-image' &&
                    index < this.page.Pagebuilder.length - 1 &&
                    this.page.Pagebuilder[index + 1].__component === 'parts.text-image'
                ) {
                    return true;
                } else {
                    return false;
                }
            });
        },
    },

}


</script>


<style scoped lang="scss">
.red_blob{
    position: absolute;
    bottom: -280px;
    left: -450px;
    z-index: -1;
}
.container{
    position: relative;
}
h2 {
    text-align: left;
    margin-bottom: 1rem;
}

form {
    margin-bottom: var(--section-spacing);

    .top {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .formfields {
        width: 65%;
        display: flex;
        flex-direction: column;
        gap: 1rem;

        input,
        textarea {
            padding: 1rem;
            font-size: 1rem;
            border: none;
            background-color: var(--color-white);
        }

        textarea {
            height: 100%;
            resize: vertical;
            font-family: inherit;
        }

    }

    button {
        width: fit-content;
        margin-top: 2rem;
        padding: 1rem 2rem;
    }

    .image-wrapper {
        width: 35%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;


        img {
            width: 100%;
            height: 100%;
            object-fit: cover;


        }
    }

}
</style>
