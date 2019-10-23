<?php

include '../../model/Category.php';
include '../SessionController.php';


class CategoryController extends Category{

  public function CategoryGet() {
    $id = (!empty($_GET["id"])) ? $_GET["id"] : null;
    if(empty($id)){
      $arrayMultimedia = $this->getAllCategory();
    } else{ 
      $arrayMultimedia = $this->getSingleCategory($id);   
    }

    if (!empty($arrayMultimedia)) {
        return $arrayMultimedia;
    } else {
        return array("error" => $this->getReturnMessage());
    }
}

  public function categoryPost(){
    $session = new SessionController();
    $id = (!empty($_POST["idCategory"])) ? $_POST["idCategory"] : null;
    $this->setId($id)
        ->setName($_POST["nameCategory"])
        ->setImageId($_POST["imageCategoryId"])
        ->setVideoId($_POST["videoCategoryId"])
        ->setSoundId($_POST["soundCategoryId"]);
    if (empty($this->getReturnMessage())) {
      if(empty($this->getId())){
        $this->setAdminId($session->getSessionId());
        $this->insertCategory();
      } else{
        $permissionTrue = $this->checkCategoryPermission($this->getId(), $session->getSessionId());
        if(!empty($permissionTrue)){
          $this->updateCategory($session->getSessionId());
        }else{
          $this->setReturnMessage("Permissão insuficiente para editar essa categoria");
        }  
      } 
    }
    if(empty($this->getReturnMessage())){
      return 1;
    } else{
      return array("error" => $this->getReturnMessage());
    }
  } 
  
  public function categoryDelete(){
    $session = new SessionController();
    $headers = apache_request_headers();
    $this->setId($headers['id']);
    
    $permissionTrue = $this->checkCategoryPermission($this->getId(), $session->getSessionId());

    if(empty($permissionTrue)){
      $this->setReturnMessage("Permissão insuficiente para excluir essa categoria");
    } else{
      $this->deleteCategory($this->getId());
    }

    if(empty($this->getReturnMessage())){
      return 1;
    } else{
      return array("error" => $this->getReturnMessage());
    }
  }
}