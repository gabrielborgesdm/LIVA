<?php

include "CategoryController.php";
$category = new CategoryController();

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
  
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($category->categoryGet());
    
  }else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode($category->categoryPost());

  }else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    echo json_encode($category->categoryDelete());
  }
}
?>
