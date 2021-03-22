<?php
include("../../config/database_handler.php");
include("../../objects/Users.php");

    $user = new User($pdo);
    $user->CreateUser("Username", "Secretpassword", "test@gmail.com");

?>