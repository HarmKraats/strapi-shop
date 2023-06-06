'use strict';

module.exports = ({ strapi }) => ({
  index(ctx) {
    ctx.body = strapi
      .plugin('stripe-sync')
      .service('myService')
      .getWelcomeMessage();
  },
});
