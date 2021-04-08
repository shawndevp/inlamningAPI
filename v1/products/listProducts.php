<?php
include("../../config/database_handler.php");
include("../../objects/Products.php");

    $product = new Product($pdo);
    $products = $product->listProducts();
    
    echo "<pre>";
    print_r(($products));
    echo "</pre>";
?>