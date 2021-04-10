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

     // Checks if there is a valid token before the product is added to the cart
if($user->ValidationToken($token)) {
    if(isset($_GET['userId']) & isset($_GET['productId']) & isset($_GET['quantity'])){
    $productId = $_GET['productId'];
    $userId = $_GET['userId'];
    $quantity = $_GET['quantity'];
    print_r(json_encode($cart->addToCart($productId,$userId,$token,$quantity)));
    } else {
        $error = new stdClass();
        $error->message = "Product ID or User ID or Quantity not found";
        $error->code = "0011";
        echo json_encode($error);
        die();
    }

}