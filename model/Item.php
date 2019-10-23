<?php

require_once "Crud.php";
require_once "Multimedia.php";
require_once "Category.php";

class Item extends Crud{
    private $id, $name, $description, $adminId, $returnMessage;
    private $categoryName, $categoryId;
    private $imageId, $imageName, $imageDirectory;
    private $videoId, $videoName, $videoDirectory;
    private $soundId, $soundName, $soundDirectory;
    
    public function getSingleItem($id){
        $stmt =  $this->select("item", "*", "id = \"$id\"");
        $checkSelectMultimedia = 1;

        if (!empty($stmt)){   
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $arrayItem = [
                "id" => $row['id'],
                "name" => $row['name'],
                "description" => $row['description'],
                "idAdmin" => $row['id_admin'],
                "idCategory" => $row['id_category'],
                "idImage" => $row['id_image'],
                "idVideo" => $row['id_video'],
                "idSound" => $row['id_sound']
            ];

            $category = new Category();
            $category = $category->getSingleCategory($arrayItem["idCategory"]);
            $arrayItem = array_merge($arrayItem, ["categoryName" => $category["name"]]);
            
           
            $image = new Multimedia();
            $image->getSingleMultimedia($arrayItem["idImage"]);
            if(empty($image->getReturnMessage())){
                $arrayItem = array_merge($arrayItem, ["imageName" => $image->getName()]);
                $arrayItem = array_merge($arrayItem, ["imageDirectory" => $image->getDirectory()]);
            } else{
                $checkSelectMultimedia = 0; 
            }

            $video = new Multimedia();
            $video->getSingleMultimedia($arrayItem["idVideo"]);
            if(empty($video->getReturnMessage())){
                $arrayItem = array_merge($arrayItem, ["videoName" => $video->getName()]);
                $arrayItem = array_merge($arrayItem, ["videoDirectory" => $video->getDirectory()]);
            } else{
                $checkSelectMultimedia = 0; 
            }

            $sound = new Multimedia();
            $sound->getSingleMultimedia($arrayItem["idSound"]);
            if(empty($sound->getReturnMessage())){
                $arrayItem = array_merge($arrayItem, ["soundName" => $sound->getName()]);
                $arrayItem = array_merge($arrayItem, ["soundDirectory" => $sound->getDirectory()]);
            } else{
                $checkSelectMultimedia = 0; 
            }
                
            if($checkSelectMultimedia){
                return $arrayItem;
                
            } else{
                $this->setReturnMessage("Item inexistente ou inválido");
            }    
        } else{
            $this->setReturnMessage("Item inexistente");
        }
           
    }

    public function getAllItem(){
        $stmt =  $this->select("item", "*");
        $arrayItem = [];
        $checkSelectMultimedia = 1;
        if (!empty($stmt)){ 
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         
            $item = [
                "id" => $row['id'],
                "name" => $row['name'],
                "description" => $row['description'],
                "idAdmin" => $row['id_admin'],
                "idCategory" => $row['id_category'],
                "idImage"  => $row['id_image'],
                "idVideo"  => $row['id_video'],
                "idSound"  => $row['id_sound'],
            ];

            $category = new Category();
            $category->getSingleCategory($item["idCategory"]);
            if(empty($category->getReturnMessage())){
                $arrayCategory = [
                    "categoryName" => $category->getName(),
                ];
            }

            $image = new Multimedia();
            $image->getSingleMultimedia($item["idImage"]);
            if(empty($image->getReturnMessage())){
                $arrayImage = [
                    "imageName" => $image->getName(),
                    "imageDirectory" => $image->getDirectory(),
                ];
            } else{
                $checkSelectMultimedia = 0; 
            }

            $video = new Multimedia();
            $video->getSingleMultimedia($item["idVideo"]);
            if(empty($video->getReturnMessage())){
                $arrayVideo = [
                    "videoName" => $video->getName(),
                    "videoDirectory" => $video->getDirectory(),
                ];
            } else{
                $checkSelectMultimedia = 0; 
            }

            $sound = new Multimedia();
            $sound->getSingleMultimedia($item["idSound"]);
            if(empty($sound->getReturnMessage())){
                $arraySound = [
                    "soundName" => $sound->getName(),
                    "soundDirectory" => $sound->getDirectory(),
                ];
            } else{
                $checkSelectMultimedia = 0; 
            }
            
            if($checkSelectMultimedia){
               $item = array_merge($item, $arrayCategory, $arrayImage, $arrayVideo, $arraySound);
                array_push($arrayItem, $item); 
            } 
          }
          return $arrayItem;
        } else{
            $this->setReturnMessage("Nenhum item foi cadastrado");
        }
    }

    public function insertItem(){
        if(empty($this->returnMessage)){
            $checkInsert = $this->insert("item", "name, description, id_admin, id_category, id_image, id_sound, id_video", 
                [$this->name, $this->description, $this->adminId, $this->categoryId, $this->imageId, $this->soundId, $this->videoId]);
            if(!empty($checkInsert)){
                return 1;
            } else{
                $this->setReturnMessage("<li>Não foi possível inserir o item</li>");
            }
        }

    }

    public function updateItem(){
        $checkUpdate = $this->update("item", $this->id, ["name", "description", "id_category", "id_image", "id_sound", "id_video"], 
            [$this->name, $this->description, $this->categoryId, $this->imageId, $this->soundId, $this->videoId]);
        if(!empty($checkUpdate)){
            return 1;
        } else{
            $this->setReturnMessage("<li>Não foi possível alterar o item</li>");
        }

    }

    public function deleteItem($id){     
        if(!empty($this->delete("item", "id=\"$id\""))){
            return 1;
        } else{
            $this->setReturnMessage("Não foi possível excluir o item");
        }
        
    }

    public function checkItemPermission($id, $session){
        $arrayItem = $this->getSingleItem($id);
        return ($session == $arrayItem["idAdmin"]) ? 1 : null;
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
        $name = $this->checkInput($name, "<li>Preencha o campo nome do item</li>");
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
        $imageId = $this->checkInput($imageId, "<li>Escolha uma imagem para o item</li>");
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
        $videoId = $this->checkInput($videoId, "<li>Escolha um vídeo para o item</li>");
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
        $soundId = $this->checkInput($soundId, "<li>Escolha um som para o item</li>");
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
    

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $description = $this->checkInput($description, "<li>Insira uma descrição para o item</li>");
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of categoryId
     */ 
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set the value of categoryId
     *
     * @return  self
     */ 
    public function setCategoryId($categoryId)
    {
        $categoryId = $this->checkInput($categoryId, "<li>Selecione a categoria</li>");
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get the value of categoryName
     */ 
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set the value of categoryName
     *
     * @return  self
     */ 
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }
}