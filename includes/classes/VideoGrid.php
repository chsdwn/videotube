<?php
class VideoGrid{
    private $con, $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($con, $userLoggedInObj){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create($videos, $title, $showFilter){
        if($videos == null){
            $gridItems = $this->generateItems();
        } else{
            $gridItems = $this->generateItemsFromVideos();
        }

        $header = "";

        if($title != null){
            $header = $this->createGridHeader($title, $showFilter);
        }

        return "$header
                <div class='$this->gridClass'>
                    $gridItems
                </div>";
    }

    public function generateItems(){
        $query = $this->con->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();

        $elementHtml = "";
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->con, $row, $this->userLoggedInObj);
            $item = new VideoGridItem($video, $this->largeMode);
            $elementHtml .= $item->create();
        }

        return $elementHtml;
    }

    public function generateItemsFromVideos($videos){

    }

    public function createGridHeader($title, $showFilter){
        return "";
    }
}