'use strict';

// const myController = require('./my-controller');
// const stripeController = require('./stripe-controller');

// module.exports = {
//   myController,
//   stripeController
// };


// q: can i also execute a controller from here directly?
// a: yes, but it's not recommended.  you should use the service layer instead.
// q: How do i strart doing that
// a: see the example below

const myController = require('./my-controller');
const stripeController = require('./stripe-controller');

module.exports = {
  myController,
  stripeController,
  // example of executing a controller directly
  // this is not recommended, you should use the service layer instead
  test: async (ctx) => {
    let productExsits = false;
    try {
      const db = strapi.db.metadata;
      for (const [key] of db) {
        if (key === 'api::product.product') {
          productExsits = true;
        }
      }
    } catch (error) {
      console.log('error', error);
    }

    if (!productExsits) {
      console.log('Product collection does not exist');
      return;
    }

    if(productExsits){
      console.log('Product collection exists');

      // Do some logic here


    }
  }
};
