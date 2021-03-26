<?php
include("../../config/database_handler.php");
include("../../objects/Users.php");


    if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['email'])) {
        $username = $_GET['username'];
        $password = $_GET['password'];
        $email = $_GET['email'];
    }

    else {
        $error = new stdClass();
        $error->message="Fill all fields for registration of user";
        $error->code="0003";
        print_r(json_encode($error));
        die();
    }

    $user = new User($pdo);
    $user->CreateUser("shawn", "test", "email@.se");

?>