<?php

class User {
    
    private $db_connection;
    private $user_id;
    private $username;
    private $password;
    private $email;


    function __construct($db) {
        $this->$db_connection = $db;
    }

    function CreateUser($username_IN, $password_IN, $email_IN) {
        if(!empty($username_IN) && !empty($password_IN) && !empty($email_IN)) {

        




        }
    }





}



?>