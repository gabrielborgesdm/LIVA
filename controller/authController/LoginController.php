<?php

include "../../model/Auth.php";
include "../SessionController.php";

 class LoginController extends Auth{

    public function logInAdmin(){
        $this->setInputs(); 
        $this->verifyLogin();
        return $this->checkReturnMessage();  
    }

    private function checkReturnMessage(){
        $response = 1;
        if(!empty($this->getReturnMessage())){
            $response = ['error'=>$this->getReturnMessage()];
        } else{
            $session = new SessionController();
            $session->defineAccountSessionId($this->getId());
        }
        return $response;
    }

    private function setInputs(){
        $this->setEmail($_POST['email'])
            ->setPassword($_POST['password']); 
    }
 } 