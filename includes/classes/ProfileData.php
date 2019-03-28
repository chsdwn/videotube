<?php
class ProfileData{
    private $con, $profileUserObj;

    public function __construct($con, $profileUsername){
        $this->con = $con;
        $this->profileUserObj = new User($con, $profileUsername);
    }

    public function getAllUserDetails(){
        return array(
            "Name" => $this->getProfileUserFullName(),
            "Username" => $this->getProfileUsername(),
            "Subscribers" => $this->getSubscriberCount(),
            "Total views" => $this->getTotalViews(),
            "Sign up date" => $this->getSignUpDate()
        );
    }

    public function getCoverPhoto(){
        return "assets/images/coverPhotos/default-cover-photo.jpg";
    }

    public function getProfileUsername(){
        return $this->profileUserObj->getUsername();
    }

    public function getProfilePic(){
        return $this->profileUserObj->getProfilePic();
    }

    public function getProfileUserFullName(){
        return $this->profileUserObj->getName();
    }

    public function getProfileUserObj(){
        return $this->profileUserObj;
    }

    private function getSignUpDate(){
        $date = $this->profileUserObj->getSignUpDate();
        return date("F jS, Y", strtotime($date));
    }

    public function getSubscriberCount(){
        return $this->profileUserObj->getSubscriberCount();
    }

    private function getTotalViews(){
        $username = $this->getProfileUsername();

        $query = $this->con->prepare("SELECT sum(views) FROM videos WHERE uploadedBy=:uploadedBy");
        $query->bindParam(":uploadedBy", $username);
        $query->execute();

        return $query->fetchColumn();
    }

    public function getUsersVideos(){
        $username = $this->getProfileUsername();

        $query = $this->con->prepare("SELECT * FROM videos WHERE uploadedBy=:uploadedBy ORDER BY uploadDate DESC");
        $query->bindParam(":uploadedBy", $username);
        $query->execute();

        $videos = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->con, $row, $this->profileUserObj->getUsername());
            array_push($videos, $video);
        }

        return $videos;
    }


    public function userExists(){
        $username = $this->getProfileUsername();

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->execute();

        return $query->rowCount() != 0;
    }
}