<?php
include("../../config/database_handler.php");
include("../../objects/products.php");

$name = "";
$description = "";
$price = "";
$category = "";
$product = new Product($pdo);

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

else {
    $error = new stdClass();
            $error->message = "ID not found!";
            $error->code = "0004";
            print_r(json_encode($error));
            die();
}

if(isset($_GET['name'])) {
    $name = $_GET['name'];
}

if(isset($_GET['description'])) {
    $name = $_GET['description'];
}

if(isset($_GET['price'])) {
    $name = $_GET['price'];
}

if(isset($_GET['category'])) {
    $name = $_GET['category'];
}

print_r(json_encode($product->updateProducts($id, $name, $description, $price, $category)));