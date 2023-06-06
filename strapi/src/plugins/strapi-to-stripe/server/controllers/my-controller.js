'use strict';

module.exports = ({ strapi }) => ({
  index(ctx) {
    ctx.body = strapi
      .plugin('strapi-to-stripe')
      .service('myService')
      .getWelcomeMessage();
  },
});
