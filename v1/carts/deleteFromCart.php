<?php
include('../../config/database_handler.php');
include('../../objects/Carts.php');
include('../../objects/Users.php');


$token = "";
if(isset($_GET['token'])){
    $token = $_GET['token'];
}
else {
    $error = new stdClass();
    $error->message = "No token found!";
    $error->code = "0010";
    print_r(json_encode($error));
    die();
}

$user = new User($pdo);
$cart = new Cart($pdo);

     // Checks if there is a valid token before the product is deleted from the cart
if($user->ValidationToken($token)) {
    if(isset($_GET['userId']) && isset($_GET['productId'])){
    $productId = $_GET['productId'];
    $userId = $_GET['userId'];
    print_r(json_encode($cart->deleteFromCart($productId,$userId)));
    } 
    
    else {
        $error = new stdClass();
        $error->message = "ID not found!";
        $error->code = "0004";
        print_r(json_encode($error));
        die();
    }
}

    else {
        $error = new stdClass();
        $error->message = "Token expired! Please Login to create a new token!";
        $error->code = "00012";
        print_r(json_encode($error));
        die();
    }