<?php

require_once "Crud.php";
require_once "Multimedia.php";

class Category extends Crud{
    private $id, $name, $adminId, $returnMessage;
    private $imageId, $imageName, $imageDirectory;
    private $videoId, $videoName, $videoDirectory;
    private $soundId, $soundName, $soundDirectory;
    
    public function getSingleCategory($id){
        $stmt =  $this->select("category", "*", "id = \"$id\"");
        $checkSelectMultimedia = 1;

        if (!empty($stmt)){   
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $arrayCategory = [
                "id" => $row['id'],
                "name" => $row['name'],
                "idAdmin" => $row['id_admin'],
                "idImage" => $row['id_image'],
                "idVideo" => $row['id_video'],
                "idSound" => $row['id_sound']
            ];
           
            $image = new Multimedia();
            $image->getSingleMultimedia($arrayCategory["idImage"]);
            if(empty($image->getReturnMessage())){
                $arrayCategory = array_merge($arrayCategory, ["imageName" => $image->getName()]);
                $arrayCategory = array_merge($arrayCategory, ["imageDirectory" => $image->getDirectory()]);
            } else{
                $checkSelectMultimedia = 0; 
            }

            $video = new Multimedia();
            $video->getSingleMultimedia($arrayCategory["idVideo"]);
            if(empty($video->getReturnMessage())){
                $arrayCategory = array_merge($arrayCategory, ["videoName" => $video->getName()]);
                $arrayCategory = array_merge($arrayCategory, ["videoDirectory" => $video->getDirectory()]);
            } else{
                $checkSelectMultimedia = 0; 
            }

            $sound = new Multimedia();
            $sound->getSingleMultimedia($arrayCategory["idSound"]);
            if(empty($sound->getReturnMessage())){
                $arrayCategory = array_merge($arrayCategory, ["soundName" => $sound->getName()]);
                $arrayCategory = array_merge($arrayCategory, ["soundDirectory" => $sound->getDirectory()]);
            } else{
                $checkSelectMultimedia = 0; 
            }
                
            if($checkSelectMultimedia){
                return $arrayCategory;
                
            } else{
                $this->setReturnMessage("Categoria inexistente ou inválida");
            }    
        } else{
            $this->setReturnMessage("Categoria inexistente");
        }
           
    }

    public function getAllCategory(){
        $stmt =  $this->select("category", "*");
        $arrayCategory = [];
        $checkSelectMultimedia = 1;
        if (!empty($stmt)){ 
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         
            $category = [
                "id" => $row['id'],
                "name" => $row['name'],
                "idAdmin" => $row['id_admin'],
                "idImage"  => $row['id_image'],
                "idVideo"  => $row['id_video'],
                "idSound"  => $row['id_sound'],
            ];

            $image = new Multimedia();
            
            $image->getSingleMultimedia($category["idImage"]);
            if(empty($image->getReturnMessage())){
                $arrayImage = [
                    "imageName" => $image->getName(),
                    "imageDirectory" => $image->getDirectory(),
                ];
            } else{
                $checkSelectMultimedia = 0; 
            }

            $video = new Multimedia();
            $video->getSingleMultimedia($category["idVideo"]);
            if(empty($video->getReturnMessage())){
                $arrayVideo = [
                    "videoName" => $video->getName(),
                    "videoDirectory" => $video->getDirectory(),
                ];
            } else{
                $checkSelectMultimedia = 0; 
            }

            $sound = new Multimedia();
            $sound->getSingleMultimedia($category["idSound"]);
            if(empty($sound->getReturnMessage())){
                $arraySound = [
                    "soundName" => $sound->getName(),
                    "soundDirectory" => $sound->getDirectory(),
                ];
            } else{
                $checkSelectMultimedia = 0; 
            }
            
            if($checkSelectMultimedia){
               $category = array_merge($category, $arrayImage, $arrayVideo, $arraySound);
                array_push($arrayCategory, $category); 
            } 
          }
          return $arrayCategory;
        } else{
            $this->setReturnMessage("<li>Nenhuma Categoria foi cadastrada</li>");
        }
    }

    public function insertCategory(){
        if(empty($this->returnMessage)){
            $checkInsert = $this->insert("category", "name, id_admin, id_image, id_sound, id_video", 
                [$this->name, $this->adminId, $this->imageId, $this->soundId, $this->videoId]);
            if(!empty($checkInsert)){
                return 1;
            } else{
                $this->setReturnMessage("<li>Não foi possível inserir a categoria!</li>");
            }
        }

    }

    public function updateCategory(){
        $checkUpdate = $this->update("category", $this->id, ["name", "id_image", "id_sound", "id_video"], 
            [$this->name, $this->imageId, $this->soundId, $this->videoId]);
        if(!empty($checkUpdate)){
            return 1;
        } else{
            $this->setReturnMessage("Não foi possível alterar a categoria");
        }

    }

    public function deleteCategory($id){     
        if(!empty($this->delete("category", "id=\"$id\""))){
            return 1;
        } else{
            $this->setReturnMessage("Não foi possível excluir a categoria");
        }
        
    }

    public function checkCategoryPermission($id, $session){
        $arrayCategory = $this->getSingleCategory($id);
        return ($session == $arrayCategory["idAdmin"]) ? 1 : null;
    }

    public function checkInput($input, $errorString , $type = "string"){
        if(!empty($input)){
            if($type == "email"){
                $input = filter_var($input, FILTER_SANITIZE_EMAIL);
            } else{
                $input = filter_var($input, FILTER_SANITIZE_STRING);
            }
        } else{
            $this->addReturnMessage($errorString);
        }
        return (!empty($input))? $input : null; 
    }
    
    /**
     * Get the value of returnMessage
     */ 
    public function getReturnMessage()
    {
        return $this->returnMessage;
    }

    /**
     * Set the value of returnMessage
     *
     * @return  self
     */ 
    public function setReturnMessage($returnMessage)
    {
        $this->returnMessage = $returnMessage;

        return $this;
    }

    /**
     * Add to the value of returnMessage
     *
     * @return  self
     */ 
    public function addReturnMessage($returnMessage)
    {   
        $this->returnMessage .= $returnMessage;

        return $this;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $id = $this->checkInput($id, "");
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $name = $this->checkInput($name, "<li>Preencha o campo Nome da Categoria</li>");
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setAdminId($adminId)
    {
        $adminId = $this->checkInput($adminId, "<li>É preciso fazer login para realizar esta operaçao!</li>");
        $this->adminId = $adminId;
        return $this;
    }

    /**
     * Get the value of imageId
     */ 
    public function getimageId()
    {
        return $this->imageId;
    }

    /**
     * Set the value of imageId
     *
     * @return  self
     */ 
    public function setimageId($imageId)
    {
        $imageId = $this->checkInput($imageId, "<li>Escolha uma imagem para a categoria!</li>");
        $this->imageId = $imageId;

        return $this;
    }
    
    /**
     * Get the value of imageName
     */ 
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set the value of imageName
     *
     * @return  self
     */ 
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get the value of imageDirectory
     */ 
    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    /**
     * Set the value of imageDirectory
     *
     * @return  self
     */ 
    public function setImageDirectory($imageDirectory)
    {
        $this->imageDirectory = $imageDirectory;

        return $this;
    }

    /**
     * Get the value of videoId
     */ 
    public function getVideoId()
    {
        return $this->videoId;
    }
    
    /**
     * Set the value of videoId
     *
     * @return  self
     */ 
    public function setVideoId($videoId)
    {
        $videoId = $this->checkInput($videoId, "<li>Escolha um vídeo para a categoria!</li>");
        $this->videoId = $videoId;
        
        return $this;
    }

    /**
     * Get the value of videoName
     */ 
    public function getVideoName()
    {
        return $this->videoName;
    }

    /**
     * Set the value of videoName
     *
     * @return  self
     */ 
    public function setVideoName($videoName)
    {
        $this->videoName = $videoName;

        return $this;
    }

    /**
     * Get the value of videoDirectory
     */ 
    public function getVideoDirectory()
    {
        return $this->videoDirectory;
    }

    /**
     * Set the value of videoDirectory
     *
     * @return  self
     */ 
    public function setVideoDirectory($videoDirectory)
    {
        $this->videoDirectory = $videoDirectory;

        return $this;
    }

    /**
     * Get the value of soundId
     */ 
    public function getSoundId()
    {
        return $this->soundId;
    }

    /**
     * Set the value of soundId
     *
     * @return  self
     */ 
    public function setSoundId($soundId)
    {
        $soundId = $this->checkInput($soundId, "<li>Escolha um som para a categoria!</li>");
        $this->soundId = $soundId;

        return $this;
    }

    /**
     * Get the value of soundName
     */ 
    public function getSoundName()
    {
        return $this->soundName;
    }

    /**
     * Set the value of soundName
     *
     * @return  self
     */ 
    public function setSoundName($soundName)
    {
        $this->soundName = $soundName;

        return $this;
    }

    /**
     * Get the value of soundDirectory
     */ 
    public function getSoundDirectory()
    {
        return $this->soundDirectory;
    }

    /**
     * Set the value of soundDirectory
     *
     * @return  self
     */ 
    public function setSoundDirectory($soundDirectory)
    {
        $this->soundDirectory = $soundDirectory;

        return $this;
    }
    
}