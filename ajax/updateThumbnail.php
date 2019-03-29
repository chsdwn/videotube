<?php
require_once("../includes/config.php");

if(isset($_POST["thumbnailId"]) && isset($_POST["videoId"])){
    $thumbnailId = $_POST["thumbnailId"];
    $videoId = $_POST["videoId"];

    $query = $con->prepare("UPDATE thumbnails SET selected=0 WHERE videoId=:videoId");
    $query->bindParam(":videoId", $videoId);
    $query->execute();

    $query = $con->prepare("UPDATE thumbnails SET selected=1 WHERE id=:thumbnailId");
    $query->bindParam(":thumbnailId", $thumbnailId);
    $query->execute();
} else{
    echo "Not all parameters passed correctly.";
}