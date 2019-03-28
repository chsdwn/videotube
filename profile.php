<?php
require_once("includes/header.php");
require_once("includes/classes/ProfileGenerator.php");

if(isset($_GET["username"])){
    $profileUsername = $_GET["username"];

    /*if(User::isLoggedIn() && $profileUsername == $userLoggedInObj->getUsername()){

    } else{
        echo "Wait that's illegal.";
        exit();
    }*/
} else{
    header("Location: index.php");
    exit();
}

$profileGenerator = new ProfileGenerator($con, $userLoggedInObj, $profileUsername);
echo $profileGenerator->create();