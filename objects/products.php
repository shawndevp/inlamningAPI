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

    function addProducts($name_IN, $description_IN, $price_IN, $category_IN) {
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




    function deleteProducts($productID) {
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
        
        if($statement->rowCount() > 0 ) {
            $error = new stdClass();
            $error->message = "Please update atleast one new 'data' to continue";
            $error->code = "0006";
            print_r(json_encode($error));
            die();
        }

        $error = new stdClass();
        if(!empty($name)) {
            $error->message = $this->updateName($id, $name);
        }

        if(!empty($description)) {
            $error->message = $this->updateDescription($id, $description);
        }

        if(!empty($price)) {
            $error->message = $this->updatePrice($id, $price);
        }

        if(!empty($category)) {
            $error->message = $this->updateCategory($id, $category);
        }

        return $error;
        
        
        
    }


    function updateName($id, $name) {
        $sql = "UPDATE products SET name = :name_IN WHERE id = :id_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":id_IN", $id);
        $statement->bindParam(":name_IN", $name);
        $statement->execute();

        if($statement->rowCount() < 1) {
            return "The product with id =$id was not found!";
        }

        else {
            return "Succesful updated!";
        }
    }

    function updateDescription($id, $description) {
        $sql = "UPDATE products SET description = :description_IN WHERE id = :id_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":id_IN", $id);
        $statement->bindParam(":description_IN", $description);
        $statement->execute();

        if($statement->rowCount() < 1) {
            return "The product with id =$id was not found!";
        }

        else {
            return "Succesful updated!";
        }
    }

    function updatePrice($id, $price) {
        $sql = "UPDATE products SET price = :price_IN WHERE id = :id_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":id_IN", $id);
        $statement->bindParam(":price_IN", $price);
        $statement->execute();

        if($statement->rowCount() < 1) {
            return "The product with id =$id was not found!";
        }

        else {
            return "Succesful updated!";
        }
    }

    function updateCategory($id, $category) {
        $sql = "UPDATE products SET category = :category_IN WHERE id = :id_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":id_IN", $id);
        $statement->bindParam(":category_IN", $category);
        $statement->execute();

        if($statement->rowCount() < 1) {
            return "The product with id =$id was not found!";
        }

        else {
            return "Succesful updated!";
        }
    }


    function listProducts() {
        $sql = "SELECT name, description, price, category FROM products";
        $statement = $this->db_connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }





}