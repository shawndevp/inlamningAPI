<?php
include("../../config/database_handler.php");
include("../../objects/Products.php");

$product = new Product($pdo);

if(!empty($_GET['id'])) {
    print_r(json_encode($product->deleteProduct($_GET['id'])));
}

else {
        $error = new stdClass();
            $error->message = "ID not found!";
            $error->code = "0004";
            print_r(json_encode($error));
            die();
}