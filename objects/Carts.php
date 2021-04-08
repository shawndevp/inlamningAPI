<?php

class Cart {

    private $db_connection;

    function __construct($db) {
        $this->db_connection = $db;
    }



    function addToCart($productId_IN, $userId, $token_IN, $quantity_IN) {
        $sql = "SELECT * FROM cart WHERE productId = :productId_IN AND userId = :userId_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":userId_IN", $userId_IN);
        $statement->bindParam(":productId_IN", $productId_IN);
        $statement->execute();
        
        if($statement->rowCount() > 0) {
            $error = new stdClass();
            $error->message = "Product already exists in the cart!";
            $error->code = "0007";
            print_r(json_encode($error));
            die();
        }

        $sql = "SELECT * FROM users WHERE id = :userId_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":userId_IN", $userId_IN);
        $statement->execute();
        $countUser = $statement->rowCount();

        if($countUser < 1) {
            $error = new stdClass();
            $error->message = "User not found!";
            $error->code = "0005";
            print_r(json_encode($error));
            die();
        }



        $sql = "SELECT * FROM products WHERE id = :productId_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":productId_IN", $productId_IN);
        $statement->execute();
        $countProduct = $statement->rowCount();

        if($countProduct < 1) {
            $error = new stdClass();
            $error->message = "ID not found!";
            $error->code = "0004";
            print_r(json_encode($error));
            die();
        }



        $sql = "INSERT INTO cart (productId, userId, token, quantity, orderdate) VALUES(:productId_IN, :userId_IN, :token_IN, :quantity_IN, NOW())";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":productId_IN", $productId_IN);
        $statement->bindParam(":userId_IN", $userId_IN);
        $statement->bindParam(":token_IN", $token_IN);
        $statement->bindParam(":quantity_IN", $quantity_IN);

        if($statement->execute()) {
            $message = new stdClass();
            $message->text = "$quantity_IN, of the product with the following id $productId_IN was added in to the cart!";
            return $message;
        }

    }





}



?>