<?php
require_once("includes/header.php");
require_once("includes/classes/SelectThumbnail.php");
require_once("includes/classes/VideoDetailsFormProvider.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoUploadData.php");

if(!User::isLoggedIn()){
    header("Location: signIn.php");
}

if(!isset($_GET["videoId"])){
    echo "No video selected.";
    exit();
}

$videoId = $_GET["videoId"];
$video = new Video($con, $videoId, $userLoggedInObj);

if($video->getUploadedBy() != $userLoggedInObj->getUsername()){
    header("Location: index.php");
    exit();
}

$detailsMessage = "";

if(isset($_POST["saveBtn"])){
    $videoData = new VideoUploadData(
        null,
        $_POST["titleInput"],
        $_POST["descriptionInput"],
        $_POST["privacyInput"],
        $_POST["categoryInput"],
        $userLoggedInObj->getUsername()
    );

    if($videoData->updateDetails($con, $videoId)){
        $detailsMessage = "<div class='alert alert-success'>
                                Your video updated successfully.
                            </div>";

        $video = new Video($con, $videoId, $userLoggedInObj);
    } else{
        $detailsMessage = "<div class='alert alert-danger'>
                                Something went wrong.
                            </div>";
    }
}
?>

<script src="assets/js/editVideoActions.js"></script>

<div class="editVideoContainer column">
    <div class="message">
        <?php echo $detailsMessage; ?>
    </div>

    <div class="topSection">
        <?php
        $videoPlayer = new VideoPlayer($video);
        echo $videoPlayer->create(false);

        $selectThumbnail = new SelectThumbnail($con, $video);
        echo $selectThumbnail->create();
        ?>
    </div>

    <div class="bottomSection">
        <?php
        $formProvider = new VideoDetailsFormProvider($con);
        echo $formProvider->createEditDetailsFrom($video);
        ?>
    </div>
</div>

<?php require_once("includes/footer.php");