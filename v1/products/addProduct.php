<?php
include("../../config/database_handler.php");
include("../../objects/products.php");

if(isset($_GET['name']) && isset($_GET['description']) && isset($_GET['category']) && isset($_GET['price']) ){
    $name = $_GET['name'];
    $description = $_GET['description'];
    $price = $_GET['price'];
    $category = $_GET['category'];
    $product  = new Product($pdo);
    print_r(json_encode($product->addProduct($name,$description,$price,$category)));
} else  {
    $error = new stdClass();
            $error->message = "Fill in all values please!";
            $error->code = "0001";
            print_r(json_encode($error));
            die();
}



?>