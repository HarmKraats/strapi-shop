<template>
    <div class="product">
        <img :src="'http://localhost:1337' + product.attributes.productImage.data[0].attributes.formats.small.url"
            alt="product image">
        <div class="product-inner">
            <h3>{{ product.attributes.productName }}</h3>
            <span class="product-price">
                Prijs: &#8364;{{ product.attributes.productPrice }}
            </span>
        </div>
    </div>

    
</template>

  
  

<script>

export default {
    name: 'Product',
    props: {
        product: Object
    },
    created() {
        // console.log(this.product.attributes.productImage.data);
    },
}

</script>

<style scoped lang="scss">
.product {
    background-color: #F8F7F5;
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
    }

    h3 {
        width: 100%;
        display: block;
        text-align: start;
        font-size: 1.5rem;
    }

    .product-price {
        font-weight: bold;
        width: 100%;
        display: block;
        text-align: start;
        color: #A0B8A5;
    }


}

// make container responsive
@media screen and (max-width: 768px) {
    .product {
        width: 12rem;
    }
}
</style>
