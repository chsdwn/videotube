<?php require_once("includes/header.php"); ?>

<?php
if(isset($_SESSION["userLoggedIn"])){
    echo "Logged in user is " . $userLoggedInObj->getName();
} else{
    echo "no logged user";
}
?>

<?php require_once("includes/footer.php"); ?> 