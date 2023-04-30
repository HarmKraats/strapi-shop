<template>
    <!-- back button -->
    <div @click="goBack">
        Alle blogs bekijken
    </div>

    <div class="product-wrapper">
        <div class="details-wrapper">
            <div class="title">
                <h3>{{ blog.Title }}</h3>
            </div>
            
            <div class="description">
                <p>{{ blog.Content }}</p>
            </div>
        </div>

    </div>
</template>



<script>
import api from '@/api.js'


export default {

    name: 'blogDetails',

    data() {
        return {
            id: this.$route.params.id,
            blog: [],
            slugUrl: this.$route.params.slug
        }
    },
    async created() {
        // fetch all the data from the url
        this.getBlog()
    },
    methods: {
        async getBlog() {

            await api.get(`/api/blog-posts?urlSlug=${this.urlSlug}`)
                .then((response) => {
                    this.blog = response.data.data[0].attributes
                    // console.log( response.data.data[0].attributes)
                })
                .catch((error) => {
                    console.log(error)
                })
        },

        goBack() {
            // go to products view
            this.$router.push({ name: 'blog' })
        }
    }
}


</script>


<style scoped lang="scss">
.product-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    margin: 0 auto;
    max-width: 2000px;
    padding: 0 20px;
    box-sizing: border-box;
    margin-top: 20px;
    gap: 5rem;

    //flex-wrap: wrap;
    .image-wrapper {
        width: 60%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        .selected-image {
            width: 100%;
            height: 100%;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }

        .images-list {
            margin-top: 1rem;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            gap: 1rem;

            .image {
                cursor: pointer;
                width: 23%;
                height: 100%;

                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                &:not(.selected-image) {
                    opacity: .5;
                }
            }
        }
    }

    .details-wrapper {
        width: 40%;
        display: flex;
        flex-direction: column;
        gap: 2rem;

        .title {
            text-align: left;

            h3 {
                font-size: 1.5rem;
                font-weight: 500;
                margin-bottom: .5rem;
            }
        }

        .product-price {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            gap: 1rem;

            .price {
                color: #44A859;
                font-size: 1.5rem;
                font-weight: 500;
                margin-right: .5rem;
            }

            .price-old {
                color: #C2C2C2;
                font-size: 1rem;
                font-weight: 400;
                text-decoration: line-through;
            }
        }

        .description {
            text-align: left;

            p {
                font-size: 1rem;
                font-weight: 400;
                margin-bottom: .5rem;
            }
        }

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
                    height: 100%;
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
</style>
