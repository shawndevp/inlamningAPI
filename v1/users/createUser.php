<?php
include("../../config/database_handler.php");
include("../../objects/Users.php");

    $user = new User($pdo);
    $user->CreateUser("shawn", "test", "email@.se");

?>