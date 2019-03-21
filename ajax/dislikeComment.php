<?php
require_once("../includes/config.php");
require_once("../includes/classes/Comment.php");
require_once("../includes/classes/User.php");

$username = isset($_SESSION["userLoggedIn"]) ? $_SESSION["userLoggedIn"] : "";
$commentId = $_POST["commentId"];
$videoId = $_POST["videoId"];

$userLoggedInObj = new User($con, $username);
$comment = new Comment($con, $commentId, $userLoggedInObj, $videoId);

echo $comment->dislike();