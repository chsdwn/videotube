<?php
require_once("../includes/config.php");
require_once("../includes/classes/User.php");
require_once("../includes/classes/Video.php");

$username = isset($_SESSION["userLoggedIn"]) ? $_SESSION["userLoggedIn"] : "";
$videoId = $_POST["videoId"];

$userLoggedInObj = new User($con, $username);
$video = new Video($con, $videoId, $userLoggedInObj);

echo $video->like();