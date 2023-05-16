<?php


// Example controller file (controllers/cartController.php)
function cartTotalAction()
{
    // Logic for the cartTotal endpoint
    // Perform user authentication and shopping cart operations here

    // Example response
    return ['total' => 10];
}

// Controller file (e.g., cart.php)
function cartAddAction()
{
    require_once 'models/database.php';

    // Access the data sent with the POST request
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    $product = getFromDB('*', 'products', 'id = ' . $id)[0];

    // Process the data and add the product to the cart
    // Example:
    $cartItem = [
        'id' => $id,
        'quantity' => $quantity,
        'productName' => $product['product_name'],
    ];

    $productQuantity = $product['product_quantity'];

    $leftQuantity = $productQuantity - $quantity;

    // updateARowInDB
    updateARowInDB('product_quantity = ' . $leftQuantity, 'products', 'id = ' . $id, true);

    // Return the response
    return ['message' => 'Product added to cart', 'cartItem' => $cartItem];
}
