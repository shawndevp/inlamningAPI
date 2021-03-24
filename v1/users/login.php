<?php
include("../../config/database_handler.php");
include("../../objects/Users.php");


    $username = $_GET['username'];
    $password = $_GET['password'];


    $user = new User($pdo);
    $user->Login($username, $password);