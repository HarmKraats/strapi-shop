<?php
require_once 'models/database.php';

function cartTotalAction()
{
    // Logic for the cartTotal endpoint
    // Perform user authentication and shopping cart operations here

    // Get the current cart items from the session
    $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Calculate the total
    $total = 0;
    foreach ($cartItems as $item) {
        // Calculate the total based on the quantity and item price
        $total += $item['quantity'] * $item['price'];
    }

    // Return the response
    return ['total' => $total];
}

function cartTotalItemsAction()
{
    // get the total number of items in the cart
    $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $totalItems = 0;
    foreach ($cartItems as $item) {
        $totalItems += $item['quantity'];
    }

    return ['totalItems' => $totalItems];
}

function cartItemsAction()
{
    // Logic for the cartItems endpoint
    // Perform user authentication and shopping cart operations here

    // Get the current cart items from the session
    $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Return the response
    return ['items' => $cartItems];
}


// Controller file (e.g., cart.php)
function cartAddAction()
{
    global $strapi_database;
    // Access the data sent with the POST request
    $id = $_POST['id'] ?? 2;
    $quantity = $_POST['quantity'] ?? 6;

    $product = $strapi_database->getFromDB('*', 'products', 'id = ' . $id)[0];

    $cartItem = [
        'id' => $id,
        'quantity' => $quantity,
        'productName' => $product['product_name'],
        'price' => $product['product_price'],
        // 'image' => $product['product_image'],
    ];

    $productQuantity = $product['product_quantity'];

    if ($quantity > $productQuantity) {
        return ['message' => 'Not enough products in stock'];
    }

    // $leftQuantity = $productQuantity - $quantity;
    // updateARowInDB('product_quantity = ' . $leftQuantity, 'products', 'id = ' . $id);
    // Get the current cart items from the session
    $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Check if the item is already in the cart
    $existingItemKey = array_search($id, array_column($cartItems, 'id'));
    if ($existingItemKey !== false) {
        // Item already exists in the cart, update the quantity
        $cartItems[$existingItemKey]['quantity'] += $quantity;
    } else {
        // Item doesn't exist in the cart, add it as a new item
        $cartItems[] = $cartItem;
    }

    // Update the cart in the session
    $_SESSION['cart'] = $cartItems;

    // Return the response
    return ['message' => 'Product added to cart', 'cartItem' => $cartItem];


    //make a new cart session if one does not exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    //add the cart item to the cart session
    $_SESSION['cart'][] = $cartItem;

    return ['message' => 'Product added to cart', 'cartItem' => $_SESSION['test'] ?? 'no cart session'];
}


function cartClearAction()
{
    //clear the cart session
    $_SESSION['cart'] = [];

    return ['message' => 'Cart cleared'];
}


function cartSetItemsForStripeAction() {
    // Get the current cart items from the session
    $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // // Map the cart items to the Stripe format
    // $stripeItems = array_map(function ($item) {
    //     return [
    //         'price_data' => [
    //             'currency' => 'eur',
    //             'product_data' => [
    //                 'name' => $item['productName'],
    //             ],
    //             'unit_amount' => round($item['price'] * 100, 0),
    //         ],
    //         'quantity' => intval($item['quantity']),
    //     ];
    // }, $cartItems);


    $stripeItems = array_map(function ($item) {
    return [
        'price' => 'price_1NFzp5CZLeYHIRWQmcRfEyc0', // Use the price from the Strapi CMS
        'quantity' => intval($item['quantity']),
    ];

    
}, $cartItems);


    // Return the response
    return ['items' => $stripeItems];
}

function cartPayTestAction()
{
    require_once('models/stripe/init.php');

    \Stripe\Stripe::setApiKey('sk_test_51NFx8UCZLeYHIRWQaApv1LZrjfFyoL5PNXUW6Nvsh8wod5BKUr2NeH34zGWVdzj0v4wgeBhhOuRvVMmsWEV3JMXD00G1skhsBB');
    \Stripe\Stripe::setVerifySslCerts(false);

    $intent = \Stripe\PaymentIntent::create([
        'amount' => 1000, // Amount in cents
        'currency' => 'eur',
    ]);

    // Send a JSON response back to the frontend
    header('Content-Type: application/json');
    echo json_encode($intent);
}
