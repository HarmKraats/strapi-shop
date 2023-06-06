'use strict';

module.exports = ({ strapi }) => ({
    async index(ctx) {
        // Send 200 `ok`
        console.log('ctx', ctx);
        console.log('strapi', strapi);

        ctx.send({
            message: 'ok'
        });
    }
});
