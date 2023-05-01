<template>
    <div class="product">
        <div class="img"></div>
        <div class="product-inner">
            <h3></h3>
            <div class="product-inner-inner">
                <span class="product-price">

                </span>
                <div class="buttons-wrapper">
                    <div class="button button__add">
                        <button></button>
                    </div>
                    <div class="button button__love">
                        <button>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<style scoped lang="scss">
.product {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.08);
    transition: .2s ease-in-out;
    overflow: hidden;
    min-height: 300px;
    ;
    max-height: 100%;

    .img {
        transition: .2s ease-in-out;
        border-radius: 10px 10px 0 0;
        background: #eee;
        width: 100%;
        height: 145px;
    }

    .product-inner {
        padding: 1rem;

        .product-inner-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;

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
                        height: 3rem;
                        border: none;
                        border-radius: 5px;
                        padding: .7rem;
                        background-color: #eee;
                        width: 70px;
                    }
                }
            }
        }
    }

    h3 {
        background: #eee;
        width: 130px;
        height: 29px;
    }

    .product-price {
        background: #eee;
    width: 40px;
    height: 18px;
    }


}

// make container responsive
@media screen and (max-width: 768px) {
    .product {
        width: 12rem;
    }
}
</style>
