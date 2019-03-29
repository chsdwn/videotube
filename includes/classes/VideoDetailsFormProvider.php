<?php

class VideoDetailsFormProvider{
    private $con;

    public function __construct($con){
        $this->con = $con;
    }

    public function createUploadForm(){
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput(null);
        $descriptionInput = $this->createDescriptionInput(null);
        $privacyInput = $this->createPrivacyInput(null);
        $categoriesInput = $this->createCategoriesInput(null);
        $uploadButton = $this->createUploadButton();
        
        return 
            "<form action='processing.php' method='POST' enctype='multipart/form-data'>
                $fileInput
                $titleInput
                $descriptionInput
                $privacyInput
                $categoriesInput
                $uploadButton
            </form>";
    }

    public function createEditDetailsFrom($video){
        $titleInput = $this->createTitleInput($video->getTitle());
        $descriptionInput = $this->createDescriptionInput($video->getDescription());
        $privacyInput = $this->createPrivacyInput($video->getPrivacy());
        $categoriesInput = $this->createCategoriesInput($video->getCategory());
        $saveButton = $this->createSaveButton();

        return
            "<form method='POST'>
                $titleInput
                $descriptionInput
                $privacyInput
                $categoriesInput
                $saveButton
            </form>";
    }

    private function createFileInput(){
        return
            "<div class='form-group'>
                <label for='videoUploadFormControl'>Your file</label>
                <input type='file' class='form-control-file' id='videoUploadFormControl' name='fileInput' required>
            </div>";
    }

    private function createTitleInput($value){
        if($value == null) $value = "";

        return
            "<div class='form-group'>
                <input class='form-control' type='text' placeholder='Title' name='titleInput' value='$value'>
            </div>
            ";
    }

    private function createDescriptionInput($value){
        if($value == null) $value = "";

        return
            "<div class='form-group'>
                <textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3'>$value
                </textarea>
            </div>
            ";
    }

    private function createPrivacyInput($value){
        if($value == null) $value = "";

        $privateSelected = ($value == 0) ? "selected='selected'" : "";
        $publicSelected = ($value == 1) ? "selected='selected'" : "";

        return
            "<div class='form-group'>
                <select class='form-control' name='privacyInput'>
                    <option value='0' $privateSelected>Private</option>
                    <option value='1' $publicSelected>Public</option>
                </select>
            </div>";
    }

    private function createCategoriesInput($value){
        if($value == null) $value = "";

        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "<div class='form-group'>
                    <select class='form-control' name='categoryInput'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $name = $row["name"];
            $id = $row["id"];
            $selected = ($id == $value) ? "selected='selected'" : "";

            $html .= "<option value='$id' $selected>$name</option>";
        }

        $html .= 
                "</select>
            </div>";

        return $html;
    }

    private function createUploadButton(){
        return "<button type='submit' class='btn btn-primary' name='uploadBtn'>Upload</button>";
    }

    private function createSaveButton(){
        return "<button type='submit' class='btn btn-primary' name='saveBtn'>Save</button>";
    }
}