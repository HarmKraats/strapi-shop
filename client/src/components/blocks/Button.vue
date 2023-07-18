<template>
    <div class="button">
        <!-- <a :href="this.url" :target="this.target">
            <slot></slot>
        </a> -->

        <!-- insteat of an A tag use a router-link or link -->
        <router-link :to="this.url" :target="this.target">
            <slot></slot>
        </router-link>
    </div>
</template>

<script>
export default {
    name: 'Button',



    props: {
        url: String,
        target: String,
    },

}

</script>

<style lang="scss">
$color-primary: #B8AEA0;
$color-primary-dark: #968e83;
$svg-color: #fff;
$gap: 10px;


.button {
    width: fit-content;

    a {
        width: auto;
        border-radius: 5px;
        color: #fff;
        font-size: 1.1rem;
        padding: .7rem;
        cursor: pointer;
        // transition: all .2s ease-in-out;
        background-color: $color-primary;
        display: flex;
        align-items: center;
        gap: $gap;

        svg {
            path {
                fill: #ffffff;
            }
        }

        &:hover {
            background-color: $color-primary-dark;
        }

        .button__content {
            display: grid;
            grid-template-columns: 1fr;
            transition: all .2s ease-in-out;
        }
    }
}
</style>
