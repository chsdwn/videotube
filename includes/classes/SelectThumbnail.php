<?php
class SelectThumbnail{
    private $con, $video;

    public function __construct($con, $video){
         $this->con = $con;
         $this->video = $video;
    }

    public function create(){
        $thumbnailData = $this->getThumbnailData();
        $html = "";

        foreach($thumbnailData as $data){
            $html .= $this->createThumbnailItem($data);
        }

        return "<div class='thumbnailItemsContainer'>
                    $html
                </div>";
    }

    private function getThumbnailData(){
        $data = array();
        $videoId = $this->video->getId();

        $query = $this->con->prepare("SELECT * FROM thumbnails WHERE videoId=:videoId");
        $query->bindParam(":videoId", $videoId);
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            array_push($data, $row);
        }

        return $data;
    }

    private function createThumbnailItem($data){
        $id = $data["id"];
        $url = $data["filePath"];
        $videoId = $data["videoId"];
        $selected = $data["selected"] == 1 ? "selected" : "";

        return "<div class='thumbnailItem $selected' onclick='setNewThumbnail(this, $id, $videoId)'>
                     <img src='$url'>
                </div>";
    }
}