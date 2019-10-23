<?php

include '../../model/Item.php';
include '../SessionController.php';


class ItemController extends Item{

  public function ItemGet() {
    $id = (!empty($_GET["id"])) ? $_GET["id"] : null;
    if(empty($id)){
      $arrayMultimedia = $this->getAllItem();
    } else{ 
      $arrayMultimedia = $this->getSingleItem($id);   
    }

    if (!empty($arrayMultimedia)) {
        return $arrayMultimedia;
    } else {
        return array("error" => $this->getReturnMessage());
    }
}

  public function itemPost(){
    $session = new SessionController();
    $id = (!empty($_POST["idItem"])) ? $_POST["idItem"] : null;
    $this->setId($id)
        ->setName($_POST["itemName"])
        ->setDescription($_POST["itemDescription"])
        ->setCategoryId($_POST["idCategoryItem"])
        ->setImageId($_POST["imageItemId"])
        ->setVideoId($_POST["videoItemId"])
        ->setSoundId($_POST["soundItemId"]);
    if (empty($this->getReturnMessage())) {
      if(empty($this->getId())){
        $this->setAdminId($session->getSessionId());
        $this->insertItem();
      } else{
        $permissionTrue = $this->checkItemPermission($this->getId(), $session->getSessionId());
        if(!empty($permissionTrue)){
          $this->updateItem($session->getSessionId());
        }else{
          $this->setReturnMessage("Permissão insuficiente para editar esse item");
        }  
      } 
    }
    if(empty($this->getReturnMessage())){
      return 1;
    } else{
      return array("error" => $this->getReturnMessage());
    }
  } 
  
  public function itemDelete(){
    $session = new SessionController();
    $headers = apache_request_headers();
    $this->setId($headers['id']);
    
    $permissionTrue = $this->checkItemPermission($this->getId(), $session->getSessionId());

    if(empty($permissionTrue)){
      $this->setReturnMessage("Permissão insuficiente para excluir esse item");
    } else{
      $this->deleteItem($this->getId());
    }

    if(empty($this->getReturnMessage())){
      return 1;
    } else{
      return array("error" => $this->getReturnMessage());
    }
  }
}