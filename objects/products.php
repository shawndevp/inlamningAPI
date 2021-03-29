<?php 

class Product {

    private $db_connection;
    private $name;
    private $description;
    private $price;
    private $category; 


    function __construct($db) {
        $this->db_connection = $db; 
    }

    function addProduct($name_IN, $description_IN, $price_IN, $category_IN) {
        $sql = "INSERT INTO products (name, description, price, category) VALUES(:name_IN, :description_IN, :price_IN, :category_IN)";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":name_IN", $name_IN);
        $statement->bindParam(":description_IN", $description_IN);
        $statement->bindParam(":price_IN", $price_IN);
        $statement->bindParam(":category_IN", $category_IN);

        if(!$statement->execute()) {
            echo "Error creating post";
        }

        else {
            $this->name= $name_IN;
            $this->description = $description_IN;
            $this->price = $price_IN;
            $this->category = $category_IN;

            echo "Name: $this->name Description: $this->description Price: $this->price Category: $this->category";
            die();
        }
    }




    function deleteProduct($productID) {
        $sql = "DELETE FROM products WHERE id =:productID_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":productID_IN", $productID);
        $statement->execute();

        $message = new stdClass();
            if($statement->rowCount() > 0) {
                $message->text = "The product with id $productID was removed!";
                return $message;
            }

            else {
                $message->text = "Product with id = $productID was not found!";
                return $message;
            }
    }









}