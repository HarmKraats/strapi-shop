<script setup >
import strapiService from '../api/strapiService';

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

</script>

<template>
    <header>
        <h1>
            {{ page.Title }}
            <Dots_1 />
        </h1>
        <Blob_green :class="'green_blob'"/>
        <Dots_2 :class="'dots_bottom'"/>
    </header>
    <section v-if="page.Pagebuilder">
        <section v-for="(component, index) in page.Pagebuilder" :key="index"
            :class="getComponentName(component.__component)">
            <component :is="getComponentName(component.__component)"
                :data="component" />
        </section>
    </section>
</template>
  
<script>


export default {
    components: {
        Categories,
        ImageSlider,
        LargeImage,
        Products,
        Text,
        TextImage

    },
    data() {
        return {
            page: 'null',
            pageId: 0
        };
    },
    mounted() {
        const slug = this.$route.params.slug;
        strapiService.getPageBySlug(slug).then(page => {
            this.page = page.attributes;
            this.pageId = page.id;
            console.log(this.page);
        });
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
        }
    }
};
</script>


<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Suranna&display=swap');

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
        font-family: 'Suranna', serif;
        // space between letters
        letter-spacing: 0.1em;

        >svg {
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

    .dots_bottom{
        position: absolute;
        left:   240px;
        bottom: 50px;
    }

}
</style>
  