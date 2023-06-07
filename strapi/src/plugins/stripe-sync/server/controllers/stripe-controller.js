'use strict';

module.exports = ({ strapi }) => ({
    // make index function
    index: async (ctx) => {
        console.log('ctx', ctx);
    },
    // make doATest function
    doATest: async (ctx) => {
        console.log('ctx', ctx);
    }



});
