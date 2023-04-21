<template>
    <div class="product">
        <h1>{{ product.attributes.productName }}</h1>
        <p>{{ product.attributes.productDescription }}</p>
        <p>{{ product.attributes.productPrice }}</p>
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
