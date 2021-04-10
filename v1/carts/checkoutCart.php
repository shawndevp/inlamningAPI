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

         // Checks if there is a valid token before the product is checked out!
if($user->ValidationToken($token)) {
    print_r(json_encode($cart->checkoutCart($token)));
}

        else {
        $error = new stdClass();
        $error->message = "Token expired! Please Login to create a new token!";
        $error->code = "00012";
        print_r(json_encode($error));
        die();
        }