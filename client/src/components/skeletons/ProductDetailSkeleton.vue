<template>
    <div class="container">
        <!-- back button -->
        <div class="goBack" @click="goBack">
            Terug
        </div>

        <div class="product-wrapper">
            <div class="image-wrapper">
                <div class="big-img selected-image" v-auto-animate>
                    <div class="img"></div>
                </div>
                <div class="images-list">
                    <!-- make 4 instances of a plain <div class="img"></div> -->
                    <div class="image" v-for="index in 4" :key="index">
                        <div class="img"></div>
                    </div>
                </div>
            </div>

            <div class="details-wrapper">
                <div class="title">
                    <h3></h3>
                </div>
                <span class="product-price">
                    <p class="price-old"></p>
                    <p class="price"></p>
                </span>
                <div class="description">
                    <p></p>
                    <p></p>
                </div>
                <div class="buttons-wrapper">
                    <div class="button button__add">
                        <button></button>
                    </div>
                    <div class="button button__love">
                        <button></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
export default {

    name: 'ProductDetailSkeleton',

}


</script>


<style scoped lang="scss">
.product-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
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

            .img {
                width: 100%;
                height: 25rem;
                background-color: #eee;
            }
        }

        .images-list {
            margin-top: 1rem;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            gap: 1rem;

            .image {
                width: 23%;
                height: 100%;

                .img {
                    width: 100%;
                    height: 6rem;
                    background-color: #eee;
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
                background-color: #eee;
                width: 50%;
                height: 2rem;
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
                background-color: #eee;
                height: 2rem;
                width: 5rem;
                margin-right: .5rem;
            }

            .price-old {
                background-color: #eee;
                height: 1.7rem;
                width: 4.5rem;
            }
        }

        .description {
            text-align: left;

            p {
                background-color: #eee;
                width: 100%;
                height: 2rem;
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
                    border: none;
                    border-radius: 5px;
                    padding: .7rem;

                    width: 100%;
                    height: 100%;
                    background-color: #eee;
                
                    // make normal cursor when hovering over button
                    cursor: default;

                }

            }
        }
    }


}

.goBack {
    text-align: left;
    cursor: pointer;
}
</style>
