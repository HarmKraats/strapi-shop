<?php
require_once('models/stripe/init.php');

function paymentmakeDataAction()
{
    // Ensure the request contains the necessary data (cart and totalAmount)
    $requestData = json_decode(file_get_contents('php://input'), true);

    \Stripe\Stripe::setApiKey('sk_test_51NFx8UCZLeYHIRWQaApv1LZrjfFyoL5PNXUW6Nvsh8wod5BKUr2NeH34zGWVdzj0v4wgeBhhOuRvVMmsWEV3JMXD00G1skhsBB');


    $amount = round($requestData['amount'] * 100, 0);

    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $amount,
        'currency' => 'eur',
    ]);

    $paymentLink = 'https://checkout.stripe.com/pay/' . $paymentIntent->client_secret;

    // return the payment link
    return ['paymentLink' => $paymentLink];
}
