<?php
require_once('models/stripe/init.php');

function paymentmakeDataAction()
{
    $requestData = json_decode(file_get_contents('php://input'), true);

    \Stripe\Stripe::setApiKey('sk_test_51NFx8UCZLeYHIRWQaApv1LZrjfFyoL5PNXUW6Nvsh8wod5BKUr2NeH34zGWVdzj0v4wgeBhhOuRvVMmsWEV3JMXD00G1skhsBB');
    \Stripe\Stripe::setVerifySslCerts(false);

    $line_items = [];
    $summary = [];

    foreach ($requestData['cart'] as $item) {
        $line_items[] = [
            'price_data' => [
                'currency' => $requestData['currency'],
                'product_data' => [
                    'name' => $item['productName'],
                ],
                'unit_amount' => round($item['price'] * 100, 0),
            ],
            'quantity' => $item['quantity'],
        ];

        $summary[] = $item['productName'] . ' x ' . $item['quantity'];
    }

    $summary = implode(', ', $summary);

    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['sepa_debit', 'card', 'ideal'],
            'line_items' => $line_items,
            'payment_intent_data' => [
                'description' => $summary,
            ],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8080/success', // Replace with your success URL
            'cancel_url' => 'http://localhost:8080/cancel', // Replace with your cancel URL
        ]);

        return [
            'paymentLink' => $session->url,
            'data' => $requestData,
        ];
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
