<?php
require_once('models/stripe/init.php');
require_once('models/database.php');

function paymentsendOrderAction($requestData)
{

    global $orders_database;

    //  add a new order in the database
    $order = $orders_database->postToDB(
        [
            'order_amount' => $requestData['amount'],
            'order_currency' => $requestData['currency'],
            'order_status' => 'pending',
            'order_user_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        'orders'
    );

    // The $order variable now contains the ID of the newly inserted order.

    // add all the products to the order
    foreach ($requestData['cart'] as $item) {
        $orders_database->postToDB(
            [
                'order_id' => $order, // Use the order ID obtained from the previous insertion
                'product_id' => $item['id'],
                'product_quantity' => $item['quantity'],
                'product_price' => $item['price'],
            ],
            'order_products'
        );
    }


    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    return $order;
}

function paymentmakeDataAction($requestData)
{

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

        return $session->url;
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
}


function paymentmakeOrderAction()
{

    $requestData = json_decode(file_get_contents('php://input'), true);

    $order = paymentsendOrderAction($requestData);

    $paymentLink = paymentmakeDataAction($requestData);


    return [
        'order' => $order,
        'paymentLink' => $paymentLink,
    ];
}
