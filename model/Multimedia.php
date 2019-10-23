<?php

require_once "Crud.php"; 

class Multimedia extends Crud{
    private $id, $name, $type, $directory, $file, $returnMessage;

    public function getSingleMultimedia($id){
    
        $stmt =  $this->select("multimedia", "*", "id = \"$id\"");
        if (!empty($stmt)){ 
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->type = $row['type'];
            $this->directory = $row['directory'];
          }
        } else {
            $this->setReturnMessage("<li>Nenhuma Multimídia foi Cadastrada</li>");
        }
    }

    public function getAllMultimedia(){
        $stmt =  $this->select("multimedia", "*");
        $array_file = [];
        if (!empty($stmt)){ 
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
            if(file_exists("../../view/" . $row['directory'])){
                
                $file = [
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "type" => $row['type'],
                    "directory"  => $row['directory'],
                ];
                array_push($array_file, $file);   
            } else{
                $this->getSingleMultimedia($row['id']);
                $this->deleteMultimedia();
            }
          }
          return $array_file;
        } else{
            $this->setReturnMessage("<li>Nenhuma Mídia Encontrada</li>");
        }
    }

    public function insertMultimedia(){
        if(empty($this->returnMessage)){
            $checkInsert = $this->insert("multimedia", "name, directory, type", 
                [$this->name, $this->directory, $this->type]);
            if(!empty($checkInsert)){
                return 1;
            } else{
                $this->setReturnMessage("<li>Não foi possível inserir esta mídia!</li>");
            }
        }

    }  
    public function deleteMultimedia(){
        $deleteCheck = (!empty($this->directory)) ? $sucessoDelete = $this->delete("multimedia", "id = $this->id") : 0;
        if($deleteCheck){
            $this->removeMultimediaFile();
        } else{
            $this->setReturnMessage("Não foi possível excluir a multimídia");
        }
    }

    public function removeMultimediaFile(){
            if(empty($this->returnMessage)){
                if(file_exists("../../view/". $this->directory)){
                unlink("../../view/" . $this->directory);    
            } else{
                $this->setReturnMessage("Não foi possível excluir a multimídia");
            }
        }
    }

    private function checkInput($input, $errorString , $type = "string"){
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

    public function validateFile(){
        if(empty($this->returnMessage)){
        
            $directory = "assets/multimedia/";
            $targetFile = basename($this->file["name"]);
            $extension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            switch($extension){
                case "jpeg":
                case "png":
                case "jpg":
                    $this->type = 2;
                    $directory .= "images/";
                    break;
                case "mp4":
                case "avi":
                case "wmv":
                    $this->type = 3;
                    $directory .= "videos/";
                    break; 
                case "wav":
                case "mp3":
                    $this->type = 4;
                    $directory .= "sounds/";
                    break;  
                default:
                    $this->addReturnMessage("<li>Insira um arquivo com um formato válido!</li>");
                    break;
            }
        }
        if(empty($this->getReturnMessage())){
            date_default_timezone_set('America/Sao_Paulo');
            $directory =  $directory . $this->name . date("Ymd") . "." . $extension;
            $this->directory = $string = preg_replace('/\s+/', '', $directory);
            // Check if file already exists
            if (file_exists("../../view/" . $this->directory)) {
                $this->addReturnMessage("<li>O arquivo já foi cadastrado no sistema!</li>");
            } else {
                if (!move_uploaded_file($this->file["tmp_name"], "../../view/" . $this->directory)) {    
                    $this->setReturnMessage("<li>Não foi possível mover o arquivo</li>");
                }    
            
            }
        }     
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
        $this->id = $id;

        return $this;
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
        $this->name = $this->checkInput($name, "<li>Preencha o campo Nome da Mídia</li>");
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of directory
     */ 
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * Set the value of directory
     *
     * @return  self
     */ 
    public function setDirectory($directory)
    {
        $this->directory = $directory;

        return $this;
    }

    /**
     * Get the value of file
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile($file)
    {  
        if($file["error"] == 0){
            $this->file = $file;
        } else if($file["error"] == 1 or $file["error"] == 2){
            $this->addReturnMessage("<li>Arquivo de mídia é muito grande</li>");
        } else{
            $this->addReturnMessage("<li>Insira um arquivo de mídia</li>");
        }

        return $this;
    }
}