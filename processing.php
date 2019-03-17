<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");

if(!isset($_POST["uploadBtn"])){
    echo "No file sent to page.";
    exit();
} 

$videoUploadData = new VideoUploadData($_FILES["fileInput"]
    , $_POST["titleInput"]
    , $_POST["descriptionInput"]
    , $_POST["privacyInput"]
    , $_POST["categoryInput"]
    , $userLoggedInObj->getUsername());

$videoProcessor = new VideoProcessor($con);
$wasSuccessful = $videoProcessor->upload($videoUploadData);

if($wasSuccessful){
    echo "Upload successful.";
}

require_once("includes/footer.php");