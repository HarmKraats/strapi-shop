module.exports = {
    async create(ctx) {
        // Access the newly created restaurant data
        const { name, location } = ctx.request.body;

        // Execute your custom code using the restaurant data
        // For example, save additional data to the customField
        const additionalData = 'Some additional data';
        const customField = `Restaurant: ${name}, Location: ${location}, Additional Data: ${additionalData}`;

        console.log('customField: ', customField);

        // Update the restaurant entry with the custom field value
        const updatedRestaurant = await strapi.query('restaurant').update(
            { id: ctx.response.body.id },
            { customField }
        );

        // Return the updated restaurant entry
        return updatedRestaurant;
    }
};
