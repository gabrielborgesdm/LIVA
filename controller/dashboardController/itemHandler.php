<?php

include "ItemController.php";
$item = new ItemController();

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
  && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
    
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($item->itemGet());
    
  }else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode($item->itemPost());

  }else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    echo json_encode($item->itemDelete());
  }
}
?>
