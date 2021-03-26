<?php
include("../../config/database_handler.php");
include("../../objects/Users.php");

    if(isset($_GET['username']) && isset($_GET['password'])) {
        $username = $_GET['username'];
        $password = $_GET['password'];

        $user = new User($pdo);

        $return = new stdClass();

        $return->token = $user->Login($username, $password);

        print_r(json_encode($return));
    }

    else {
        $error = new stdClass();
        $error->message = "Invalid username or password!";
        $error->code = "0002";
        echo json_encode($error);
        die();
    }