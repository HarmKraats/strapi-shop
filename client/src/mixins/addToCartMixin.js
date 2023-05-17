import server from '@/api/server.js';

export default {
    methods: {
        addToCard(event) {
            event.stopPropagation()
            if (this.product.productQuantity <= 0) {
                // mesage box
                alert('Product is niet meer op voorraad')
                return
            }

            const formData = new FormData();
            formData.append('id', this.product_id);
            formData.append('quantity', this.productQuantity);

            // add product to cart
            server.post('/cart/add', formData)
                .then((response) => {
                    this.product.productQuantity -= this.productQuantity
                    document.dispatchEvent(new Event('cartUpdated'));
                    alert('Product is toegevoegd aan de winkelwagen')

                }).catch((error) => {
                    console.log(error)
                })
                .finally(() => {
                    if (this.product.productQuantity <= 0) {
                        this.$router.push({ name: 'shop' })
                    }
                })
        },
    }
}
