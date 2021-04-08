<?php
include('../../config/database_handler.php');
include('../../objects/Carts.php');
include('../../objects/Users.php');

$cart = new Cart($pdo);

print_r(json_encode($cart->addToCart($productId, $userId, $token, $quantity)));