<?php

include 'MultimediaController.php';
$multimedia = new MultimediaController();

  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {  

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      echo json_encode($multimedia->multimediaGet());

    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      echo json_encode ($multimedia->multimediaPost());

    } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
      echo json_encode ($multimedia->multimediaDelete());    
    }
}
  
?>
