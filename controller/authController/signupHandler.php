<?php
  include "SignupController.php";
  
  $Signup = new SignupController();

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
  && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode($Signup->signUpAdmin());
  }
}
 ?>
 