module.exports = [
  {
    method: 'GET',
    path: '/',
    handler: 'myController.index',
    config: {
      policies: [],
    },
  },
  {
    method: 'POST',
    path: '/stripe',
    handler: 'stripeController.index',
    config: {
      policies: [],
    },
    
  },
];

