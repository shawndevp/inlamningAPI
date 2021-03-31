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
        if(!empty($name_IN)&& !empty($description_IN)&& !empty($price_IN)&& !empty($category_IN)){

            $sql = "SELECT name, description, price, category FROM products WHERE name = :name_IN AND description = :description_IN AND price = :price_IN AND category = :category_IN";
            $statement = $this->db_connection->prepare($sql);
            $statement->bindParam(":name_IN", $name_IN);
            $statement->bindParam(":description_IN", $description_IN);
            $statement->bindParam(":price_IN", $price_IN);
            $statement->bindParam(":category_IN", $category_IN);
            $statement->execute();
            $message = new stdClass();
            if($statement->rowCount() > 0) {
                $message->text = "Product already exists!";
                return $message;
            }

        
        $sql = "INSERT INTO products (name, description, price, category) VALUES(:name_IN, :description_IN, :price_IN, :category_IN)";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":name_IN", $name_IN);
        $statement->bindParam(":description_IN", $description_IN);
        $statement->bindParam(":price_IN", $price_IN);
        $statement->bindParam(":category_IN", $category_IN);

        if($statement->execute()) {
            $message->text = "Product inserted!";
            return $message;
        }

        else {
            $error = new stdClass();
            $error->message = "Fill in all values please!";
            $error->code = "0001";
            print_r(json_encode($error));
            die();
        }

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


    
    function updateProducts($id, $name ="", $description = "", $price = "", $category = "") {

        $sql = "SELECT name, description, price, category FROM products WHERE name = :name_IN OR description = :description_IN OR price = :price_IN OR category = :category_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":name_IN", $name);
        $statement->bindParam(":description_IN", $description);
        $statement->bindParam(":price_IN", $price);
        $statement->bindParam(":category_IN", $category);
        $statement->execute();
        
        
        
        
    }








}