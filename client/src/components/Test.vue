
<template>
    <div class="image-wrapper">
        <div class="big-img selected-image" v-auto-animate
            @touchstart="onTouchStart" @touchend="onTouchEnd">
            <span v-if="productImages[currentImageIndex]">
                {{ productImages[currentImageIndex].attributes.string }}
            </span>
            <div v-if="productImages.length > 1" class="next" @click="nextImage">
                &#8250;</div>
            <div v-if="productImages.length > 1" class="prev" @click="prevImage">
                &#8249;</div>
        </div>
        <div class="images-list" v-if="productImages.length > 1">
            <!-- loop trough productImages -->
            <div class="image" v-for="image, index in productImages" :key="image.id"
                @click="selectImage(index)"
                :class="{ 'selected-image': currentImageIndex == index }">
                <span>
                    {{ image.attributes.string }}
                </span>
            </div>
        </div>
    </div>
</template>



<script>
export default {

    name: 'test',

    data() {
        return {
            json: {
                "data": [
                    {
                        "id": 1,
                        "attributes": {
                            "string": "Hello 1"
                        }
                    },
                    {
                        "id": 2,
                        "attributes": {
                            "string": "Hello 2"
                        }
                    },
                    {
                        "id": 3,
                        "attributes": {
                            "string": "Hello 3"
                        }
                    }
                ],
                "lenght": 1
            },
            productImages: [],
            currentImageIndex: 0,
            touchStartX: 0,
            touchEndX: 0,
        }
    },
    created() {
        this.getProduct()

        console.log(this.productImages)
    },

    methods: {
        test() {
            console.log('test')
        },

        getProduct() {
            this.productImages = this.json.data
        },
        nextImage() {
            if (this.currentImageIndex < this.productImages.length - 1) {
                this.currentImageIndex++;
            } else {
                this.currentImageIndex = 0;
            }
        },
        prevImage() {
            if (this.currentImageIndex > 0) {
                this.currentImageIndex--;
            } else {
                this.currentImageIndex = this.productImages.length - 1;
            }
        },
        selectImage(index) {
            this.currentImageIndex = index;
        },
        onTouchStart(event) {
            this.touchStartX = event.touches[0].clientX;
        },
        onTouchEnd(event) {
            this.touchEndX = event.changedTouches[0].clientX;
            this.handleSwipe();
        },
        handleSwipe() {
            const SWIPE_THRESHOLD = 50; // Adjust this value to control swipe sensitivity
            const touchDiff = this.touchEndX - this.touchStartX;

            if (touchDiff > SWIPE_THRESHOLD) {
                this.prevImage();
            } else if (touchDiff < -SWIPE_THRESHOLD) {
                this.nextImage();
            }
        },
    }
}


</script>



<style scoped lang="scss">
.image-wrapper {
    width: 60%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    .big-img {

        height: 300px;
        background-color: rgba($color: #1e1e1e, $alpha: .5);
        position: relative;

        .prev,
        .next {
            opacity: 0;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all .2s ease-in-out;
            z-index: 1;
            // disable selection
            user-select: none;

            &:hover {
                background-color: #000;
                color: #fff;
            }
        }

        .next {
            right: 10px;
        }

        .prev {
            left: 10px;
        }

        &:hover {


            .prev,
            .next {
                opacity: 1;
            }
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
</style>
