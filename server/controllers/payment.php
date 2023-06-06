<?php




require_once('models/stripe/init.php');

\Stripe\Stripe::setApiKey('sk_test_51NFx8UCZLeYHIRWQaApv1LZrjfFyoL5PNXUW6Nvsh8wod5BKUr2NeH34zGWVdzj0v4wgeBhhOuRvVMmsWEV3JMXD00G1skhsBB');
\Stripe\Stripe::setVerifySslCerts(false);

$stripe = new \Stripe\StripeClient('sk_test_51NFx8UCZLeYHIRWQaApv1LZrjfFyoL5PNXUW6Nvsh8wod5BKUr2NeH34zGWVdzj0v4wgeBhhOuRvVMmsWEV3JMXD00G1skhsBB');



$stripe->products->create([
    'name' => 'Gold Special',
]);
