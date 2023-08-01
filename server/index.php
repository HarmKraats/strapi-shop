<?php

header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');



// require_once 'models/database.php';
// Set the content type header to JSON
header('Content-Type: application/json');
session_start();


// Load the controller based on the request
$requestUri = $_SERVER['REQUEST_URI'];
$basePath = '/1-own-projects/strapi-shop/server/'; // Update this with your base path if applicable


// Remove the base path from the request URI
if ($basePath !== '/' && strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
    
}
// Split the request URI into segments
$segments = explode('/', trim($requestUri, '/'));


// Get the controller and action from the segments
$controller = isset($segments[0]) ? $segments[0] : '';
$action = isset($segments[1]) ? $segments[1] : '';

// Include the appropriate controller file
if (!empty($controller)) {
    $controllerFile = __DIR__ . '/controllers/' . $controller . '.php';
    
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
    } else {
        echo json_encode(['error' => "Controller - $controllerFile - not found"]);
        exit;
    }
    
    // Call the action method if it exists
    $actionMethod = $controller.$action . 'Action';
    // echo json_encode(['actionMethod' => $actionMethod]);

    if (function_exists($actionMethod)) {
        $result = call_user_func($actionMethod);
        echo json_encode($result);
        exit;
    } else {
        echo json_encode(['error' => "Action - $actionMethod - not found"]);
        exit;
    }
} else {
    echo json_encode(['error' => 'No controller specified']);
    exit;
}
