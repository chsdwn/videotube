<?php
require_once("includes/header.php");

if(isset($_SESSION["userLoggedIn"])){
    echo "Logged in user is " . $userLoggedInObj->getName();
} else{
    echo "no logged user";
}

require_once("includes/footer.php");