<template>
    <div class="product">
        <h3>{{ product.attributes.productName }}</h3>
        <p>{{ product.attributes.productDescription }}</p>
        <span class="product-price"> &#8364;{{ product.attributes.productPrice }}</span>
    </div>
</template>

  
  

<script>

export default {
    name: 'Product',
    props: {
        product: Object
    },
    created() {
        // console.log(this.product);
    },
}

</script>

<style scoped lang="scss">
.product{
    background-color: #f5f5f5;
    border-radius: 10px;
    width: 15rem;
    padding: 10px;
    margin: 10px;
    box-shadow: 0px 6px 10px rgba(0,0,0,0.05);
    transition: .2s ease-in-out;

    &:hover{
        box-shadow: 0px 6px 10px rgba(0,0,0,0.2);
        cursor: pointer;
    }


    // .product-price{
    //     // price tag
    //     color: 
    // }

}
</style>
