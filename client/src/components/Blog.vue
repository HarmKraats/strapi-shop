<!-- <template>
    <div class="product">
        <router-link :to="{ name: 'blog-post', params: { slugUrl: blog.attributes.urlSlug } }">
            <h3>{{ blog.attributes.Title }}</h3>
            {{ post.title }}
        </router-link>
    </div>
</template> -->

<template>
    <div class="product" :data-link="blog.attributes.urlSlug">

        <!-- route link with the urlSlug -->
        <router-link :to="{ name: 'blogDetails', params: { urlSlug: blog.attributes.urlSlug } }">
            {{ blog.attributes.Title }}
            
        </router-link>
    </div>
</template>
  

  
  

<script>
import store from '@/store'
import router from '@/router';

export default {
    name: 'Product',
    props: {
        blog: Object
    },
    created() {
        console.log(this.blog);
    },
    methods: {
        navigateToBlogPage() {
            this.$router.push({ name: 'blogDetails', params: { id: this.blog.id } })
        },
    }
}

</script>

<style scoped lang="scss">
.product {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.08);
    transition: .2s ease-in-out;
    overflow: hidden;
    height: min-content;

    &:hover {
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;

        img {
            transform: scale(1.1);
        }
    }

    img {
        transition: .2s ease-in-out;
        border-radius: 10px 10px 0 0;
        width: 100%;
    }

    .product-inner {
        padding: 1rem;

        .product-inner-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;

            .buttons-wrapper {
                display: flex;
                flex-direction: row;
                justify-content: flex-start;
                align-items: center;
                gap: .7rem;

                // button__add and button__love
                .button {
                    width: 100%;
                    height: 100%;

                    button {
                        width: 100%;
                        height: 3rem;
                        border: none;
                        border-radius: 5px;
                        color: #fff;
                        font-size: 1rem;
                        font-weight: 500;
                        padding: .7rem;
                        cursor: pointer;
                        transition: all .2s ease-in-out;

                        &:hover {
                            background-color: #2E7A3F;
                        }
                    }

                    &.button__add {
                        width: max-content;

                        button {
                            background-color: #B8AEA0;

                            &:hover {
                                background-color: #968e83;
                            }
                        }
                    }

                    &.button__love {
                        width: min-content;

                        button {
                            background-color: #A0B8A5;

                            &:hover {
                                background-color: #839788;
                            }
                        }
                    }

                }
            }
        }
    }

    h3 {
        width: 100%;
        display: block;
        text-align: start;
        font-size: 1.5rem;
    }

    .product-price {
        width: 100%;
        display: block;
        text-align: start;

        .price {
            font-weight: bold;
            color: #A0B8A5;
        }
    }


}

// make container responsive
@media screen and (max-width: 768px) {
    .product {
        width: 12rem;
    }
}
</style>
