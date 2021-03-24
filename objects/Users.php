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

        $sql = "INSERT INTO users (username, password, email) VALUES(:username_IN, :password_IN, :email_IN)";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":username_IN", $username_IN);
        $statement->bindParam(":password_IN", $password_IN);
        $statement->bindParam(":email_IN", $email_IN);

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



    function Login($username_IN, $password_IN) {
        $sql = "SELECT id, username, email FROM users WHERE username=:username_IN AND password=:password_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":username_IN", $username_IN);
        $statement->bindParam(":password_IN", $password_IN);

        $statement->execute();
    
        if($statement->rowCount() == 1) { // If user types the right username&password
            $row = $statement->fetch();
            $this->CreateToken($row['id'], $row['username']);
            

        }
    }


    function CreateToken($id, $username) {

        if($this->ScanToken($id) != false); 
        $token = md5(time()) . $id . $username;
        $time = time();
        
        $sql = "INSERT INTO session (user_id, token, login_time) VALUES(:user_id_IN, :token_IN, :login_time_IN)";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":user_id_IN", $id);
        $statement->bindParam(":token_IN", $token);
        $statement->bindParam(":login_time_IN", $time);

        $statement->execute();
        

    }


    function ScanToken($id) {
        $sql = "SELECT token, login_time FROM session WHERE user_id=:user_id_IN AND login_time > :TimeLeft_IN";
        $statement = $this->db_connection->prepare($sql);
        $statement->bindParam(":user_id_IN", $id);
        $statement->bindParam(":TimeLeft_IN", $TimeLeft);
        $statement->execute();

        $TimeLeft = time() - (60*60);

        $return = $statement->fetch();

        if(isset($return['token'])) {
            return $return['token'];
        } 
        else {
            return false;
        }



        die();
        
    }


}



?>