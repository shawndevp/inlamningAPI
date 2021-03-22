<?php

class User {
    
    private $db_connection;
    private $user_id;
    private $username;
    private $password;
    private $email;


    function __construct($db) {
        $this->db_connection = $db;
    }

    function CreateUser($username_IN, $password_IN, $email_IN) {
        if(!empty($username_IN) && !empty($password_IN) && !empty($email_IN)) {

        $sql = "SELECT id FROM users WHERE username =:username_IN OR email=:email_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":username_IN", $username_IN);
        $statement->bindParam(":email_IN", $email_IN);

            if( !$statement->execute() ) {
                echo "Something went wrong!";
                die();
            }

            $count_row = $statement->rowCount();
            if($count_row > 0) {
                echo "User already registered!";
                die();
            }

        $sql = "INSERT INTO users (username, email, password) VALUES(:username_IN, :password_IN, :email_IN)";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":username_IN", $username_IN);
        $statement->bindParam(":email_IN", $email_IN);
        $statement->bindParam(":password_IN", $password_IN);

            if (!$statement->execute()) {
                echo "Cant create user!";
                die();
            }

            $this->username = $username_IN;
            $this->password = $password_IN;
            $this->email = $email_IN;

            echo "Username: $this->username Password: $this->password Email: $this->password";
            die();

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



?>