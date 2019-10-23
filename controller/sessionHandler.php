<?php

include 'SessionController.php';
$session = new SessionController();

  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {  

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      echo json_encode($session->getSessionId());
    }
}
  
?>
